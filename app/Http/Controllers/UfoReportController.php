<?php

namespace App\Http\Controllers;

use App\Models\UfoReport;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class UfoReportController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function create()
    {
        return view('reports.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
    'incident_datetime' => 'required',
    'location' => 'required|string|max:255',
    'description' => 'required|string|min:10',  // Reduced from 50 to 10
    'category' => 'required|in:licht,object,ontmoeting,geluid,anders',
    'photo' => 'nullable',  // Simplified
    'reporter_name' => 'required|string|max:255',  // Simplified
    'reporter_email' => 'required|email',  // Simplified
]);

        $report = new UfoReport();
        
        if (auth()->check()) {
            $report->user_id = auth()->id();
        } else {
            $report->reporter_name = $validated['reporter_name'] ?? null;
            $report->reporter_email = $validated['reporter_email'] ?? null;
        }

        $report->incident_datetime = $validated['incident_datetime'];
        $report->location = $validated['location'];
        $report->description = $validated['description'];
        $report->category = $validated['category'];

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('ufo-photos', 'public');
            $report->photo_path = $path;
        }

$report->save();

// Send email notifications (commented out for now to avoid mail errors)
// $this->sendNotifications($report);

$report->save();

// Debug - see if this shows
return "Report saved with ID: " . $report->id . ". <a href='/bedankt/" . $report->id . "'>Go to thank you page</a>";
    }

    public function thanks(UfoReport $report)
    {
        return view('reports.thanks', compact('report'));
    }

    public function myReports()
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $reports = auth()->user()->ufoReports()->latest()->get();
        return view('reports.my-reports', compact('reports'));
    }

    private function sendNotifications(UfoReport $report)
    {
        try {
            // Send to admins
            $admins = User::role('admin')->get();
            foreach ($admins as $admin) {
                // Mail::to($admin->email)->send(new UfoReportSubmitted($report, true));
            }

            // Send to reporter
            $reporterEmail = $report->user ? $report->user->email : $report->reporter_email;
            if ($reporterEmail) {
                // Mail::to($reporterEmail)->send(new UfoReportSubmitted($report, false));
            }
        } catch (\Exception $e) {
            // Log error but don't break the flow
            \Log::error('Failed to send notification emails: ' . $e->getMessage());
        }
    }
}