<?php

namespace App\Http\Controllers;

use App\Branch;
use App\Department;
use App\Designation;
use App\Document;
use App\Employee;
use App\EmployeeDocument;
use App\EmpIncrement;
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

class IncrementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        $permissions = \Auth::user()->getAllPermissions();

//print_r($permissions);exit;
        if(\Auth::user()->can('Manage Increment'))
        {
           
                $increments = EmpIncrement::where('created_by', \Auth::user()->creatorId())->get();
          //  dd($increments);

            return view('increment.index', compact('increments'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function create()
    {
       
        if(\Auth::user()->can('Manage Increment'))
        {
           
            $employees        = Employee::where('created_by', \Auth::user()->creatorId())->get();
           

            return view('increment.create', compact('employees'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function store(Request $request)
    {

       
        if(\Auth::user()->can('Manage Increment'))
        {

            $created_date_time=date("Y-m-d h:i:s");
            $validator = \Validator::make(
                $request->all(), [
                                
                                   'emp_ids' => 'required',
                                   'department_id' => 'required',
                                   'designation_id' => 'required',
                                   'joining_date' => 'required',
                                   'salary_type' => 'required',
                                   'previous_salary' => 'required',
                                   'increment_date' => 'required',
                                   'increment_percent' => 'required',
                                   
                               ]
            );
            if($validator->fails())
            {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first())->withinput();
            }

            

           

            $empIncrement = EmpIncrement::create(
                [
                    'employee_id' => $request->emp_ids,
                    'department_id' => $request->department_id,
                    'designation_id' => $request->designation_id,
                    'joining_date' => date('Y-m-d', strtotime($request->joining_date)),
                    'salary_type' => $request->salary_type,
                    'grade_id' => $request->grade_id,
                    'previous_salary' => $request->previous_salary,
                    'increment_date' => date('Y-m-d', strtotime($request->increment_date)),
                    'increment_percent' => $request->increment_percent,
                    'created_by' => \Auth::user()->creatorId(),
                ]
            );

            return redirect()->route('increment.index')->with('success', __('Increment  successfully created.'));

        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function edit($id)
    {
       
        $id = Crypt::decrypt($id);
        if(\Auth::user()->can('Manage Increment'))
        { 
          
            $increments = EmpIncrement::find($id);
            
            $get_employee = Employee::where('id', $increments->employee_id)->first();
            $employee_slary    = DB::table("emp_slary_info")->where("user_id",$get_employee->user_id)->first();
            $designations = Designation::where('id', $get_employee->designation_id)->first();
            $department =   Department::where('id', $get_employee->department_id)->first();

            return view('increment.edit', compact('increments','employee_slary','designations','department','get_employee'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function update(Request $request, $id)
    {

        if(\Auth::user()->can('Manage Increment'))
        {
            $validator = \Validator::make(
             
                $request->all(), [
                    'emp_ids' => 'required',
                    'department_id' => 'required',
                    'designation_id' => 'required',
                    'joining_date' => 'required',
                    'salary_type' => 'required',
                    'previous_salary' => 'required',
                    'increment_date' => 'required',
                    'increment_percent' => 'required',
                 ]
            );
            if($validator->fails())
            {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }


            $input=array(
            'department_id' => $request->department_id,
            'designation_id' => $request->designation_id,
            'joining_date' => date('Y-m-d', strtotime($request->joining_date)),
            'salary_type' => $request->salary_type,
            'grade_id' => $request->grade_id,
            'previous_salary' => $request->previous_salary,
            'increment_date' => date('Y-m-d', strtotime($request->increment_date)),
            'increment_percent' => $request->increment_percent,
            
           );
         
            DB::table('emp_increments')->where("id",$id)->update($input);

                return redirect()->route('increment.index')->with('success', 'Increments successfully updated.');
            

        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function destroy($id)
    {

        if(Auth::user()->can('Manage Increment'))
        {

            
            DB::table('emp_increments')->where("id",$id)->delete();
         

            return redirect()->route('increment.index')->with('success', 'Increment successfully deleted.');
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }

    }

    public function show($id)
    {

        if(\Auth::user()->can('Show Employee'))
        {
            $empId        = Crypt::decrypt($id);
            $documents    = Document::where('created_by', \Auth::user()->creatorId())->get();
            $branches     = Branch::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
            $departments  = Department::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
            $designations = Designation::where('created_by', \Auth::user()->creatorId())->get()->pluck('name');
            $employee     = Employee::find($empId);
            $employeesId  = \Auth::user()->employeeIdFormat($employee->employee_id);
            $employee_personal_info= DB::table("emp_personal_info")->where("user_id",$employee->user_id)->first();
            $employee_primary= DB::table("emp_primary_details")->where("user_id",$employee->user_id)->first();
            $employee_secondry= DB::table("emp_secondry_details")->where("user_id",$employee->user_id)->first();
            $employee_bank= DB::table("emp_bank_info")->where("user_id",$employee->user_id)->first();
            $employee_family= DB::table("emp_family_info")->where("user_id",$employee->user_id)->first();

            $employee_salary= DB::table("emp_slary_info")->where("user_id",$employee->user_id)->first();
            $employee_cpf= DB::table("emp_cpf_info")->where("user_id",$employee->user_id)->first();


            return view('employee.show', compact('employee', 'employeesId', 'branches', 'departments', 'designations', 'documents','employee_personal_info','employee_primary','employee_secondry','employee_bank','employee_family','employee_salary','employee_cpf'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function json(Request $request)
    {
        

        $get_employee = Employee::where('id', $request->emp_ids)->first();
        $employee_slary    = DB::table("emp_slary_info")->where("user_id",$get_employee->user_id)->first();
        $designations = Designation::where('id', $get_employee->designation_id)->first();
        $department =   Department::where('id', $get_employee->department_id)->first();
        $grad_type =  DB::table("emp_paygrades")->where("id",$get_employee->pay_grade)->first();
      

        $html=$html1=$html12='';

        if($department)
        {
            
            $html.='<option value="'.$department->id.'">'.$department->name.'</option>';
            
        }
        if($designations)
        {
            
            $html1.='<option value="'.$designations->id.'">'.$designations->name.'</option>';
            
        }
        if($grad_type)
        {
            
            $html12.='<option value="'.$grad_type->id.'">'.$grad_type->grade_name.'</option>';
            
        }
        $result=array("salary_type"=>$employee_slary->salary_type,"salary_amount"=>$employee_slary->salary_amount,"joining"=>date('d-m-Y', strtotime($get_employee->company_doj)),"html"=>$html,"html1"=>$html1,"html12"=>$html12);
        return response()->json($result);

       
    }
   

    function employeeNumber()
    {
        $latest = Employee::where('created_by', '=', \Auth::user()->creatorId())->latest()->first();
        if(!$latest)
        {
            return 1;
        }

        return $latest->employee_id + 1;
    }

    public function profile(Request $request)
    {
        if(\Auth::user()->can('Manage Employee Profile'))
        {
            $employees = Employee::where('created_by', \Auth::user()->creatorId());
            if(!empty($request->branch))
            {
                $employees->where('branch_id', $request->branch);
            }
            if(!empty($request->department))
            {
                $employees->where('department_id', $request->department);
            }
            if(!empty($request->designation))
            {
                $employees->where('designation_id', $request->designation);
            }
            $employees = $employees->get();

            $brances = Branch::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
            $brances->prepend('All', '');

            $departments = Department::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
            $departments->prepend('All', '');

            $designations = Designation::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
            $designations->prepend('All', '');

            return view('employee.profile', compact('employees', 'departments', 'designations', 'brances'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }


    public function profileShow($id)
    {
        if(\Auth::user()->can('Show Employee Profile'))
        {
            $empId        = Crypt::decrypt($id);
            $documents    = Document::where('created_by', \Auth::user()->creatorId())->get();
            $branches     = Branch::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
            $departments  = Department::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
            $designations = Designation::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
            $employee     = Employee::find($empId);
            $employeesId  = \Auth::user()->employeeIdFormat($employee->employee_id);

            return view('employee.show', compact('employee', 'employeesId', 'branches', 'departments', 'designations', 'documents'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function lastLogin()
    {
        $users = User::where('created_by', \Auth::user()->creatorId())->get();

        return view('employee.lastLogin', compact('users'));
    }

    public function employeeJson(Request $request)
    {
        $employees = Employee::where('branch_id', $request->branch)->get()->pluck('name', 'id')->toArray();

        return response()->json($employees);
    }


    public function manage_leave($id)
    {
       
        $id = Crypt::decrypt($id);
        if(\Auth::user()->can('Manage Leave Employee'))
        { 
           

//dd($employee_qalification1);
            return view('employee.manage_leave', compact('employee', 'employeesId', 'branches', 'departments', 'designations', 'documents','employee_personal','employee_primary','employee_secondry','employee_family','employee_experience','employee_bank','employee_slary','employee_cpf','employee_qalification1','employee_license1','employee_it1','employee_certificates1','employee_skills1','extra_text'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

}
