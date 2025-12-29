<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Spa;
use App\Models\SpaWeeklySchedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminSpaWeeklyScheduleController extends Controller
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

    public function update(Request $request, $id)
    {

        $spa = Spa::findOrFail($id);

        // Validate the incoming request data
        $validated = $request->validate([
            'day_of_week' => 'required|string',
            'open_time' => 'required|date_format:H:i',
            'close_time' => 'required|date_format:H:i|after:open_time',
        ]);

        try {
            // Use a transaction to ensure data integrity
            DB::transaction(function () use ($validated, $spa) {

                // Update the existing schedule
                SpaWeeklySchedule::where('spa_id', $spa->id)
                    ->where('day_of_week', $validated['day_of_week'])
                    ->update([
                        'open_time' => $validated['open_time'],
                        'close_time' => $validated['close_time'],
                    ]);
            });

            // Redirect back with success message (Note: redirect to index route itself)
            return redirect()->route('admin.spa-weekly-schedules.index')
                ->with('success', 'Weekly schedule updated successfully.');

        } catch (\Throwable $e) {

            report($e); // logs it

            // Back with error message
            return back()
                ->withInput()
                ->with('error', 'Something went wrong while saving the schedule.');
        }

    }

    // change to private later
    public function getSpaWeeklySchedules()
    {
        return SpaWeeklySchedule::with('spa:id,name,is_main_branch')
            ->whereHas('spa', function ($q) {
                $q->where('is_main_branch', true);
            })
            ->orderByRaw("
                FIELD(day_of_week, 'Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday')
            ")
            ->get();

    }
}
