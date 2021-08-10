<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'password_validate_time',
        'company_id', 'division_id', 'location_id', 'department_id',
        'section_id', 'remember_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get all employes
     *
     *
     * @return array
     */
    function getEmployes()
    {
        return $this::with(array('company', 'location', 'division', 'department', 'section'))
            ->select('id', 'name', 'email', 'company_id', 'division_id', 'location_id', 'department_id', 'section_id')
            ->orderby('id', 'desc')
            ->get();
    }


    /**
     * Get Employe
     *
     * @param  $id
     * @return array
     */
    function getEmploye($id)
    {
        return $this::with(array('company', 'location', 'division', 'department', 'section'))
            ->find($id);
    }

    /**
     * Get upper Employe when section 0
     *
     * @param  $id
     * @return array
     */
    function getUpperEmploye($companyId, $departmentId)
    {
        return $this::where(array('company_id' => $companyId, 'department_id' => $departmentId, 'section_id' => 0))->first();
    }

    /**
     * Get upper Employe when department_id = 0 and section 0
     *
     * @param  $id
     * @return array
     */
    function getTopLevelEmploye($companyId)
    {
        return $this::where(array('company_id' => $companyId, 'section_id' => 0, 'department_id' => 0))->first();
    }

    function getOwner($companyId)
    {
        return $this::where(array('company_id' => $companyId, 'location_id' => 0, 'division_id' => 0, 'department_id' => 0, 'section_id' => 0))->first();
    }

    function getUserAtDivisionLEvel($companyId)
    {
        return $this::where(array('company_id' => $companyId, 'division_id' => 0, 'department_id' => 0, 'section_id' => 0))
            ->where('location_id', '!=', 0)->first();
    }
    /* function getTopLevelEmploye($companyId, $departmentId)
    {
        return $this::where(array('company_id' => $companyId, 'division_id' => 0, 'department_id' => 0, 'section_id' => 0))->first();
    } */

    /**
     * Get upper Employe when section 0
     *
     * @param  $id
     * @return array
     */
    function getUnderWorkingEmploye($companyId, $departmentId)
    {
        return $this::where(array('company_id' => $companyId, 'department_id' => $departmentId))
            ->where('section_id', '!=', 0)->get()->toArray();
    }

    /**
     * Get upper Employe when
     *
     * @param  $id
     * @return array
     */
    function getEmployeAtDepartmentLevel($companyId)
    {
        return $this::where(array('company_id' => $companyId, 'section_id' => 0))
            ->where('department_id', '!=', 0)
            ->get()->toArray();
    }


    /**
     * Get Employe by pluck
     *
     *
     * @return array
     */
    function getEmployeByPluck()
    {
        return $this::orderby('name', 'asc')
            ->pluck('name', 'id');
    }

    /**
     * Get Employe by pluck
     *
     *
     * @return array
     */
    function getEmployeEmailsByPluck()
    {
        return $this::orderby('name', 'asc')
            ->pluck('email', 'id');
    }

    /**
     * Get Employe by pluck
     *
     *
     * @return array
     */
    function getEmployeBySectionId($sectionId)
    {
        return $this::where(array('section_id' => $sectionId))
            ->first();
    }

    /**
     * Store Employe
     *
     * @param  array  $inputs
     * @return objectId
     */
    function addEmploye($inputs)
    {
        $obj = new $this($inputs);
        $obj->save();
        return $obj->id;
    }

    /**
     * Update Employe
     *
     * @param  array  $inputs
     * @return objectId
     */
    function updateEmploye($inputs)
    {
        $obj = $this::find($inputs['id']);
        $obj->update($inputs);
        return $obj->id;
    }

    /**
     * Delete Employe
     *
     * @param  $id
     * @return true
     */
    function deleteEmploye($id)
    {
        return $this::where(array('id' => $id))->delete();
    }

    /**
     * Get the name of company
     */
    function company()
    {
        return $this->belongsTo(Company::class, 'company_id', 'id')
            ->select(array('id', 'name'));
    }

    /**
     * Get the name of location
     */
    function location()
    {
        return $this->belongsTo(Location::class, 'location_id', 'id')
            ->select(array('id', 'name'));
    }

    /**
     * Get the name of division
     */
    function division()
    {
        return $this->belongsTo(Division::class, 'division_id', 'id')
            ->select(array('id', 'name'));
    }

    /**
     * Get the name of department
     */
    function department()
    {
        return $this->belongsTo(Department::class, 'department_id', 'id')
            ->select(array('id', 'name'));
    }

    /**
     * Get the name of section
     */
    function section()
    {
        return $this->belongsTo(Section::class, 'section_id', 'id')
            ->select(array('id', 'name'));
    }

    /**
     * Get the name of section
     */
    function userOfSameLevel($company_id,$location_id,$division_id,$department_id,$section_id)
    {
        return $this->select('id','name','company_id','division_id','location_id','department_id','section_id')->where(array('company_id'=>$company_id,'location_id'=>$location_id,'division_id'=>$division_id,'department_id'=>$department_id,'section_id'=>$section_id))->get()->toArray();
    }
}
