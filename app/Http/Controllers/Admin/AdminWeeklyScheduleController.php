<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SpaWeeklySchedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminWeeklyScheduleController extends Controller
{
    public function index()
    {
        $weeklySchedules = $this->read();

        return view('admin.weekly-schedules', [
            'breadcrumbs' => [
                ['title' => 'Admin', 'url' => route('admin.dashboard.index')],
                ['title' => 'Weekly Schedules', 'url' => null],
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

        // dd($validated);

         // Use a transaction to ensure data integrity

        try {
            DB::transaction(function () use ($validated) {

                // Expire the current version for this spa + day
                SpaWeeklySchedule::where('spa_id', $validated['spa_id'])
                    ->where('day_of_week', $validated['day_of_week'])
                    ->where('is_current', true)
                    ->update(['is_current' => false]);

                SpaWeeklySchedule::create([
                    ...$validated,
                    'is_current' => true,
                    'created_by' => Auth::id(),
                ]);
            });

        } catch (\Throwable $e) {

            report($e); // logs it

            return back()
                ->withInput()
                ->with('error', 'Something went wrong while saving the schedule.');
        }

        return redirect()->route('admin.weekly-schedules.index')
            ->with('success', 'Weekly schedule updated successfully.');

    }

    public function read()
    {
        return SpaWeeklySchedule::with(['creator', 'spa'])->where('is_current', true)->get();
    }
}
