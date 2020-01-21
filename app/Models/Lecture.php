<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Session;
use App\Models\Track;
use DB;

class Lecture extends Model
{
    /**
     * Get the tracks for the lecture.
     * @param item
     */
    public static function createAll($items)
    {
        return DB::transaction(function () use ($items) {

            $tracks = collect($items)->map(function ($sessions, $index) {
                return Track::createAll([
                    'title' => 'Track ' . $index,
                    'sessions' => $sessions
                ]);

            });

            $lecture = self::create();
            $lecture->tracks()->saveMany($tracks);

            return $lecture;
        });
    }

    /**
     * Return the lecture path
     */
    public function path()
    {
        return 'api/lectures/' . $this->id;
    }

    /**
     * Get the tracks for the lecture.
     */
    public function tracks()
    {
        return $this->hasMany('App\Models\Track');
    }
}
