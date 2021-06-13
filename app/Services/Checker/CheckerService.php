<?php

namespace App\Services\Checker;

use App\Models\Checker;

class CheckerService
{
    public function createChecker($data)
    {
        Checker::create($data);
    }

    public function getAllChecker()
    {
        return Checker::all();
    }

    public function getChecker($checkerId)
    {
        return Checker::findOrFail($checkerId);
    }

    public function updateChecker(Checker $checker,$data)
    {
        // dd($data);
        $checker->name = $data['name'];
        $checker->description = $data['description'];
        $checker->code = $data['code'];
        $checker->save();
    }

}
