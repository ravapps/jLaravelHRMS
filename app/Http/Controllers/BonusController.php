<?php

namespace App\Http\Controllers;

use App\Branch;
use Illuminate\Http\Request;
use App\Employee;
use DB;
class BonusController extends Controller
{
    public function index()
    {
        if(\Auth::user()->can('Manage Bonus'))
        {
            $bonuses = DB::table("emp_bonus")->join('emp_commissionbonus_type', 'emp_bonus.bonus_id', '=', 'emp_commissionbonus_type.id')->join('employees', 'emp_bonus.employee_id', '=', 'employees.id')->select('emp_bonus.*', 'emp_commissionbonus_type.name','emp_commissionbonus_type.amount','employees.first_name','employees.last_name')->where('emp_bonus.created_by', '=', \Auth::user()->creatorId())->get();

            return view('bonus_employee.index', compact('bonuses'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function create()
    {
        if(\Auth::user()->can('Create Bonus'))
        {

            $employees  = Employee::where('created_by', '=', \Auth::user()->creatorId())->get();
            $commission_types  = DB::table("emp_commissionbonus_type")->where('cb_type',"Bonus")->get();
            return view('bonus_employee.create',compact('employees','commission_types'));
        }
        else
        {
            return response()->json(['error' => __('Permission denied.')], 401);
        }
    }

    public function store(Request $request)
    {
      //  dd($request);
        if(\Auth::user()->can('Create Bonus'))
        {

            $validator = \Validator::make(
                $request->all(), [
                            'employee_id' => 'required|unique:emp_bonus,employee_id',
                            'amount' => 'required',
                               ]
            );
            if($validator->fails())
            {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }
            foreach($request->employee_id as $key=>$val)
            {
                $created_date_time=date("Y-m-d h:i:s");
                $input=array(
                    'employee_id'    => $val,
                    'bonus_id'      =>  $request->bonus_id,
                    'date_bonus'          => date('Y-m-d',strtotime($request->date_bn)),
                    'created_by'    => \Auth::user()->creatorId(),
                    'created_at'    => $created_date_time

                );

                DB::table('emp_bonus')->insert($input);
                
            }
            return redirect()->route('bonus.index')->with('success', __('Bonus successfully created.'));
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
        if(\Auth::user()->can('Manage Bonus'))
        {
            if(\Auth::user()->can('Manage Bonus'))
            {
                $bonus_amount='';$amounts=0;
                $employees  = Employee::where('created_by', '=', \Auth::user()->creatorId())->get();
                $commission_types  = DB::table("emp_commissionbonus_type")->where('cb_type',"Bonus")->get();
                $bonus  =  DB::table("emp_bonus")->where('id',$id)->first();
                $bonus_amount  = DB::table("emp_commissionbonus_type")->where('id',$bonus->bonus_id)->first();
                $amounts=$bonus_amount->amount;
                return view('bonus_employee.edit',compact('employees','commission_types','bonus','amounts'));
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
        if(\Auth::user()->can('Manage Bonus'))
        {

            $bonus = DB::table("emp_commissionbonus_type")->where('created_by', '=', \Auth::user()->creatorId())->where("id",$id)->first();

            if($bonus->created_by == \Auth::user()->creatorId())
            {
                $validator = \Validator::make(
                    $request->all(), [
                                       'amount' => 'required',
                                   ]
                );
                if($validator->fails())
                {
                    $messages = $validator->getMessageBag();

                    return redirect()->back()->with('error', $messages->first());
                }

                $input=array(
                    'bonus_id'      =>  $request->bonus_id,
               
                );
                DB::table('emp_bonus')->where("id",$id)->update($input);

                return redirect()->route('bonus.index')->with('success', __('Bonus successfully updated.'));
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
        if(\Auth::user()->can('Manage Bonus'))
        {
                 DB::table('emp_bonus')->where("id",$id)->delete();
                return redirect()->route('bonus.index')->with('success', __('Bonus successfully deleted.'));
          
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function json(Request $request)
    {
       
        $get_commissiontype=DB::table("emp_commissionbonus_type")->where("id",$request->bonus_id)->first();
        $salary_type=$bonus_amount='';
        if(!empty($get_commissiontype))
        {
            $salary_type=$get_commissiontype->sal_type;
            $bonus_amount=$get_commissiontype->amount;
        }
        $result=array("salary_type"=>$salary_type,'bonus_amount'=>$bonus_amount);
        return response()->json($result);
    }

}
