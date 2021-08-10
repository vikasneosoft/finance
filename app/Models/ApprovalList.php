<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApprovalList extends Model
{
    use HasFactory;
    protected $table = 'approval_lists';
    protected $fillable = ['employe_id', 'level_one_id', 'level_one_max', 'level_two_id', 'level_two_max', 'level_three_id', 'level_three_max', 'level_four_id', 'level_four_max', 'level_five_id', 'level_five_max', 'approval_date'];


    /**
     * Get all Approval Lists
     *
     * @return array
     */
    function getApprovalLists()
    {
        return $this::with(array('employe'))
            ->select('id', 'employe_id')
            ->orderby('id', 'desc')
            ->get();
    }

    /**
     * Get Approval List
     *
     * @param  $id
     * @return array
     */
    function getApprovalList($id)
    {
        return $this::find($id);
    }

    /**
     * Get Approval List by user id
     *
     * @param  $id
     * @return array
     */
    function getApprovalListByUserId($userId)
    {
        return $this::where(array('employe_id' => $userId))->first();
    }


    /**
     * Store Approval List
     *
     * @param  array  $inputs
     * @return objectId
     */
    function addApprovalList($inputs)
    {
        $obj = new $this($inputs);
        $obj->save();
        return $obj->id;
    }

    /**
     * Update Approval List
     *
     * @param  array  $inputs
     * @return objectId
     */
    function updateApprovalList($inputs)
    {
        $obj = $this::find($inputs['id']);
        $obj->update($inputs);
        return $obj->id;
    }

    /**
     * Delete Approval List
     *
     * @param  $id
     * @return true
     */
    function deleteApprovalList($id)
    {
        return $this::where(array('id' => $id))->delete();
    }

    /**
     * Get the name of employe
     */
    function employe()
    {
        return $this->belongsTo(User::class, 'employe_id', 'id')
            ->select(array('id', 'name'));
    }
}
