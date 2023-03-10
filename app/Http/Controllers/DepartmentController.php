<?php

namespace App\Http\Controllers;

use App\Branch;
use App\Department;
use Illuminate\Http\Request;
use DB;

class DepartmentController extends Controller
{
    public function index()
    {
        if(\Auth::user()->can('Manage Department'))
        {
            $departments = Department::where('created_by', '=', \Auth::user()->creatorId())->get();

            return view('department.index', compact('departments'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function create()
    {
        if(\Auth::user()->can('Create Department'))
        {
            $branch = Branch::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');

            return view('department.create', compact('branch'));
        }
        else
        {
            return response()->json(['error' => __('Permission denied.')], 401);
        }
    }

    public function store(Request $request)
    {
        if(\Auth::user()->can('Create Department'))
        {

            $validator = \Validator::make(
                $request->all(), [
                                   'branch_id' => 'required',
                                   'name' => 'required|max:20',
                               ]
            );
            if($validator->fails())
            {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }

            $department             = new Department();
            $department->branch_id  = $request->branch_id;
            $department->name       = $request->name;
            $department->created_by = \Auth::user()->creatorId();
            $department->save();

            return redirect()->route('department.index')->with('success', __('Department  successfully created.'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function show(Department $department)
    {
        return redirect()->route('department.index');
    }

    public function edit(Department $department)
    {
        if(\Auth::user()->can('Edit Department'))
        {
            if($department->created_by == \Auth::user()->creatorId())
            {
                $branch = Branch::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');

                return view('department.edit', compact('department', 'branch'));
            }
            else
            {
                return response()->json(['error' => __('Permission denied.')], 401);
            }
        }
        else
        {
            return response()->json(['error' => __('Permission denied.')], 401);
        }
    }

    public function update(Request $request, Department $department)
    {
        if(\Auth::user()->can('Edit Department'))
        {
            if($department->created_by == \Auth::user()->creatorId())
            {
                $validator = \Validator::make(
                    $request->all(), [
                                       'branch_id' => 'required',
                                       'name' => 'required|max:20',
                                   ]
                );
                if($validator->fails())
                {
                    $messages = $validator->getMessageBag();

                    return redirect()->back()->with('error', $messages->first());
                }

                $department->branch_id = $request->branch_id;
                $department->name      = $request->name;
                $department->save();

                return redirect()->route('department.index')->with('success', __('Department successfully updated.'));
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

    public function destroy(Department $department)
    {
        if(\Auth::user()->can('Delete Department'))
        {
            if($department->created_by == \Auth::user()->creatorId())
            {
                $jbrs = \App\Jbr::where("designation_id",$department->id)->get();
                $desigs = \App\Designation::where("department_id",$department->id)->get();
                $emps = \App\Employee::where("department_id",$department->id)->get();
                if(count($jbrs) || count($desigs) || count($emps)) {
                  return redirect()->route('department.index')->with('error', __('Department is being used in app.'));
                } else {
                  $department->delete();
                }

                return redirect()->route('department.index')->with('success', __('Department successfully deleted.'));
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