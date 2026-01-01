<?php

namespace App\Http\Controllers\Therapist;

use App\Http\Controllers\Controller;
use App\Models\StaffWeeklySchedule;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


// to be refactored and fixed....
class WeeklyScheduleController extends Controller
{
    public function index()
    {
        $therapistWeeklySchedules = $this->getTherapistWeeklySchedules();

        return view('therapist.weekly-schedule.index', [
            'breadcrumbs' => [
                ['title' => 'Admin', 'url' => route('therapist.dashboard.index')],
                ['title' => 'My Weekly Schedules', 'url' => null],
            ],
        ], compact('therapistWeeklySchedules'));
    }

    public function update(Request $request, string $id)
    {

        $therapist = User::findOrFail($id);

        // Validate the incoming request data
        $validated = $request->validate([
            'day_of_week' => 'required|string',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
        ]);

        try {
            // Use a transaction to ensure data integrity
            DB::transaction(function () use ($validated, $therapist) {

                // Update the existing schedule
                StaffWeeklySchedule::where('user_id', $therapist->id)
                    ->where('day_of_week', $validated['day_of_week'])
                    ->update([
                        'start_time' => $validated['start_time'],
                        'end_time' => $validated['end_time'],
                    ]);
            });

            // Redirect back with success message (Note: redirect to index route itself)
            return redirect()->route('therapist.weekly-schedules.index')
                ->with('success', 'Weekly schedule updated successfully.');

        } catch (\Throwable $e) {

            report($e); // logs it

            // Back with error message
            /*
            return back()
                ->withInput()
                ->with('error', 'Something went wrong while saving the schedule.');
            */

            return back()
                ->withInput()
                ->with('error', $e->getMessage());
        }

    }

    // change to private later
    public function getTherapistWeeklySchedules()
    {
        return StaffWeeklySchedule::with('staff:id,name')
            ->whereHas('staff', function ($q) {
                $q->where('id', Auth::user()->id);
            })
            ->orderByRaw("
                FIELD(day_of_week, 'Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday')
            ")
            ->get();
    }
}
