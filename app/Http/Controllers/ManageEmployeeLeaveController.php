<?php

namespace App\Http\Controllers;

use App\Branch;
use App\Department;
use App\Designation;
use App\Document;
use App\Employee;
use App\EmployeeManageLeave;
use App\LeaveType;
use App\Mail\UserCreate;
use App\Plan;
use App\User;
use App\Utility;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use DB;
//use Faker\Provider\File;

class ManageEmployeeLeaveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function create()
    {
       // $id = Crypt::decrypt($id);
        if(\Auth::user()->can('Manage Leave Employee'))
        {
            
            $leave_type        = LeaveType::all();
          
            
            return view('manage_leave_employee.create', compact('leave_type'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }
    public function store(Request $request)
    {

        if(\Auth::user()->can('Manage Leave Employee'))
        {

            $validator = \Validator::make(
                $request->all(), [
                'leave_type_id' => 'required',
               'total_leaves' => 'required',
            ]
            );

            if($validator->fails())
            {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }

            $leavetype             = new EmployeeManageLeave();
            $leavetype->leave_type_id      = $request->leave_type_id;
            $leavetype->employee_id= $request->employee_ids;
            $leavetype->total_leaves       = $request->total_leaves;
            $leavetype->created_by = \Auth::user()->creatorId();
            $leavetype->save();

            return redirect('manage_leave_employee/'.$request->employee_ids)->with('success', __('Leave  successfully created.'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }
    public function show($id)
    {

        //$id = Crypt::decrypt($id);
        $permissions = \Auth::user()->getAllPermissions();

//print_r($permissions);exit;
        if(\Auth::user()->can('Manage Leave Employee'))
        {
            
                $employees = EmployeeManageLeave::where('employee_id', $id)->get();
           

            return view('manage_leave_employee.show', compact('employees'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function edit($id)
    {
        if(\Auth::user()->can('Manage Leave Employee'))
        {

            $employees_edit = EmployeeManageLeave::where('id', $id)->first();
            $leave_type        = LeaveType::all();
            return view('manage_leave_employee.edit', compact('employees_edit','leave_type'));
            // if($leavetype->created_by == \Auth::user()->creatorId())
            // {

            //     return view('manage_leave_employee.edit', compact('leavetype'));
            // }
            // else
            // {
            //     return response()->json(['error' => __('Permission denied.')], 401);
            // }
        }
        else
        {
            return response()->json(['error' => __('Permission denied.')], 401);
        }
    }

    public function update(Request $request)
    {
        $employeemanageleave=EmployeeManageLeave::find($request->leave_ids);
        if(\Auth::user()->can('Manage Leave Employee'))
        {
           
            if($employeemanageleave->created_by == \Auth::user()->creatorId())
            {
                $validator = \Validator::make(
                    $request->all(), [
                    'leave_type_id' => 'required',
                  'total_leaves' => 'required',
                ]
                );

                if($validator->fails())
                {
                    $messages = $validator->getMessageBag();

                    return redirect()->back()->with('error', $messages->first());
                }

                $employeemanageleave->leave_type_id = $request->leave_type_id;
                $employeemanageleave->total_leaves  = $request->total_leaves;
                $employeemanageleave->save();

                return redirect('manage_leave_employee/'.$request->employee_ids)->with('success', __('Leave successfully updated.'));
            }
            else
            {
                return redirect()->back()->with('error', __('Permission denied.'));
            }
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }
    public function destroy(Request $request,$id)
    { 

        $employeemanageleave=EmployeeManageLeave::find($id);
        if(\Auth::user()->can('Delete Leave Type'))
        {
            if($employeemanageleave->created_by == \Auth::user()->creatorId())
            {
                $employeemanageleave->delete();

                return redirect('manage_leave_employee/'.$request->employee_ids)->with('success', __('Leave successfully deleted.'));
            }
            else
            {
                return redirect()->back()->with('error', __('Permission denied.'));
            }
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

}
