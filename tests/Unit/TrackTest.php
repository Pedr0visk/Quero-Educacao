<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
// use PHPUnit\Framework\TestCase;
use Tests\TestCase;
use App\Models\Session;
use App\Models\Track;

class TrackTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function track_can_return_schedule()
    {
        $track = factory(Track::class)->create();
        $sessions = factory(Session::class, 7)->make();

        $track->sessions()->saveMany($sessions);

        $schedule = $track->schedule;

        $this->assertCount(9, $schedule);
    }
}
