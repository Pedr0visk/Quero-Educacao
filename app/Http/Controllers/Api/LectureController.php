<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Lecture;
use App\Models\Track;
use App\Plugins\Scheduler;
use App\Http\Controllers\Controller;

class LectureController extends Controller
{
    public function store(Scheduler $scheduler, Request $request)
    {
        $timeIntervals = [[180, 240], [180, 185]];
        $sessions = $request->data;

        $schedule = $scheduler->createSchedule($sessions, $timeIntervals);

        Lecture::createAll($schedule);

        return response()->json(['message' => 'Lecture created successufully'], 201);
    }

    public function show(Lecture $lecture)
    {
        $tracks = $lecture->tracks;
        $data = [];

        foreach ($tracks as $key => $track) {
            $data[] = [
                'title' => $track->title,
                'data'  => $track->schedule
            ];
        }

        return response()->json(['data' => $data]);
    }

}
