<?php
/**
 * 适配器模式示例
 */

interface IUserInfo
{
    public function getUserName(): string;
    public function getHomeAddress(): string;
    public function getMobileNumber(): string;
    public function getOfficeTelNumber(): string;
    public function getJobPosition(): string;
    public function getHomeTelNumber(): string;
}

class UserInfo implements IUserInfo
{
    public function getHomeAddress(): string
    {
        return 'userinfo homeaddress';
    }
    public function getHomeTelNumber(): string
    {
        return 'userinfo hometelnumber';
    }
    public function getJobPosition(): string
    {
        return 'userinfo jobposition';
    }
    public function getMobileNumber(): string
    {
        return 'userinfo mobilenumber';
    }
    public function getOfficeTelNumber(): string
    {
        return 'userinfo officetelnumber';
    }
    public function getUserName(): string
    {
        return 'userinfo username';
    }
}

interface IOuterUser
{
    public function getUserBaseInfo(): array;
    public function getUserOfficeInfo(): array;
    public function getUserHomeInfo(): array;
}

class OuterUser implements IOuterUser
{
    public function getUserBaseInfo(): array
    {
        return [
            'userName' => 'outeruser username',
            'mobileNumber' => 'outeruser mobilenumber',
        ];
    }
    public function getUserOfficeInfo(): array
    {
        return [
            'jobPosition' => 'outeruser jobposition',
            'officeTelNumber' => 'outeruser officetelnumber',
        ];
    }
    public function getUserHomeInfo(): array
    {
        return [
            'homeTelNumber' => 'outeruser hometelnumber',
            'homeAddress' => 'outeruser homeaddress',
        ];
    }
}

class OuterUserInfo extends OuterUser implements IUserInfo
{
    public $baseInfo;
    public $homeInfo;
    public $officeInfo;
    public function __construct()
    {
        $this->baseInfo = $this->getUserBaseInfo();
        $this->homeInfo = $this->getUserHomeInfo();
        $this->officeInfo = $this->getUserOfficeInfo();
    }

    public function getUserName(): string
    {
        return $this->baseInfo['userName'];
    }
    public function getHomeAddress(): string
    {
        return $this->homeInfo['homeAddress'];
    }
    public function getMobileNumber(): string
    {
        return $this->baseInfo['mobileNumber'];
    }
    public function getOfficeTelNumber(): string
    {
        return $this->officeInfo['officeTelNumber'];
    }
    public function getJobPosition(): string
    {
        return $this->officeInfo['jobPosition'];
    }
    public function getHomeTelNumber(): string
    {
        return $this->homeInfo['homeTelNumber'];
    }
}

$userInfo = new UserInfo();
echo 'userinfo: ' . $userInfo->getMobileNumber() . "\n";

$outUserInfo = new OuterUserInfo();
echo 'outuserinfo: ' . $outUserInfo->getMobileNumber() . "\n";
/* output
userinfo: userinfo mobilenumber
outuserinfo: outeruser mobilenumber
*/
