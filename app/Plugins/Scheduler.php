<?php
namespace App\Plugins;
class Scheduler
{
    protected $score;
    protected $sessions;
    protected $schedule;

    /**
     * Create a schedule to lecture
     *
     * @param session
     * @param timeInterval
     */
    public function createSchedule($sessions)
    {
        $this->relateWeightQuantity($sessions);

        $timeIntervals = $this->generateIntervals($sessions);

        foreach ($timeIntervals as $i => $track) {

            foreach($track as $j => $interval) {

                while ($interval) {
                    $interval = $this->decreaseTime($interval, 0, $i);
                }
            }
        }

        return $this->schedule;
    }

    /**
     * decrease de time interval amount
     */
    private function decreaseTime($time, $p, $i)
    {
        $item = $this->score[$p];

        $total = $time - $item['duration'];

        if ($total >= 30 || $total === 0) {

            $duration = $item['duration'];

            $this->updatePoints($duration);
            $this->schedule[$i][] = $this->sessions[$item['duration']]->pop();

            return $total;
        }

        return $this->decreaseTime($time, $p+1, $i);
    }

    /**
     * update points on score
     */
    private function updatePoints($dur): void
    {
        $this->score = $this->score->map(function ($item) use ($dur) {
            if ($item['duration'] == $dur)
                $item['points'] -= $item['weight'];

            return $item;
        })->sortByDesc('points')->values();
    }

    /**
     * creates an array that relates weight and quantity of sessions list
     */
    private function relateWeightQuantity($list): void
    {
        $this->sessions = $list->groupBy('duration');

        $score = $list->countBy('duration');

        $score = $score->map(function ($qtd, $duration) {

            $weight = $duration / 5;
            $points = $qtd * $weight;

            return ['points' => $points, 'duration' => $duration, 'weight' => $weight];

        })->sortByDesc('points')->values();

        $this->score = $score;
    }

    private function generateIntervals($sessions)
    {
        $intervals = [];

        $amount = $sessions->sum(function ($item) {
            return $item['duration'];
        });

        $rounds = ceil($amount / 420);
        $rest = 420 * $rounds - $amount;

        for ($i=0; $i < $rounds; $i++) {
            $intervals[] = [180, 240];
        }

        $intervals[$rounds - 1][1] -= intval($rest);

        return $intervals;
    }
}
