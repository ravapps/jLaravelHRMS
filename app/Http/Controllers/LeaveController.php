<?php

namespace App\Http\Controllers;

use App\Employee;
use App\Leave;
use App\LeaveType;
use App\EmployeeManageLeave;
use App\Department;
use App\Designation;
use App\Mail\LeaveActionSend;
use App\Utility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use DB;
class LeaveController extends Controller
{
    public function index(Request $request)
    {


           

        if(\Auth::user()->can('Manage Leave'))
        {
           // $leaves = Leave::query();
           $leaves = Leave::where('created_by', '=', \Auth::user()->creatorId());
           

           if(!empty($request->date_selected))
           {
              
               $leaves->where('applied_on', date('Y-m-d', strtotime($request->date_selected)));
           }

            if(!empty($request->status_id))
            {
               
                $leaves->where('status', 'like', '%'.$request->status_id.'%');
            }

            if(!empty($request->employee_ids))
            {
                $leaves->where('employee_id', $request->employee_ids);
            }
            if(!empty($request->leave_type_id1))
            {
                $leaves->where('leave_type_id', $request->leave_type_id1);
            }
            $leaves = $leaves->paginate(10);

           // $leaves = Leave::where('created_by', '=', \Auth::user()->creatorId())->paginate(1);
            $employee = Employee::all();
            $departments = Department::all();
            $leavetypes = LeaveType::all();
            return view('leave.index', compact('leaves','employee','departments','leavetypes'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function create()
    {
        if(\Auth::user()->can('Create Leave'))
        {
            if(Auth::user()->type == 'employee')
            {
                $employees = Employee::where('user_id', '=', \Auth::user()->id)->get()->pluck('name', 'id');
            }
            else
            {
                $employees = Employee::where('created_by', '=', \Auth::user()->creatorId())->get();
            }
           
            $leavetypes      = LeaveType::where('created_by', '=', \Auth::user()->creatorId())->orderby("days","ASC")->get();
            

//            dd(Employee::employeeTotalLeave(1));
            return view('leave.create', compact('employees', 'leavetypes'));
        }
        else
        {
            return response()->json(['error' => __('Permission denied.')], 401);
        }
    }

    public function store(Request $request)
    {
        

        $get_employee_leave=EmployeeManageLeave::where("employee_id",$request->emp_id)->where("leave_type_id",$request->leave_type_id)->first();
        $get_pending_leave=Leave::where("employee_id",$request->emp_id)->where("status","Pending")->first();
        $leavetypes      = LeaveType::where("id",$request->leave_type_id)->first();
        if(\Auth::user()->can('Create Leave'))
        {
            $validator = \Validator::make(
                $request->all(), [
                                   'leave_type_id' => 'required',
                                   'start_date' => 'required',
                                   'end_date' => 'required',
                                   'leave_reason' => 'required',
                                   //'remark' => 'required',
                               ]
            );
            if($validator->fails())
            {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }

            if(!empty($get_pending_leave))
            {
               
                return redirect()->back()->with('error', "Your leave application already pending");
            }
            if(empty($get_employee_leave))
            {
               
               
                if(!empty($leavetypes)  && $leavetypes->leaves_days < $request->total_leave_days)
                {
                    return redirect()->back()->with('error', "Your leave is more than available leave");
                }
            }
            
            if(!empty($get_employee_leave)  && $get_employee_leave->total_leaves < $request->total_leave_days)
            {
                return redirect()->back()->with('error', "Your leave is more than available leave");
            }

            $employee = Employee::where('user_id', '=', Auth::user()->id)->first();
            $leave    = new Leave();
            if(\Auth::user()->type == "employee")
            {
                $leave->employee_id = $employee->id;
            }
            else
            {
                $leave->employee_id = $request->emp_id;
            }
            $leave->leave_type_id    = $request->leave_type_id;
            $leave->applied_on       = date('Y-m-d', strtotime($request->applied_on));
            $leave->start_date       = date('Y-m-d', strtotime($request->start_date));
            $leave->end_date         = date('Y-m-d', strtotime($request->end_date));
            $leave->from_time        = $request->from_time;
            $leave->end_time         = $request->end_time;
            $leave->country          = $request->country;
            $leave->city             = $request->city;
            $leave->total_leave_days = $request->total_leave_days;
            $leave->leave_reason     = $request->leave_reason;
            $leave->remark           = $request->remark;
            $leave->status           = 'Pending';
            $leave->created_by       = \Auth::user()->creatorId();

            $leave->save();



            $created_date_time=date("Y-m-d h:i:s");
            if($request->hasFile('multiple_files'))
            {
                foreach($request->multiple_files as $key => $document)
                {


                    $file = $request->file('multiple_files')[$key];
                    $filenameWithExt = $request->file('multiple_files')[$key]->getClientOriginalName();
                    $filename        = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                    $extension       = $request->file('multiple_files')[$key]->getClientOriginalExtension();
                    $fileNameToStore = $filename . '_' . time() . '.' . $extension;
                    $dir             = storage_path('uploads/document/');
                    $image_path      = $dir . $filenameWithExt;

                    $file->move(public_path().'/uploads/document/', $fileNameToStore);  

                    $input=array("leave_id"=>$leave->id,"image_name"=>$fileNameToStore,"created_at"=>$created_date_time);
                    DB::table('leave_document')->insert($input);
                    
                }

            }



            return redirect()->route('leave.index')->with('success', __('Leave  successfully created.'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function show(Leave $leave)
    {
        return redirect()->route('leave.index');
    }

    public function balance_leave(Request $request)
    {
        if(\Auth::user()->can('Manage Leave'))
        {
           
           $leaves = Leave::where('created_by', '=', \Auth::user()->creatorId());
         
         
            $leaves = $leaves->paginate(10);
            $employees1 = Employee::all();
            $employees = Employee::orderby("id","DESC");//dd($employees);
            if(!empty($request->employee_ids))
            {
                echo $request->employee_ids;
                $employees->where('id', $request->employee_ids);
            }
 
            if(!empty($request->department_id))
            {
                $employees->where('department_id', $request->department_id);
            }
            $employees = $employees->paginate(10);
            $departments = Department::all();
            $leavetypes = LeaveType::all();
            return view('leave.balance_leave', compact('leaves','employees','departments','leavetypes','employees1'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
        
    }


    public function leave_sumary()
    {
        if(\Auth::user()->can('Manage Leave'))
        {
           
           $leaves = Leave::where('created_by', '=', \Auth::user()->creatorId());
           $leaves->groupBy("leave_type_id");
            $leaves = $leaves->paginate(10);

            $employees = Employee::all();
            $departments = Department::all();
            $leavetypes = LeaveType::all();
            return view('leave.leave_sumary', compact('leaves','employees','departments','leavetypes'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
        
    }



    public function edit(Leave $leave)
    {

       //dd($leave);
        if(\Auth::user()->can('Edit Leave'))
        {
            if($leave->created_by == \Auth::user()->creatorId())
            {
                $employees  = Employee::where('id', $leave->employee_id)->first();//dd($employees);
                $leavetypes = LeaveType::where('created_by', '=', \Auth::user()->creatorId())->get();
                $leavetypes_single = LeaveType::where('id', $leave->leave_type_id)->first();
                $get_depatment=Department::where('id', $employees->department_id)->first();
                $get_designations=Designation::where('id', $employees->designation_id)->first();

                return view('leave.edit', compact('leave', 'employees', 'leavetypes','get_depatment','get_designations','leavetypes_single'));
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

    public function update(Request $request, $leave)
    {

        
        $leave = Leave::find($leave);

       
        $get_employee_leave=EmployeeManageLeave::where("employee_id",$leave->employee_id)->where("leave_type_id",$request->leave_type_id)->first();
        $leavetypes      = LeaveType::where("id",$request->leave_type_id)->first();
        if(empty($get_employee_leave))
            {
                if(!empty($leavetypes)  && $leavetypes->leaves_days < $request->total_leave_days)
                {
                    return redirect()->back()->with('error', "Your leave is more than available leave");
                }
            }
        if(!empty($get_employee_leave)  && $get_employee_leave->total_leaves < $request->total_leave_days)
        {
            return redirect()->back()->with('error', "Your leave is more than available leave");
        }

        if(\Auth::user()->can('Edit Leave'))
        {
            if($leave->created_by == Auth::user()->creatorId())
            {
                $validator = \Validator::make(
                    $request->all(), [
                                       'leave_type_id' => 'required',
                                       'start_date' => 'required',
                                       'end_date' => 'required',
                                       'leave_reason' => 'required',
                                       //'remark' => 'required',
                                   ]
                );
                if($validator->fails())
                {
                    $messages = $validator->getMessageBag();

                    return redirect()->back()->with('error', $messages->first());
                }

                $date        = \Auth::user()->created_at;
                $dateconvert = strtotime($date);
                $applied_on  = date('Y-m-d', $dateconvert);

                $leave->leave_type_id    = $request->leave_type_id;
                $leave->applied_on       = date('Y-m-d', strtotime($request->applied_on));
                $leave->start_date       = date('Y-m-d', strtotime($request->start_date));
                $leave->end_date         = date('Y-m-d', strtotime($request->end_date));
                $leave->from_time        = $request->from_time;
                $leave->end_time         = $request->end_time;
                $leave->country          = $request->country;
                $leave->city             = $request->city;
                $leave->total_leave_days = $request->total_leave_days;
                $leave->leave_reason     = $request->leave_reason;
                $leave->remark           = $request->remark;
                $leave->status           = 'Pending';
                $leave->created_by       = \Auth::user()->creatorId();

                $leave->save();

                return redirect()->route('leave.index')->with('success', __('Leave successfully updated.'));
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

    public function destroy(Leave $leave)
    {
        if(\Auth::user()->can('Delete Leave'))
        {
            if($leave->created_by == \Auth::user()->creatorId())
            {
                $leave->delete();
                
                DB::table('leave_document')->where("leave_id",$leave->id)->delete();
                return redirect()->route('leave.index')->with('success', __('Leave successfully deleted.'));
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
