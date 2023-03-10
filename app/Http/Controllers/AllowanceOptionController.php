<?php

namespace App\Http\Controllers;

use App\AllowanceOption;
use Illuminate\Http\Request;

class AllowanceOptionController extends Controller
{
    public function index(Request $request)
    {
        if(\Auth::user()->can('Manage Allowance Option'))
        {
          //  $allowanceoptions = AllowanceOption::where('created_by', '=', \Auth::user()->creatorId())->get();
            $allowanceoptions = AllowanceOption::where('created_by', '=', \Auth::user()->creatorId());
            if(!empty($request->al_name))
            {

                $allowanceoptions->where('name', 'like', '%'.$request->al_name.'%');
            }

             if(!empty($request->status_id))
             {

                 $allowanceoptions->where('al_type', 'like', '%'.$request->al_type.'%');
             }

             if(!empty($request->al_percentage))
             {
                 $allowanceoptions->where('percentage', $request->al_percentage);
             }

             $allowanceoptions = $allowanceoptions->paginate(10);
            return view('allowanceoption.index', compact('allowanceoptions'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function create()
    {
        if(\Auth::user()->can('Create Allowance Option'))
        {
            return view('allowanceoption.create');
        }
        else
        {
            return response()->json(['error' => __('Permission denied.')], 401);
        }
    }

    public function store(Request $request)
    {
        if(\Auth::user()->can('Create Allowance Option'))
        {

            $validator = \Validator::make(
                $request->all(), [
                                   'name' => 'required|unique:allowance_options,name',
                               ]
            );
            if($validator->fails())
            {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }

            $allowanceoption             = new AllowanceOption();
            $allowanceoption->name       = $request->name;
            $allowanceoption->al_type       = $request->al_type;
            $allowanceoption->percentage       = $request->percentage;
            $allowanceoption->limit_month       = $request->limit_month;
            $allowanceoption->created_by = \Auth::user()->creatorId();
            $allowanceoption->save();

            return redirect()->route('allowanceoption.index')->with('success', __('AllowanceOption  successfully created.'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function show(AllowanceOption $allowanceoption)
    {
        return redirect()->route('allowanceoption.index');
    }

    public function edit(AllowanceOption $allowanceoption)
    {
        if(\Auth::user()->can('Edit Allowance Option'))
        {
            if($allowanceoption->created_by == \Auth::user()->creatorId())
            {

                return view('allowanceoption.edit', compact('allowanceoption'));
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

    public function update(Request $request, AllowanceOption $allowanceoption)
    {
        if(\Auth::user()->can('Edit Allowance Option'))
        {
            if($allowanceoption->created_by == \Auth::user()->creatorId())
            {
                $validator = \Validator::make(
                    $request->all(), [
                                       'name' => 'required|max:20',

                                   ]
                );

                if($validator->fails())
                {
                    $messages = $validator->getMessageBag();

                    return redirect()->back()->with('error', $messages->first());
                }
                $allowanceoption->name       = $request->name;
                $allowanceoption->al_type       = $request->al_type;
                $allowanceoption->percentage       = $request->percentage;
                $allowanceoption->limit_month       = $request->limit_month;
                $allowanceoption->save();

                return redirect()->route('allowanceoption.index')->with('success', __('AllowanceOption successfully updated.'));
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

    public function destroy(AllowanceOption $allowanceoption)
    {
        if(\Auth::user()->can('Delete Allowance Option'))
        {
            if($allowanceoption->created_by == \Auth::user()->creatorId())
            {
                $alw   = \App\EmpGradeAllowance::where("allowance_id",$allowanceoption->id)->get();
                if(count($alw)) {
                    return redirect()->route('allowanceoption.index')->with('error', __('Allowance Option is being used in app.'));
                } else {
                  $allowanceoption->delete();
              }

                return redirect()->route('allowanceoption.index')->with('success', __('AllowanceOption successfully deleted.'));
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
