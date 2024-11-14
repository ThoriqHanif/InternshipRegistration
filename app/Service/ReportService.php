<?php

namespace App\Service;

use App\Models\Report;
use App\Models\TimeTable;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportService
{
    private function getReportById($reportId)
    {
        return Report::find($reportId);
    }

    private function getTimeTableByDay($day)
    {
        return TimeTable::where('day', $day)->first();
    }
    public function checkDateWithDay($reportId)
    {
        $report = $this->getReportById($reportId);
        if ($report) {
            $dayOfWeek = Carbon::parse($report->date)->format('l');
            return $this->getTimeTableByDay($dayOfWeek);
        }

        return null;
    }

    public function getLate()
    {
        return Report::where('is_late', true)->get();
    }

    public function CheckIsLate(Request $request)
    {
        $reportId = $request->input('report_id');
        $attendanceTime = $request->input('attendance_time');

        $report = $this->getReportById($reportId);

        if (!$report) {
            return response()->json(['isLate' => false, 'message' => 'Report not found']);
        }

        $timeTable = $this->checkDateWithDay($reportId);

        if (!$timeTable) {
            return response()->json(['isLate' => false, 'message' => 'Time table not found']);
        }


        $startTime = $timeTable->start_time;
        $isLate = $attendanceTime > $startTime;

        $report->is_late = $isLate;

        return $isLate;
    }

    public function countTotalLate()
    {
        return $this->getLate()->count();
    }

    public function countDiffLate($reportId)
    {
        $report = $this->getReportById($reportId);

        if (!$report || !$report->is_late) {
            return null;
        }

        $attendanceTime = Carbon::parse($report->attendance_time);
        $timeTable = $this->checkDateWithDay($reportId);

        if (!$timeTable) {
            return null;
        }

        $startTime = Carbon::parse($timeTable->start_time);

        if ($attendanceTime->greaterThan($startTime)) {
            $latenessInMinutes = $attendanceTime->diffInMinutes($startTime);

            $hours = floor($latenessInMinutes / 60);
            $minutes = $latenessInMinutes % 60;

            return [
                'total_minutes' => $latenessInMinutes,
                'formatted' => "{$hours} jam {$minutes} menit"
            ];
        } else {
            return [
                'total_minutes' => 0,
                'formatted' => "0 menit"
            ];
        }
    }

    public function getDateLate()
    {
        return Report::where('is_late', true)->pluck('date')->unique()->toArray();
    }

    public function verifReport($reportId)
    {
        $report = Report::find($reportId);

        $report->status = 'Verified';
        $report->admin_reason = null;

        if($report->save()){
            return response()->json(['success' => true]);
        }else{
            return response()->json(['success' => false]);
        }
    }

    public function rejectReport(Request $request, $reportId)
    {
        $report = Report::find($reportId);

        $report->status = 'Rejected';
        $report->admin_reason = $request->input('admin_reason');

        if($report->save()){
            return response()->json(['success' => true]);
        }else{
            return response()->json(['success' => false]);
        }
    }

    public function verifAll()
    {

    }

    public function exportPDFInternByPeriode()
    {

    }

    public function exportPDFReportByIntern()
    {

    }
}
