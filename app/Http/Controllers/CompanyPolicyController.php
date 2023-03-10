<?php

namespace App\Http\Controllers;

use App\Branch;
use App\Department;
use App\Employee;
use App\CompanyPolicy;
use Illuminate\Http\Request;
use DB;
class CompanyPolicyController extends Controller
{

    public function index()
    {
        if(\Auth::user()->can('Manage Company Policy'))
        {
            $companyPolicy = CompanyPolicy::where('created_by', '=', \Auth::user()->creatorId())->get();

            return view('companyPolicy.index', compact('companyPolicy'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }


    public function create()
    {
        if(\Auth::user()->can('Create Company Policy'))
        {
            $department = Department::where('created_by', \Auth::user()->creatorId())->get();
            

            return view('companyPolicy.create', compact('department'));
        }
        else
        {
            return response()->json(['error' => __('Permission denied.')], 401);
        }
    }


    public function store(Request $request)
    {
        $created_date_time=date("Y-m-d h:i:s");
        if(\Auth::user()->can('Create Company Policy'))
        {
            $validator = \Validator::make(
                $request->all(), [
                                   'branch' => 'required',
                                   'title' => 'required',
                                   'attachment' => 'mimes:jpeg,png,jpg,gif,pdf,doc|max:20480',
                               ]
            );
            if($validator->fails())
            {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }
            $policy              = new CompanyPolicy();
            $policy->branch      = $request->branch;
            $policy->title       = $request->title;
            $policy->created_by  = \Auth::user()->creatorId();
            $policy->save();
            if($request->hasFile('images'))
            {
                $file = $request->file('images');
                foreach($file as $key => $document1)
                    {
                         //dd($document);
                        
                        $filenameWithExt = $request->file('images')[$key]->getClientOriginalName();
                        $filename        = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                        $extension       = $request->file('images')[$key]->getClientOriginalExtension();
                        $fileNameToStore = $filename . '_' . time() . '.' . $extension;
                        $dir             = storage_path('uploads/document/');
                        $image_path      = $dir . $filenameWithExt;
                        // $fileNameToStore1[]=$fileNameToStore;
                        $document1->move(public_path().'/uploads/document/', $fileNameToStore);  

                        $inputqua=array('policy_id' => $policy->id,
                        'image_name' => $fileNameToStore,
                        'created_at' => $created_date_time,
                        'created_by'=>\Auth::user()->creatorId());
                            DB::table('policy_images')->insert($inputqua);
                    }

            }


          

            return redirect()->route('company-policy.index')->with('success', __('Company policy successfully created.'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }


    public function show(CompanyPolicy $companyPolicy)
    {
        //
    }


    public function edit(CompanyPolicy $companyPolicy)
    {

        if(\Auth::user()->can('Edit Company Policy'))
        {
            $department = Department::where('created_by', \Auth::user()->creatorId())->get();
            return view('companyPolicy.edit', compact('department','companyPolicy'));
        }
        else
        {
            return response()->json(['error' => __('Permission denied.')], 401);
        }
    }


    public function update(Request $request, CompanyPolicy $companyPolicy)
    {
        $created_date_time=date("Y-m-d h:i:s");
        if(\Auth::user()->can('Create Company Policy'))
        {
            $validator = \Validator::make(
                $request->all(), [
                                   'branch' => 'required',
                                   'title' => 'required',
                                   
                               ]
            );
            if($validator->fails())
            {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }
            $companyPolicy->branch      = $request->branch;
            $companyPolicy->title       = $request->title;
            $companyPolicy->save();

            if($request->hasFile('images'))
            {
                $file = $request->file('images');
                foreach($file as $key => $document1)
                    {
                         //dd($document);
                        
                        $filenameWithExt = $request->file('images')[$key]->getClientOriginalName();
                        $filename        = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                        $extension       = $request->file('images')[$key]->getClientOriginalExtension();
                        $fileNameToStore = $filename . '_' . time() . '.' . $extension;
                        $dir             = storage_path('uploads/document/');
                        $image_path      = $dir . $filenameWithExt;
                        // $fileNameToStore1[]=$fileNameToStore;
                        $document1->move(public_path().'/uploads/document/', $fileNameToStore);  

                        $inputqua=array('policy_id' => $companyPolicy->id,
                        'image_name' => $fileNameToStore,
                        'created_at' => $created_date_time,
                        'created_by'=>\Auth::user()->creatorId());
                            DB::table('policy_images')->insert($inputqua);
                    }

            }


            

            return redirect()->route('company-policy.index')->with('success', __('Company policy successfully updated.'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }


    public function destroy(CompanyPolicy $companyPolicy)
    {

        if(\Auth::user()->can('Delete Document'))
        {
            if($companyPolicy->created_by == \Auth::user()->creatorId())
            {
                $companyPolicy->delete();
                DB::table('policy_images')->where("policy_id",$companyPolicy->id)->delete();
                $dir = storage_path('uploads/companyPolicy/');
                if(!empty($companyPolicy->attachment))
                {
                    unlink($dir . $companyPolicy->attachment);
                }

                return redirect()->route('company-policy.index')->with('success', __('Company policy successfully deleted.'));
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


    public function delete_image_policy(Request $request)
    {
        
        DB::table('policy_images')->where("id",$request->image_id)->where("policy_id",$request->docs_id)->delete();
        $url_send=url("company-policy")."/".$request->docs_id.'/edit';
        $result=array("docs_id"=>$url_send);
        return response()->json($result);
    }


    public function delete_assign_emp(Request $request)
    {
        
        DB::table('assign_emp_document')->where("id",$request->docs_id)->where("document_id",$request->image_id)->delete();
        $url_send=url("company-policy/assign")."/".$request->image_id;
        $result=array("docs_id"=>$url_send);
        return response()->json($result);
    }


    public function assign_member(Request $request)
    {
       
        $created_date_time=date("Y-m-d h:i:s");
        foreach($request->employee_id as $key=>$val)
        {
            $inputqua=array('document_id' => $request->docs_ids,
            'employee_id' => $val,
            'read_flag' => "0",
            'created_at' => $created_date_time,
            'created_by'=>\Auth::user()->creatorId());
            DB::table('assign_emp_policy')->insert($inputqua);
        }
        return redirect('company-policy/assign/'.$request->docs_ids)->with('success', __('Policy assigned successfully.'));
    }

    public function assign($id)
    {
        $employees=Employee::all();
        $ge_employee_name=DB::table('assign_emp_policy')->join('employees', 'assign_emp_policy.employee_id', '=', 'employees.id')->select('assign_emp_policy.*', 'employees.name')->where("assign_emp_policy.document_id",$id)->get();
        $get_employee_id=array();
        if(!empty($ge_employee_name))
        {
            foreach($ge_employee_name as $row)
            {
                $get_employee_id[]=$row->employee_id;
            }
        }
        $docs_ids=$id;
        return view('companyPolicy.assign', compact('employees','ge_employee_name','get_employee_id','docs_ids'));
    }
}
