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
class MonthlyGradeController extends Controller
{
    public function index(Request $request)
    {




        if(\Auth::user()->can('Manage Monthly Grade'))
        {




            $monthly_grades = EmpPaygrades::Where("grade_type","Monthly");

            if(!empty($request->grade_name))
            {

                $monthly_grades->where('grade_name', 'like', '%'.$request->al_name.'%');
            }

             if(!empty($request->grade_percentage))
             {

                 $monthly_grades->where('percentage',$request->grade_percentage);
             }
             $monthly_grades = $monthly_grades->paginate(10);
            return view('pay_grade.index', compact('monthly_grades'));
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

            $grade_type="Monthly";
            $allowanceOption=AllowanceOption::all();
            return view('pay_grade.create', compact('grade_type','allowanceOption'));
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

            return redirect()->route('monthly_grade.index')->with('success', __('Grade  successfully created.'));
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
                return view('pay_grade.edit', compact('emppaygrades', 'gradeallowance_array','allowanceOption'));

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
                return redirect()->route('monthly_grade.index')->with('success', __('Grade successfully updated.'));
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
                return redirect()->route('monthly_grade.index')->with('error', __('Grade is being used in app.'));
              } else {

                $emppaygrades->delete();

                EmpGradeAllowance::where("grade_id",$id)->delete();
                return redirect()->route('monthly_grade.index')->with('success', __('Grade successfully deleted.'));
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

    public function action($id)
    {
        $leave     = Leave::find($id);
        $employee  = Employee::find($leave->employee_id);
        $leavetype = LeaveType::find($leave->leave_type_id);

        return view('leave.action', compact('employee', 'leavetype', 'leave'));
    }

    public function changeaction(Request $request)
    {

        $leave = Leave::find($request->leave_id);

        $leave->status = $request->status;
        if($leave->status == 'Approval')
        {
            $startDate               = new \DateTime($leave->start_date);
            $endDate                 = new \DateTime($leave->end_date);
           // $total_leave_days        = $startDate->diff($endDate)->days;
           // $leave->total_leave_days = $total_leave_days;
            $leave->status           = 'Approve';
        }

        $leave->save();

        $setings = Utility::settings();
        if($setings['leave_status'] == 1)
        {
            $employee     = Employee::where('id', $leave->employee_id)->where('created_by', '=', \Auth::user()->creatorId())->first();
            $leave->name  = !empty($employee->name) ? $employee->name : '';
            $leave->email = !empty($employee->email) ? $employee->email : '';
            try
            {
                Mail::to($leave->email)->send(new LeaveActionSend($leave));
            }
            catch(\Exception $e)
            {
                $smtp_error = __('E-Mail has been not sent due to SMTP configuration');
            }

            return redirect()->route('leave.index')->with('success', __('Leave status successfully updated.') . (isset($smtp_error) ? $smtp_error : ''));

        }

        return redirect()->route('leave.index')->with('success', __('Leave status successfully updated.'));
    }

    public function json(Request $request)
    {

        $emplyee_details = Employee::where('id',$request->emp_id)->first();//dd($emplyee_details);
        $get_depatment=Department::where('id', $emplyee_details->department_id)->first();
        $get_designations=Designation::where('id', $emplyee_details->designation_id)->first();


        $result=array("emplyee_details"=>$emplyee_details,"get_depatment"=>$get_depatment,"get_designations"=>$get_designations);

        return response()->json($result);
    }

    public function jsoncount(Request $request)
    {
//        $leave_counts = LeaveType::select(\DB::raw('COALESCE(SUM(leaves.total_leave_days),0) AS total_leave, leave_types.title, leave_types.days,leave_types.id'))->leftjoin(
//            'leaves', function ($join) use ($request){
//            $join->on('leaves.leave_type_id', '=', 'leave_types.id');
//            $join->where('leaves.employee_id', '=', $request->employee_id);
//        }
//        )->groupBy('leaves.leave_type_id')->get();

        $leave_counts = LeaveType::select(\DB::raw('COALESCE(SUM(leaves.total_leave_days),0) AS total_leave, leave_types.title, leave_types.days,leave_types.id'))
                                 ->leftjoin('leaves', function ($join) use ($request){
            $join->on('leaves.leave_type_id', '=', 'leave_types.id');
            $join->where('leaves.employee_id', '=', $request->employee_id);
        }
        )->groupBy('leaves.leave_type_id')->get();

        return $leave_counts;

    }

}
