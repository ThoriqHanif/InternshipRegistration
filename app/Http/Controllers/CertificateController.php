<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use App\Models\Document;
use App\Models\GradeRange;
use App\Models\Intern;;

use App\Service\FileService;
use App\Service\MailService;
use Barryvdh\DomPDF\Facade\Pdf;



class CertificateController extends Controller
{
    protected $fileService;
    protected $mailService;

    public function __construct(FileService $fileService, MailService $mailService)
    {
        $this->fileService = $fileService;
        $this->mailService = $mailService;
    }
    public function index()
    {
        $interns = Intern::where('status', 'accepted')->get();

        return view('pages.admin.certificate.index', compact('interns'));
    }

    public function fetchIntern($internId)
    {
        $intern = Intern::with(['position'])
            ->find($internId);

        if (!$intern) {
            return response()->json(['error' => 'Data intern tidak ditemukan.'], 404);
        }

        return response()->json($intern);
    }

    public function generateCertificatePDF($internId)
    {
        $intern = Intern::with(['position', 'finalScores.aspect:id,type,name'])
            ->find($internId);

        if (!$intern) {
            return response()->json(['error' => 'Intern tidak ditemukan.'], 404);
        }

        $gradeRanges = GradeRange::all();

        $technicalScores = $intern->finalScores->where('aspect.type', 'technical');
        $nonTechnicalScores = $intern->finalScores->where('aspect.type', 'non-technical');

        try {
            $pdf = PDF::loadView('pages.pdf.certificate-pdf', compact('intern', 'gradeRanges', 'technicalScores', 'nonTechnicalScores'))
                ->setPaper('A4')
                ->setOptions([
                    'isHtml5ParserEnabled' => true,
                    'isRemoteEnabled' => true,
                    'isFontSubsettingEnabled' => true,
                    'defaultMediaType' => 'screen',
                    'fontDir' => storage_path('fonts'),
                    'fontCache' => storage_path('fonts'),
                    'chroot' => ([
                        'resources/views/',
                        storage_path('fonts'),
                    ])
                ]);

            return $pdf->stream('certificate' . $internId . '.pdf');
        } catch (\Exception $e) {
            \Log::error('PDF generation failed', [
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);
            throw $e;
        }
    }

    public function exportCertificatePDF($internId)
    {
        $intern = Intern::with(['position', 'finalScores.aspect:id,type,name'])
            ->find($internId);

        if (!$intern) {
            return response()->json(['error' => 'Intern tidak ditemukan.'], 404);
        }

        $gradeRanges = GradeRange::all();

        $technicalScores = $intern->finalScores->where('aspect.type', 'technical');
        $nonTechnicalScores = $intern->finalScores->where('aspect.type', 'non-technical');

        try {
            $pdf = PDF::loadView('pages.pdf.certificate-pdf', compact('intern', 'gradeRanges', 'technicalScores', 'nonTechnicalScores'))
                ->setPaper('A4')
                ->setOptions([
                    'isHtml5ParserEnabled' => true,
                    'isRemoteEnabled' => true,
                    'isFontSubsettingEnabled' => true,
                    'defaultMediaType' => 'screen',
                    'fontDir' => storage_path('fonts'),
                    'fontCache' => storage_path('fonts'),
                    'chroot' => ([
                        'resources/views/',
                        storage_path('fonts'),
                    ])
                ]);

            return $pdf->download('Sertifikat Magang' . $intern->full_name . '.pdf');
        } catch (\Exception $e) {
            \Log::error('PDF generation failed', [
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);
            throw $e;
        }
    }

    public function sendCertificate($internId)
    {
        $intern = Intern::findOrFail($internId);
        if (!$intern) {
            return response()->json(['error' => 'Intern tidak ditemukan.'], 404);
        }

        $document = Document::where('intern_id', $internId)
            ->where('type', 'certificate')
            ->first();

        if (!$document) {
            $document = new Document();
            $document->intern_id = $internId;
            $document->name = 'Sertifikat Magang';
            $document->type = 'certificate';
            $document->note = 'Dokumen Sertifikat Magang';

            $file_documentFileName = $this->fileService->uploadFile(request()->file('file'), 'file');
            $document->file = $file_documentFileName;

            if ($document->save()) {
                $this->mailService->sendEmailDocument($intern, $document);
                return response()->json(['success' => true]);
            } else {
                return response()->json(['success' => false]);
            }
        } else {
            $document->name = 'Sertifikat Magang';
            $document->type = 'certificate';
            $document->note = 'Dokumen Sertifikat Magang';

            if (request()->hasFile('file')) {
                $this->fileService->deleteFile($document->file, 'file');

                $file_documentFileName = $this->fileService->uploadFile(request()->file('file'), 'file');
                $document->file = $file_documentFileName;
            }

            if ($document->save()) {
                $this->mailService->sendEmailDocument($intern, $document);
                return response()->json(['success' => true]);
            } else {
                return response()->json(['success' => false]);
            }
        }
    }
}
