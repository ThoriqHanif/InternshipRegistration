<?php

namespace App\Service;

use Illuminate\Support\Str;
use PhpOffice\PhpWord\IOFactory;

class FileService
{

    /**
     * Handle the file upload.
     *
     * @param  \Illuminate\Http\UploadedFile $file
     * @param  string $path
     * @param  string|null $fileName
     * @return string $fileName
     */

    public function uploadFile($file, $directory)
    {
        if (!$file) {
            return null;
        }

        $fileName = $file->getClientOriginalName();
        $fileName = str_replace(' ', '-', $fileName);

        $extension = $file->getClientOriginalExtension();
        $fileName = pathinfo($fileName, PATHINFO_FILENAME) . '.' . $extension;

        $file->move("uploads/{$directory}", $fileName);

        return $fileName;
    }


    public function getImageDetails(?string $image, string $directory): array
    {
        if ($image) {
            $imageUrl = asset("uploads/{$directory}/" . $image);
            $imageExtension = pathinfo($image, PATHINFO_EXTENSION);
        } else {
            $imageUrl = null;
            $imageExtension = null;
        }

        return [$imageUrl, $imageExtension];
    }

    public function deleteFile(?string $image, string $directory): bool
    {
        if ($image) {
            $filePath = "uploads/{$directory}/" . $image;
            if (file_exists($filePath)) {
                return unlink($filePath);
            }
        }
        return false;
    }

    /**
     * Convert DOCX file to HTML.
     *
     * @param string $filePath
     * @param string $fileType
     * @return string
     */
    public function convertDocxToHtml($filePath, $fileType)
    {
        if (!file_exists($filePath)) {
            return null;
        }

        $phpWord = IOFactory::load($filePath);
        $htmlWriter = new \PhpOffice\PhpWord\Writer\HTML($phpWord);

        $fileTypeFolder = $this->getFileTypeFolder($fileType);
        $htmlFilePath = "uploads/{$fileTypeFolder}/convert/" . pathinfo($filePath, PATHINFO_FILENAME) . '.html';

        $convertDir = "uploads/{$fileTypeFolder}/convert";
        if (!file_exists($convertDir)) {
            mkdir($convertDir, 0777, true);
        }

        try {
            $htmlWriter->save($htmlFilePath);
            return asset("uploads/{$fileTypeFolder}/convert/" . pathinfo($filePath, PATHINFO_FILENAME) . '.html');
        } catch (\Exception $e) {
            return null;
        }
    }


    /**
     * Get file data including URL, HTML path (for DOCX), and extension.
     *
     * @param string $fileName
     * @param string $fileType
     * @return array
     */
    public function getFileData($fileName, $fileType)
    {
        if (!$fileName) {
            return [null, null, null];
        }

        $filePath = "uploads/{$fileType}/{$fileName}";
        $url = asset($filePath);
        $extension = pathinfo($fileName, PATHINFO_EXTENSION);

        $htmlPath = null;
        if ($extension === 'docx') {
            $htmlPath = $this->convertDocxToHtml($filePath, $fileType);

            if ($htmlPath === null) {
                $htmlPath = null;
            }
        }

        return [$url, $htmlPath, $extension];
    }


    /**
     * Get the folder path based on the file type.
     *
     * @param string $fileType
     * @return string
     */
    private function getFileTypeFolder($fileType)
    {
        $fileTypeFolders = [
            'cv' => 'cv',
            'motivation_letter' => 'motivation_letter',
            'cover_letter' => 'cover_letter',
            'portfolio' => 'portfolio',
            'file' => 'file'
        ];

        return $fileTypeFolders[$fileType] ?? '';
    }

    /**
     * Process intern documents to extract their data and details.
     *
     * @param object $intern
     * @return array
     */
    public function internDocuments($intern)
    {
        $fileTypes = ['cv', 'motivation_letter', 'cover_letter', 'portfolio'];

        $documentData = [];

        foreach ($fileTypes as $type) {
            list($url, $htmlPath, $extension) = $this->getFileData($intern->$type, $type);
            $documentData["{$type}Url"] = $url;
            $documentData["{$type}HtmlPath"] = $htmlPath;
            $documentData["{$type}Extension"] = $extension;
        }

        list($photoUrl, $photoExtension) = $this->getFileData($intern->photo, 'photo');
        $documentData['photoUrl'] = $photoUrl;
        $documentData['photoExtension'] = $photoExtension;

        return $documentData;
    }
}
