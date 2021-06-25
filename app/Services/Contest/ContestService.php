<?php

namespace App\Services\Contest;

use App\Models\Contest;
use Hash;
use Illuminate\Support\Str;
use App\Models\Problem;

class ContestService
{
    public function bannerUpdate(Contest $contest, $data)
    {
        if ($data->hasfile('banner')) {
            if ($contest->banner != null) {
                $baseName = basename($contest->banner);
                if (file_exists(public_path($contest->bannerPath) . $baseName)) {
                    unlink(public_path($contest->bannerPath) . $baseName);
                }
            }
            $banner = $data->banner;
            $fileName = hash('sha256', $contest->slug . '-' . Str::random(20) . "-" . time()) . "." . $banner->extension();
            $banner->move(public_path($contest->bannerPath), $fileName);
            $contest->banner = $fileName;
        }
        return $contest;
    }
    public function updateContest(Contest $contest, $data)
    {
        // dd(isset($data->publish));
        $contest = $this->bannerUpdate($contest, $data);
        $contest->name = $data->name;
        $contest->format = $data->format;
        $contest->start = $data->start;
        $contest->duration = $data->duration;
        $contest->publish = isset($data->publish);
        $contest->description = $data->description;
        $contest->visibility = $data->visibility;
        $contest->password = $data->password == null ? null : hash('sha256', $data->password);
        $contest->registration_auto_accept = isset($data->registration_auto_accept);
        $contest->save();
    }

    public function addProblem(Contest $contest, $slug)
    {
        $problem = Problem::where(['slug' => $slug])->firstOrFail();
        // return $problem->slug;
        $contest->problems()->attach($problem->id, ['user_id' => auth()->user()->id]);
        return "Problem Added Successfully";
    }
    public function removeProblem(Contest $contest, $problem_id)
    {
        $contest->problems()->detach($problem_id);
        return "Problem Removed";
    }
}
