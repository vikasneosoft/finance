<?php

use App\Models\Section;
use App\Models\Department;
use App\Models\Division;
use App\Models\User;
use App\Models\Location;

use Mail;
use Config;
function sectionDetail($sectionId)
{
    $section = (new Section())->getSection($sectionId);
    $department = (new Department())->getDepartment($section->department_id);
    $division = (new Division())->getDivision($department->division_id);
    $location = (new Location())->getLocationByCompnayId($division->company_id);
    $output['department_id'] = $section->department_id;
    $output['division_id'] = $department->division_id;
    $output['company_id'] = $division->company_id;
    $output['location_id'] = isset($location->id) ? $location->id : 0;
    return $output;
}

function userDetail()
{
    $user = (new User())->getEmploye(auth()->user()->id);
    return $user;
}

function findUpperLevelUser()
{
    $section = auth()->user()->section_id;
    $department = auth()->user()->department_id;
    $division = auth()->user()->division_id;
    if ($section != 0) {
        $user = (new User())->getUpperEmploye(auth()->user()->company_id, auth()->user()->department_id);
    } else {
        if ($department != 0) {

            $user = (new User())->getTopLevelEmploye(auth()->user()->company_id);
        } else {
            if ($division != 0) {
                $user = (new User())->getUserAtDivisionLEvel(auth()->user()->company_id);
            } else {
                $user = (new User())->getOwner(auth()->user()->company_id);
            }
        }
    }
    return $user;
}


function getAccess($empId)
{
    if (auth()->user()->id == $empId) {
        return 1;
    } else {
        if ((auth()->user()->division_id == 0) && (auth()->user()->location_id == 0) && (auth()->user()->department_id == 0) && (auth()->user()->section_id == 0)) {
            return 1;
        }
        $user  = User::where(array('id' => $empId))->first();
        if (($user->division_id == 0) && ($user->location_id == 0) && ($user->department_id == 0) && ($user->section_id == 0)) {
            return 0;
        } else if (($user->company_id == auth()->user()->company_id) && ($user->division_id == auth()->user()->division_id)  && ($user->department_id == 0) && ($user->section_id == 0)) {
            return 0;
        } else if (($user->company_id == auth()->user()->company_id) && ($user->division_id == auth()->user()->division_id) && ($user->section_id == 0)) {
            return 1;
        } else if (($user->company_id == auth()->user()->company_id) && ($user->department_id == auth()->user()->department_id) && ($user->section_id != 0)) {
            return auth()->user()->department_id;
        } else {
            return $user->department_id;
        }
    }
}

function findUnderWorkingEmployee()
{
    $department = auth()->user()->department_id;
    if ($department == 0) {
        $workingEmployes  = (new User())->getEmployeAtDepartmentLevel(auth()->user()->company_id);
    } else {
        $workingEmployes  = (new User())->getUnderWorkingEmploye(auth()->user()->company_id, auth()->user()->department_id);
    }

    return $workingEmployes;
}

function findUserOfSameLevel()
{


    $users  = (new User())->userOfSameLevel(auth()->user()->company_id,auth()->user()->location_id,auth()->user()->division_id,auth()->user()->department_id,auth()->user()->section_id);

    $usersIds = array_column($users, 'id');

    return $usersIds;
}

function IND_money_format($number)
{
    $decimal = (string)($number - floor($number));
    $money = floor($number);
    $length = strlen($money);
    $delimiter = '';
    $money = strrev($money);

    for ($i = 0; $i < $length; $i++) {
        if (($i == 3 || ($i > 3 && ($i - 1) % 2 == 0)) && $i != $length) {
            $delimiter .= ',';
        }
        $delimiter .= $money[$i];
    }

    $result = strrev($delimiter);
    $decimal = preg_replace("/0\./i", ".", $decimal);
    $decimal = substr($decimal, 0, 3);

    if ($decimal != '0') {
        $result = $result . $decimal;
    }

    return $result;
}

function sendCredentialsToDocor($email, $name, $password)
{
    $emailData = array(
        'name' => $name,
        'email' => $email,
        'password' => $password,
    );
    $emailFrom =  Config::get('constants.EMAIL_FROM');
    Mail::send('email.demo', $confirmed = array('user_info' => $emailData), function ($message) use ($email, $emailFrom) {
        $message->to($email)->from($emailFrom, 'CancerAPP')
            ->subject('CancerAPP – Your login details.');
    });
    return;
}
