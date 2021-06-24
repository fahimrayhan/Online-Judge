<?php

namespace App\Models\Traits\Problem;

trait HasStatistics
{

    public function getStatisticsAttribute()
    {
        return (object) [
            'total_attempted' => 4 ,
            'total_solved' => 5,
            'ac' => 15,
            'wa' => 12
        ];
    }

    public function updateStatistics()
    {
        if($this->type != 2 || $this->verdict_id < 3)return;

    }

}
