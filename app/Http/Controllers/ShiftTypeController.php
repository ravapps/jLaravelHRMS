<?php

namespace App\Http\Controllers;

use App\Commission;
use App\Employee;
use App\ShiftTypes;
use Illuminate\Http\Request;
use DB;
class ShiftTypeController extends Controller
{



    public function index()
    {
        $usr = \Auth::user();
        if($usr->can('Shift Type'))
        {

            $get_shift=ShiftTypes::all();
            return view('shift_type.index',compact('get_shift'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }
    public function create()
    {
        if(\Auth::user()->can('Create Shift Type'))
        {



            return view('shift_type.create');
        }
        else
        {
            return response()->json(['error' => __('Permission denied.')], 401);
        }
    }

    public function store(Request $request)
    {

        if(\Auth::user()->can('Create Shift Type'))
        {
            $validator = \Validator::make(
                $request->all(), [
                                   'name' => 'required|unique:shift_types,name',
                                   'start_time' => 'required',
                                   'end_time' => 'required',
                               ]
            );
            if($validator->fails())
            {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }
            $created_date_time=date("Y-m-d h:i:s");
            $shifttypes              = new ShiftTypes();
            $shifttypes->name        = $request->name;
            $shifttypes->start_time  = $request->start_time;
            $shifttypes->end_time      = $request->end_time;
            $shifttypes->late_time      = $request->late_time;
            $shifttypes->weekdays      = $request->weekdays;
            $shifttypes->created_at   = $created_date_time;
            $shifttypes->created_by  = \Auth::user()->creatorId();
            $shifttypes->save();


            return redirect()->route('shift_type.index')->with('success', 'Shift name  successfully created.');
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

    public function edit($id)
    {
        $shift_type = ShiftTypes::find($id);
        if(\Auth::user()->can('Edit Shift Type'))
        {
            if($shift_type->created_by == \Auth::user()->creatorId())
            {

              //  $commission_types  = DB::table("emp_commissionbonus_type")->where('cb_type',"Commision")->get();
                return view('shift_type.edit', compact('shift_type'));
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



    public function update(Request $request,$id)
    {
        $shifttypes = ShiftTypes::find($id);
        if(\Auth::user()->can('Edit Shift Type'))
        {

            if($shifttypes->created_by == \Auth::user()->creatorId())
            {

                $validator = \Validator::make(
                    $request->all(), [

                                        'start_time' => 'required',
                                        'end_time' => 'required',
                                   ]
                );
                if($validator->fails())
                {
                    $messages = $validator->getMessageBag();

                    return redirect()->back()->with('error', $messages->first());
                }


                $shifttypes->name        = $request->name;
                $shifttypes->start_time  = $request->start_time;
                $shifttypes->end_time      = $request->end_time;
                $shifttypes->late_time      = $request->late_time;
                $shifttypes->weekdays      = $request->weekdays;
                $shifttypes->save();
                    return redirect()->route('shift_type.index')->with('success', 'Shift type  successfully updated.');
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
        $shifttypes = ShiftTypes::find($id);
        if(\Auth::user()->can('Shift Type'))
        {
            if($shifttypes->created_by == \Auth::user()->creatorId())
            {

              $roaster = DB::table("emp_roaster_shifts")->where("shift_type",$id)->get();
              $emps = \App\Employee::where("shift_type",$id)->get();
              if(count($roaster)  || count($emps)) {
                return redirect()->back()->with('error', __('Shfit is being used in app.'));
              } else {
                $shifttypes->delete();
              }
                return redirect()->back()->with('success', __('Shfit successfully deleted.'));
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
