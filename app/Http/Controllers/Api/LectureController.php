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
        $sessions = $request->data;

        $schedule = $scheduler->createSchedule($sessions);

        Lecture::createAll($schedule);

        return response()->json(['message' => 'Lectures created successufully'], 201);
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
