<?php

namespace App\Http\Controllers;

use App\Commission;
use App\Employee;
use Illuminate\Http\Request;
use DB;
class CommissionController extends Controller
{



    public function index()
    {
        $usr = \Auth::user();
        if($usr->can('Commission'))
        {
           
            $get_commission=Commission::join('emp_commissionbonus_type', 'commissions.title', '=', 'emp_commissionbonus_type.id')->select('commissions.*', 'emp_commissionbonus_type.name','emp_commissionbonus_type.amount')->get();
            return view('commission.index',compact('get_commission'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }
    public function create()
    {
        if(\Auth::user()->can('Create Commission'))
        {
            $employees  = Employee::where('created_by', '=', \Auth::user()->creatorId())->get();
            $commission_types  = DB::table("emp_commissionbonus_type")->where('cb_type',"Commision")->get();
            

            return view('commission.create', compact('employees','commission_types'));
        }
        else
        {
            return response()->json(['error' => __('Permission denied.')], 401);
        }
    }

    public function store(Request $request)
    {

        if(\Auth::user()->can('Create Commission'))
        {
            $validator = \Validator::make(
                $request->all(), [
                                   'employee_id' => 'required|unique:commissions,employee_id',
                                   'title' => 'required',
                                   'amount' => 'required',
                               ]
            );
            if($validator->fails())
            {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }
            $fileNameToStore1='';
            $fileNameToStore='';
            if($request->hasFile('documents'))
            {
                $file = $request->file('documents');
                foreach($file as $key => $document)
                     {
                         //dd($document);
                        
                    $filenameWithExt = $request->file('documents')[$key]->getClientOriginalName();
                    $filename        = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                    $extension       = $request->file('documents')[$key]->getClientOriginalExtension();
                    $fileNameToStore = $filename . '_' . time() . '.' . $extension;
                    $dir             = storage_path('uploads/document/');
                    $image_path      = $dir . $filenameWithExt;
                    $fileNameToStore1[]=$fileNameToStore;
                    $document->move(public_path().'/uploads/document/', $fileNameToStore);  
                     }

            }
            if(!empty($fileNameToStore1))
            {
                $fileNameToStore1=implode("#", $fileNameToStore1);
            }
           

            foreach($request->employee_id as $key=>$val)
            {
                
                $commission              = new Commission();
                $commission->employee_id = $val;
                $commission->title       = $request->title;
                $commission->amount      = $request->amount;
                $commission->remark      = $request->remark;
                $commission->status      = $request->status;
                $commission->documents      = trim($fileNameToStore1,"#");
                $commission->created_by  = \Auth::user()->creatorId();
                $commission->save();
            }
            
            return redirect()->route('commission.index')->with('success', 'Commission  successfully created.');
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function show(Commission $commission)
    {
        return redirect()->route('commision.index');
    }

    public function edit($commission)
    {
        $commission = Commission::find($commission);
        if(\Auth::user()->can('Edit Commission'))
        {
            if($commission->created_by == \Auth::user()->creatorId())
            {
                $employees  = Employee::where('created_by', '=', \Auth::user()->creatorId())->get();
                $commission_types  = DB::table("emp_commissionbonus_type")->where('cb_type',"Commision")->get();
                return view('commission.edit', compact('commission','employees','commission_types'));
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


    public function delete_docs($id)
    {
       
        $commission = Commission::find($id);
        $commission->documents  = '';
        $commission->save();
     //   return redirect()->route('commission.edit')->with('success', 'document  successfully deleted.');
        return redirect('commission/'.$id.'/edit')->with('success', 'document  successfully deleted.');
    }

    public function json(Request $request)
    {
       
    $get_commissiontype=DB::table("emp_commissionbonus_type")->where("id",$request->commission_id)->first();
    $salary_type=$commission_amount='';
        if(!empty($get_commissiontype))
        {
            $salary_type=$get_commissiontype->sal_type;
            $commission_amount=$get_commissiontype->amount;
        }
        $result=array("salary_type"=>$salary_type,'commission_amount'=>$commission_amount);
        return response()->json($result);
    }

    
    public function update(Request $request, Commission $commission)
    {
       // dd($request);
        if(\Auth::user()->can('Edit Commission'))
        {
            if($commission->created_by == \Auth::user()->creatorId())
            {
                $validator = \Validator::make(
                    $request->all(), [

                                       'title' => 'required',
                                       'amount' => 'required',
                                   ]
                );
                if($validator->fails())
                {
                    $messages = $validator->getMessageBag();

                    return redirect()->back()->with('error', $messages->first());
                }
               
                if($request->hasFile('documents'))
                {
                        $file = $request->file('documents');
                        
                        $filenameWithExt = $request->file('documents')->getClientOriginalName();
                        $filename        = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                        $extension       = $request->file('documents')->getClientOriginalExtension();
                        $fileNameToStore = $filename . '_' . time() . '.' . $extension;
                        $dir             = storage_path('uploads/document/');
                        $image_path      = $dir . $filenameWithExt;
                        
                        $file->move(public_path().'/uploads/document/', $fileNameToStore);  
                        
    
                }
                else
                {
                    $fileNameToStore= $commission->documents;
                }
                    
                   
                    $commission->employee_id = $request->employee_id;
                    $commission->title       = $request->title;
                    $commission->amount      = $request->amount;
                    $commission->remark      = $request->remark;
                    $commission->status      = $request->status;
                    $commission->documents   = $fileNameToStore;
                    $commission->save();

                    return redirect()->route('commission.index')->with('success', 'Commission  successfully updated.');
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

    public function destroy(Commission $commission)
    {

        if(\Auth::user()->can('Delete Commission'))
        {
            if($commission->created_by == \Auth::user()->creatorId())
            {

                $commission->delete();

                return redirect()->back()->with('success', __('Commission successfully deleted.'));
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
