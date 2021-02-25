<?php
namespace App\Models\Traits\User;

trait UserType
{

    /**
     * Get all user type List
     *
     * @return array
     */
    public function getUserTypeList(): array
    {
        return [
            'super_admin' => 10,
            'admin' => 20,
            'moderator' => 30,
            'member' => 40,
        ];
    }

    /**
     * Get User Type in integer
     * If user type is null then default type is 40 (member)
     * @return int
     */
    public function getUserType(): int
    {
        $userTypeList = $this->getUserTypeList();
        //if user user type is integer then check user type is available in userTypeList array
        if (in_array($this->type, $userTypeList)) {
            return $this->type;
        }
        /**
         * if user type is any upper case and lower case later then it convert lowercase later
         * example =>  User::create(['type' => 'AdmiN']) then it convert type = 'admin'
         * then check those user type is map in user list array if found then return user type code
         */
        $this->type = strtolower($this->type);
        if (isset($userTypeList[$this->type])) {
            return $userTypeList[$this->type];
        }
        //other wise return default member status code
        return 40;
    }

};
