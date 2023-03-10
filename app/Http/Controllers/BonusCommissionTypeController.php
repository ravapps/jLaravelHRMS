<?php

namespace App\Http\Controllers;

use App\Branch;
use Illuminate\Http\Request;
use DB;
class BonusCommissionTypeController extends Controller
{
    public function index()
    {
        if(\Auth::user()->can('Manage Bonus Commission Type'))
        {
            $bonuses = DB::table("emp_commissionbonus_type")->where('created_by', '=', \Auth::user()->creatorId())->get();

            return view('bonus.index', compact('bonuses'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function create()
    {
        if(\Auth::user()->can('Create Bonus Commission Type'))
        {
            return view('bonus.create');
        }
        else
        {
            return response()->json(['error' => __('Permission denied.')], 401);
        }
    }

    public function store(Request $request)
    {
      //  dd($request);
        if(\Auth::user()->can('Create Bonus Commission Type'))
        {

            $validator = \Validator::make(
                $request->all(), [
                                    'name' => 'required|unique:emp_commissionbonus_type,name',
                               ]
            );
            if($validator->fails())
            {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }
            
            $created_date_time=date("Y-m-d h:i:s");
            $input=array(
                'name'          => $request->name,
                'cb_type'    =>  $request->bonus_type,
                'sal_type'   => $request->salary_type,
                'amount'        => $request->amount,
                'created_by'    => \Auth::user()->creatorId(),
                'created_at'    => $created_date_time

            );

            DB::table('emp_commissionbonus_type')->insert($input);

            return redirect()->route('bonuscommission.index')->with('success', __('Bonus Commission Type  successfully created.'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function show(Branch $branch)
    {
        return redirect()->route('bonuscommission.index');
    }

    public function edit($id)
    {
        if(\Auth::user()->can('Manage Bonus Commission Type'))
        {
            if(\Auth::user()->can('Manage Bonus Commission Type'))
            {
                $bonus = DB::table("emp_commissionbonus_type")->where('created_by', '=', \Auth::user()->creatorId())->where("id",$id)->first();
    
                return view('bonus.edit', compact('bonus'));
            }
            else
            {
                return redirect()->back()->with('error', __('Permission denied.'));
            }
        }
        else
        {
            return response()->json(['error' => __('Permission denied.')], 401);
        }
    }

    public function update(Request $request,$id)
    {
        if(\Auth::user()->can('Manage Bonus Commission Type'))
        {

            $bonus = DB::table("emp_commissionbonus_type")->where('created_by', '=', \Auth::user()->creatorId())->where("id",$id)->first();

            if($bonus->created_by == \Auth::user()->creatorId())
            {
                $validator = \Validator::make(
                    $request->all(), [
                                       'name' => 'required',
                                   ]
                );
                if($validator->fails())
                {
                    $messages = $validator->getMessageBag();

                    return redirect()->back()->with('error', $messages->first());
                }

                $input=array(
                    'name'          => $request->name,
                    'cb_type'    =>  $request->bonus_type,
                    'sal_type'   => $request->salary_type,
                    'amount'        => $request->amount,
               
                );
                DB::table('emp_commissionbonus_type')->where("id",$id)->update($input);

                return redirect()->route('bonuscommission.index')->with('success', __('Bonus Commission Type successfully updated.'));
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

    public function destroy($id)
    {
        if(\Auth::user()->can('Manage Bonus Commission Type'))
        {
                 DB::table('emp_commissionbonus_type')->where("id",$id)->delete();
                return redirect()->route('bonuscommission.index')->with('success', __('Bonus Commission Type successfully deleted.'));
          
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function getdepartment(Request $request)
    {

        if($request->branch_id == 0)
        {
            $departments = Department::get()->pluck('name', 'id')->toArray();
        }
        else
        {
            $departments = Department::where('branch_id', $request->branch_id)->get()->pluck('name', 'id')->toArray();
        }

        return response()->json($departments);
    }

    public function getemployee(Request $request)
    {
        if(in_array('0', $request->department_id))
        {
            $employees = Employee::get()->pluck('name', 'id')->toArray();
        }
        else
        {
            $employees = Employee::whereIn('department_id', $request->department_id)->get()->pluck('name', 'id')->toArray();
        }

        return response()->json($employees);
    }
}
