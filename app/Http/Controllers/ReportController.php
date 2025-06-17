<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReportRequest;
use App\Models\Notification;
use App\Models\Report;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    //Get Reports Function
    public function getReports()
    {
        $reports = Report::orderBy('created_at', 'desc')->with(['user', 'service.images'])->get();
        $user = Auth::guard('user')->user();

        return view('reports.reports', compact('reports', 'user'));
    }

    //Reporting Service Function
    public function reportingService(Service $service, ReportRequest $reportRequest)
    {
        $user = Auth::guard('user')->user();
        $report = Report::where('user_id', $user->id)->where('service_id', $service->id)->first();

        if ($report) {
            $report->update([
                'report' => $reportRequest->report,
            ]);

            Notification::create([
                'user_id' => $user->id,
                'description' => $user->full_name . ' update report about ' . $service->service_name,
                'type' => 'insert',
            ]);

            return redirect()->back()->with('success', 'your report sent successfully');
        } else {
            Report::create([
                'user_id' => $user->id,
                'service_id' => $service->id,
                'report' => $reportRequest->report
            ]);

            Notification::create([
                'user_id' => $user->id,
                'description' => $user->full_name . ' sent report about ' . $service->service_name,
                'type' => 'insert',
            ]);

            return redirect()->back()->with('success', 'your report updated successfully');
        }
    }

    //Delete Report Function
    public function deleteReport(Report $report)
    {
        $report->delete();

        return redirect()->back()->with('success', 'report deleted successfully');
    }
}
