<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Spa;
use App\Models\SpaWeeklySchedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Services\SpaWeeklyScheduleService;


class SpaWeeklyScheduleController extends Controller
{
    protected $spaWeeklyScheduleService;

    public function __construct(SpaWeeklyScheduleService $spaWeeklyScheduleService)
    {
        $this->spaWeeklyScheduleService = $spaWeeklyScheduleService;
    }

    public function index()
    {
        $weeklySchedules = $this->spaWeeklyScheduleService->getWeeklySchedules();

        return view('admin.spa-weekly-schedules.index', [
            'breadcrumbs' => [
                ['title' => 'Admin', 'url' => route('admin.dashboard.index')],
                ['title' => 'Spa Weekly Schedules', 'url' => null],
            ],
        ], compact('weeklySchedules'));
    }

    /*  rewrite later, is error for now
    public function update(Request $request, string $id)
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

    */

    

}
