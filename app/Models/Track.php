<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Session;
use Carbon\Carbon;
use DB;

class Track extends Model
{
    protected $fillable = ['title'];

    /**
     * Create track with sessions together
     * @param input_form
     */
    public static function createAll($input_form)
    {
        return DB::transaction(function () use ($input_form) {

            $sessions = collect($input_form['sessions'])->map(function ($data) {
                return new Session($data);
            });

            $track = self::create(['title' => $input_form['title']]);
            $track->sessions()->saveMany($sessions);

            return $track;
        });

        return $track;
    }

    /**
     * Get the sessions for the track.
     */
    public function sessions()
    {
        return $this->hasMany('App\Models\Session');
    }

    public function getScheduleAttribute()
    {
        $schedule = [];
        $sessionList = $this->sessions->toArray();
        $listLenght = count($sessionList);
        $clock = 540;

        for ($i=0; $i <= $listLenght; $i++)
        {
            if ($clock == 720) {
                $init = $this->convertMinsToHours($clock);
                $schedule[] = $init .  " Lunch";
                $clock += 60;
            }

            $init = $this->convertMinsToHours($clock);

            if ($i == $listLenght) {
                $schedule[] = $init .  " fim";
                break;
            }

            $session = $sessionList[$i];

            $clock += $session['duration'];

            $schedule[] = $init . " " . $session['name'];
        }

        return $schedule;
    }

    function convertMinsToHours($time, $format = '%02d:%02d') {
        if ($time < 1) {
            return;
        }

        $hours = floor($time / 60);
        $minutes = ($time % 60);

        return sprintf($format, $hours, $minutes);
    }
}
