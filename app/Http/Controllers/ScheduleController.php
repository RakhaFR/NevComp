<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\Station;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ScheduleController extends Controller
{
    public function index(Request $request): View
    {
        $originId = $request->query('origin_id');
        $destinationId = $request->query('destination_id');
        $date = $request->query('date');

        $query = Schedule::with(['train', 'originStation', 'destinationStation'])
            ->withCount('bookings')
            ->orderBy('departure_time', 'asc');

        if ($originId) {
            $query->where('origin_station_id', $originId);
        }
        if ($destinationId) {
            $query->where('destination_station_id', $destinationId);
        }
        if ($date) {
            $query->whereDate('departure_time', $date);
        }

        $schedules = $query->paginate(6)->withQueryString();
        $stations = Station::orderBy('name')->get();

        return view('schedules.index', compact('schedules', 'stations', 'originId', 'destinationId', 'date'));
    }

}
