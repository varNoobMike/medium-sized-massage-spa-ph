<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SpaWeeklySchedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminWeeklyScheduleController extends Controller
{
    public function index()
    {
        $weeklySchedules = $this->getSpaWeeklySchedules();

        return view('admin.spa-weekly-schedules', [
            'breadcrumbs' => [
                ['title' => 'Admin', 'url' => route('admin.dashboard.index')],
                ['title' => 'Spa Weekly Schedules', 'url' => null],
            ],
        ], compact('weeklySchedules'));
    }

    public function store(Request $request)
    {

        // Validate the incoming request data
        $validated = $request->validate([
            'spa_id' => 'required|exists:spas,id',
            'day_of_week' => 'required|string',
            'open_time' => 'required|date_format:H:i',
            'close_time' => 'required|date_format:H:i|after:open_time',
        ]);

        try {
            // Use a transaction to ensure data integrity
            DB::transaction(function () use ($validated) {

                // Mark existing current schedule for the spa and day as not current
                SpaWeeklySchedule::where('spa_id', $validated['spa_id'])
                    ->where('day_of_week', $validated['day_of_week'])
                    ->where('is_current', true)
                    ->update(['is_current' => false]);

                // Create new current schedule
                SpaWeeklySchedule::create([
                    ...$validated,
                ]);
            });

        } catch (\Throwable $e) {

            report($e); // logs it

            // Back with error message
            return back()
                ->withInput()
                ->with('error', 'Something went wrong while saving the schedule.');
        }

        // Redirect back with success message (Note: redirect to index route itself)
        return redirect()->route('admin.spa-weekly-schedules.index')
            ->with('success', 'Weekly schedule updated successfully.');

    }

    // change to private later
    public function getSpaWeeklySchedules()
    {
        return SpaWeeklySchedule::with(['creator', 'spa'])
            ->where('is_current', true)
            ->orderByRaw("
                FIELD(day_of_week, 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday')
        ")->get();
    }
}
