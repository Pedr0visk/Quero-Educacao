<?php

namespace Tests\Feature\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Lecture;
use App\Models\Track;
use App\Models\Session;

class LectureManagementTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function lectures_can_be_created()
    {
        $response = $this->post('api/lectures', $this->data());

        $response->assertStatus(201);

        $this->assertCount(1, Lecture::all());
        $this->assertCount(2, Track::all());
        $this->assertCount(19, Session::all());

    }

    /** @test */
    public function lecture_can_be_mounted()
    {
        $this->post('api/lectures', $this->data());

        $lecture = Lecture::first();

        $response = $this->get($lecture->path());

        $data = json_decode($response->getContent(), true);

        $response->assertStatus(200);

        $this->assertArrayHasKey('data', $data);

    }

    private function data()
    {
        return [
            "data" => [
                "Writing Fast Tests Against Enterprise Rails 60min",
                "Overdoing it in Python 45min",
                "Lua for the Masses 30min",
                "Ruby Errors from Mismatched Gem Versions 45min",
                "Common Ruby Errors 45min",
                "Rails for Python Developers lightning",
                "Communicating Over Distance 60min",
                "Accounting-Driven Development 45min",
                "Woah 30min",
                "Sit Down and Write 30min",
                "Pair Programming vs Noise 45min",
                "Rails Magic 60min",
                "Ruby on Rails: Why We Should Move On 60min",
                "Clojure Ate Scala (on my project) 45min",
                "Programming in the Boondocks of Seattle 30min",
                "Ruby vs. Clojure for Back-End Development 30min",
                "Ruby on Rails Legacy App Maintenance 60min",
                "A World Without HackerNews 30min",
                "User Interface CSS in Rails Apps 30min"
            ]
        ];
    }
}
