<?php
namespace App\Models\Traits\Contest;

trait HasRegistration
{

    public function getRegistrationUserData()
    {
        $users         = $this->registrations()->get();
        $userDataField = $this->user_data_field;

        $datas = [];

        foreach ($users as $key => $user) {

            $data = [
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
                $data[$value] = isset($registrationData->$value) ? $registrationData->$value : "";
            }
            $datas[$user->id] = (object)$data;
        }
        return $datas;
    }

    public function registrationData(){
       
    }

};