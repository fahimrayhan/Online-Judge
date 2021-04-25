<?php
namespace App\Services\Problem;

use App\Models\Problem;

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
        return Problem::create($data);
    }

    public function update($data)
    {
        if(isset($data['_token']))unset($data['_token']);
        return Problem::where(['slug' => request()->slug])->update($data);
    }

    public function getProblemData($slug){
        return Problem::where(['slug' => $slug])->firstOrFail();
    }
}
