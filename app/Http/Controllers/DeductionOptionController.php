<?php

namespace App\Http\Controllers;

use App\DeductionOption;
use Illuminate\Http\Request;
use DB;

class DeductionOptionController extends Controller
{
    public function index()
    {
        if(\Auth::user()->can('Manage Deduction Option'))
        {
            $deductionoptions = DeductionOption::where('created_by', '=', \Auth::user()->creatorId())->get();

            return view('deductionoption.index', compact('deductionoptions'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function create()
    {
        if(\Auth::user()->can('Create Deduction Option'))
        {
            return view('deductionoption.create');
        }
        else
        {
            return response()->json(['error' => __('Permission denied.')], 401);
        }
    }

    public function store(Request $request)
    {
        if(\Auth::user()->can('Create Deduction Option'))
        {

            $validator = \Validator::make(
                $request->all(), [
                                   'name' => 'required',
                                   'deduct_amt' => 'required',
                                ]
            );
            if($validator->fails())
            {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }

            $deductionoption             = new DeductionOption();
            $deductionoption->name       = $request->name;
            $deductionoption->deduct_amt = $request->deduct_amt;
            $deductionoption->created_by = \Auth::user()->creatorId();
            $deductionoption->save();

            return redirect()->route('deductionoption.index')->with('success', __('DeductionOption  successfully created.'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function show(DeductionOption $deductionoption)
    {
        return redirect()->route('deductionoption.index');
    }

    public function edit($deductionoption)
    {
        $deductionoption = DeductionOption::find($deductionoption);
        if(\Auth::user()->can('Edit Deduction Option'))
        {
            if($deductionoption->created_by == \Auth::user()->creatorId())
            {

                return view('deductionoption.edit', compact('deductionoption'));
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

    public function update(Request $request, DeductionOption $deductionoption)
    {
        if(\Auth::user()->can('Edit Deduction Option'))
        {
            if($deductionoption->created_by == \Auth::user()->creatorId())
            {
                $validator = \Validator::make(
                    $request->all(), [
                                       'name' => 'required',
                                       'deduct_amt' => 'required',
                                   ]
                );

                if($validator->fails())
                {
                    $messages = $validator->getMessageBag();

                    return redirect()->back()->with('error', $messages->first());
                }
                $deductionoption->name = $request->name;
                $deductionoption->deduct_amt = $request->deduct_amt;
                $deductionoption->save();

                return redirect()->route('deductionoption.index')->with('success', __('DeductionOption successfully updated.'));
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

    public function destroy(DeductionOption $deductionoption)
    {
        if(\Auth::user()->can('Delete Deduction Option'))
        {
            if($deductionoption->created_by == \Auth::user()->creatorId())
            {
                $employee_deduction   = DB::table("emp_deductions")->where("deduction_id",$deductionoption->id)->get();
                if(count($employee_deduction) > 0) {
                  return redirect()->route('deductionoption.index')->with('error', __('Deduction Option is being used in app.'));
                } else {
                  $deductionoption->delete();
                }


                return redirect()->route('deductionoption.index')->with('success', __('Deduction Option successfully deleted.'));
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
