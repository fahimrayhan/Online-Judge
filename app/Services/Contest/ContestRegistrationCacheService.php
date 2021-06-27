<?php
namespace App\Services\Contest;

use App\Models\Contest;

class ContestRegistrationCacheService
{
    protected $contest;
    protected $cacheKey;
    public function __construct(Contest $contest)
    {
        $this->contest  = $contest;
        $this->cacheKey = "contest_" . $contest->id . "_registration_data";
    }

    public function getDataQuery()
    {
        $users         = $this->contest->registrations()->get();
        $userDataField = $this->contest->user_data_field;

        $datas = [];

        foreach ($users as $key => $user) {

            $data = [
            	'id'					   => $user->id,
                'handle'                   => $user->handle,
                'name'                     => $user->name,
                'email'                    => $user->email,
                'registration_time'        => $user->pivot->created_at,
                'is_temp_user'             => $user->pivot->is_temp_user,
                'temp_user_password'       => $user->pivot->temp_user_password,
                'is_registration_accepted' => $user->pivot->is_registration_accepted,
                
            ];

            $registrationData = json_decode($user->pivot->registration_data);

            foreach ($userDataField['registration'] as $key => $value) {
                if(isset($registrationData->$value))$data[$value] = $registrationData->$value;
                else $data[$value] = isset($data[$value]) ? $data[$value] : "";
                
            }
            $data['main_name'] = $this->createName($this->contest->participate_main_name,$data);
            $data['sub_name']  = $this->createName($this->contest->participate_sub_name,$data);

            $datas[$user->id] = (object) $data;

        }
        return $datas;
    }

    public function createName($name,$data)
    {
        foreach ($data as $key => $value) {
            $name = str_replace("@$key@", $value, $name);
        }
        return $name;
    }

    public function save()
    {
        $data = $this->getDataQuery();
        cache()->put($this->cacheKey, $data);
        return $data;
    }

    public function get()
    {
        return cache()->get($this->cacheKey, function () {
            return $this->save();
        });
    }
}
