<?php

namespace App\Http\Controllers;

use App\Employee;
use App\Leave;
use App\LeaveType;
use App\EmpPaygrades;
use App\EmpGradeAllowance;
use App\AllowanceOption;
use App\EmployeeManageLeave;
use App\Department;
use App\Designation;
use App\Mail\LeaveActionSend;
use App\Utility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use DB;
class DailyGradeController extends Controller
{
    public function index(Request $request)
    {




        if(\Auth::user()->can('Manage Monthly Grade'))
        {




            $monthly_grades = EmpPaygrades::Where("grade_type","Daily");
            if(!empty($request->grade_name))
            {

                $monthly_grades->where('grade_name', 'like', '%'.$request->al_name.'%');
            }

             if(!empty($request->grade_percentage))
             {

                 $monthly_grades->where('percentage',$request->grade_percentage);
             }
             $monthly_grades = $monthly_grades->paginate(10);
            return view('pay_grade.indexd', compact('monthly_grades'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function create()
    {
        if(\Auth::user()->can('Manage Monthly Grade'))
        {

            $grade_type="Daily";
            $allowanceOption=AllowanceOption::all();
            return view('pay_grade.created', compact('grade_type','allowanceOption'));
        }
        else
        {
            return response()->json(['error' => __('Permission denied.')], 401);
        }
    }

    public function store(Request $request)
    {


      //dd($request);

        if(\Auth::user()->can('Manage Monthly Grade'))
        {
            $validator = \Validator::make(
                $request->all(), [
                                   'grade_name' => 'required|unique:emp_paygrades,grade_name',
                                   'grade_type' => 'required',
                                   'gross_salary' => 'required',
                                   'basic_salary' => 'required',
                                   'percentage' => 'required',
                                   'overtime' => 'required',
                                   'allowence' => 'required',
                                   //'remark' => 'required',
                               ]
            );
            if($validator->fails())
            {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }

            $created_date_time=date("Y-m-d h:i:s");

            $emppaygrades             = new EmpPaygrades();

            $emppaygrades->grade_type       = $request->grade_type;
            $emppaygrades->grade_name       = $request->grade_name;
            $emppaygrades->gross_salary     = $request->gross_salary;
            $emppaygrades->basic_salary     = $request->basic_salary;
            $emppaygrades->percentage       = $request->percentage;
            $emppaygrades->overtime         = $request->overtime;
           // $emppaygrades->allowence        = $request->allowence;
            $emppaygrades->created_by       = \Auth::user()->creatorId();
            $emppaygrades->save();


            if($request->allowence)
            {
                foreach($request->allowence as $key=>$row)
                {
                    $empgradeallowance            = new EmpGradeAllowance();
                    $empgradeallowance->grade_id       = $emppaygrades->id;
                    $empgradeallowance->allowance_id   = $row;
                    $empgradeallowance->save();
                }
            }

            return redirect()->route('daily_grade.index')->with('success', __('Grade  successfully created.'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }






    public function edit($id)
    {


        if(\Auth::user()->can('Manage Monthly Grade'))
        {

                $emppaygrades  = EmpPaygrades::where('id', $id)->first();//dd($employees);
                $empgradeallowance  = EmpGradeAllowance::where('grade_id', $id)->get();
                $gradeallowance_array=array();
                if(!empty($empgradeallowance))
                {
                    foreach($empgradeallowance as $row)
                    {
                        $gradeallowance_array[]=$row->allowance_id;
                    }
                }
                $allowanceOption=AllowanceOption::all();
                return view('pay_grade.editd', compact('emppaygrades', 'gradeallowance_array','allowanceOption'));

        }
        else
        {
            return response()->json(['error' => __('Permission denied.')], 401);
        }
    }

    public function update(Request $request,$id)
    {
       // dd($request);

        $emppaygrades = EmpPaygrades::find($id);

        if(\Auth::user()->can('Manage Monthly Grade'))
        {
            if($emppaygrades->created_by == Auth::user()->creatorId())
            {
                $validator = \Validator::make(
                    $request->all(), [
                                        'grade_name' => 'required',
                                        'grade_type' => 'required',
                                        'gross_salary' => 'required',
                                        'basic_salary' => 'required',
                                        'percentage' => 'required',
                                        'overtime' => 'required',
                                        'allowence' => 'required',
                                   ]
                );
                if($validator->fails())
                {
                    $messages = $validator->getMessageBag();

                    return redirect()->back()->with('error', $messages->first());
                }


                $emppaygrades->grade_type       = $request->grade_type;
                $emppaygrades->grade_name       = $request->grade_name;
                $emppaygrades->gross_salary     = $request->gross_salary;
                $emppaygrades->basic_salary     = $request->basic_salary;
                $emppaygrades->percentage       = $request->percentage;
                $emppaygrades->overtime         = $request->overtime;
                $emppaygrades->save();


                EmpGradeAllowance::where('grade_id',$id)->delete();
                if($request->allowence)
                {
                    foreach($request->allowence as $key=>$row)
                    {
                        $empgradeallowance                 = new EmpGradeAllowance();
                        $empgradeallowance->grade_id       = $emppaygrades->id;
                        $empgradeallowance->allowance_id   = $row;
                        $empgradeallowance->save();
                    }
                }
                return redirect()->route('daily_grade.index')->with('success', __('Grade successfully updated.'));
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


        $emppaygrades = EmpPaygrades::find($id);
        if(\Auth::user()->can('Manage Monthly Grade'))
        {
            if($emppaygrades->created_by == \Auth::user()->creatorId())
            {
              $gdu = DB::table('employees')->where("pay_grade",$id)->get();
              if(count($gdu)) {
                return redirect()->route('daily_grade.index')->with('error', __('Grade is being used in app.'));
              } else {

                $emppaygrades->delete();

                EmpGradeAllowance::where("grade_id",$id)->delete();
                return redirect()->route('daily_grade.index')->with('success', __('Grade successfully deleted.'));
              }
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
