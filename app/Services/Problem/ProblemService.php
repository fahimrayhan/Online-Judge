<?php
namespace App\Services\Problem;

use App\Models\Problem;
use Auth;

class ProblemService
{
    /**
     * Create New User
     *
     * @param  array $data
     * @return void
     */
    public function createNewProblem($data)
    {
        Problem::create($data);
    }
}
