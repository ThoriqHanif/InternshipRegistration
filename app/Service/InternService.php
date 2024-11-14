<?php

namespace App\Service;

use App\Http\Requests\UpdateInternRequest;
use App\Mail\InternStatus;
use App\Models\Intern;
use App\Models\Periode;
use App\Models\Position;
use App\Models\Report;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use PhpOffice\PhpWord\IOFactory;

class InternService
{
    // Edit
    public function getAllPositions()
    {
        return Position::all();
    }

    public function getActivePositions(Carbon $today)
    {
        return Position::whereHas('periodes', function ($query) use ($today) {
            $query->where('start_date', '<=', $today)
                ->where('end_date', '>=', $today);
        })->get();
    }
    public function convertDocxToHtml($filePath, $fileType)
    {
        $phpWord = IOFactory::load($filePath);
        $htmlWriter = new \PhpOffice\PhpWord\Writer\HTML($phpWord);

        $fileTypeFolder = $this->getFileTypeFolder($fileType);
        $htmlFilePath = ("uploads/{$fileTypeFolder}/convert/" . pathinfo($filePath, PATHINFO_FILENAME) . '.html');
        $htmlWriter->save($htmlFilePath);

        return asset("uploads/{$fileTypeFolder}/convert/" . pathinfo($filePath, PATHINFO_FILENAME) . '.html');
    }

    public function getFileData($fileName, $fileType)
    {
        if (!$fileName) {
            return [null, null, null];
        }

        $filePath = ("uploads/{$fileType}/{$fileName}");
        $url = asset("uploads/{$fileType}/{$fileName}");
        $extension = pathinfo($fileName, PATHINFO_EXTENSION);

        $htmlPath = null;
        if ($extension === 'docx') {
            $htmlPath = $this->convertDocxToHtml($filePath, $fileType);
        }

        return [$url, $htmlPath, $extension];
    }

    private function getFileTypeFolder($fileType)
    {
        $fileTypeFolders = [
            'cv' => 'cv',
            'motivation_letter' => 'motivation_letter',
            'cover_letter' => 'cover_letter',
            'portfolio' => 'portfolio',
        ];

        return $fileTypeFolders[$fileType] ?? '';
    }

    public function processInternDocuments($intern)
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


    // Update
}
