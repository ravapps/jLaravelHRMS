<?php

namespace App\Http\Controllers;


use App\Employee;
use App\ShiftTypes;
use App\EmpRoasterShifts;
use Illuminate\Http\Request;
use DB;


use App\Exports\RoasterExport;
use Maatwebsite\Excel\Facades\Excel;


class RoasterController extends Controller
{

public function export(Request $request)
{

  //echo "here";
  //exit();
  $expvar = new RoasterExport;
  if($request->employee_id == '') {
    $expvar->employee = "all";
  } else {
    $expvar->employee = $request->employee_id;
  }
  $expvar->fromdate = date("Y-m-d",strtotime($request->fromdate));
  $expvar->todate =  date("Y-m-d",strtotime($request->todate));
  return Excel::download($expvar, 'Report.xlsx');

}


      public function show($id)

      {



        $usr = \Auth::user();
        if($usr->can('Roaster'))
        {


          $rawqry = "SELECT a.name as empname,a.designation_id as desid,a.worker_id,c.id as shiftid, b.id as roasterid, c.*,b.* from employees a,emp_roaster_shifts b,shift_types c where ";
          $rawqry = $rawqry." ( a.id = b.employee_id ";
          $rawqry = $rawqry." AND b.shift_type = c.id ) ";
          if($id <> "all")
          $rawqry = $rawqry." AND (a.id =  ".$id.") ";

          $get_data= DB::select(DB::raw($rawqry ));


            $employees  = Employee::where('created_by', '=', \Auth::user()->creatorId())->get();
            $get_shift=EmpRoasterShifts::with('employee','shift_name')->get();
            return view('roaster.index',compact('id','get_data','get_shift','employees'));

        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
      }


    public function index()
    {
    //  echo ($request->employee_id);
      //exit();
        $usr = \Auth::user();
        if($usr->can('Roaster'))
        {


          $rawqry = "SELECT a.name as empname,a.designation_id as desid,a.worker_id,c.id as shiftid, b.id as roasterid, c.*,b.* from employees a,emp_roaster_shifts b,shift_types c where ";
              $rawqry = $rawqry." ( a.id = b.employee_id ";
              $rawqry = $rawqry." AND b.shift_type = c.id ) ";
              // echo $rawqry;
              //$rawqry = $rawqry." AND (employees.id =  ".$id.") ";
              $get_data= DB::select(DB::raw($rawqry ));
//var_dump($get_data);
            $employees  = Employee::where('created_by', '=', \Auth::user()->creatorId())->get();
            $get_shift=EmpRoasterShifts::with('employee','shift_name')->get();
            return view('roaster.index',compact('get_data','get_shift','employees'));

        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function list()

   {

       $usr = \Auth::user();

       if($usr->can('Roaster'))

       {

           $get_shift=EmpRoasterShifts::with('employee','shift_name')->get();

           return view('roaster.list',compact('get_shift'));

       }

       else

       {

           return redirect()->back()->with('error', __('Permission denied.'));

       }

   }


    public function create()
    {
        if(\Auth::user()->can('Create Roaster'))
        {

            $employees=Employee::all();
            $get_shift=ShiftTypes::all();
            return view('roaster.create',compact('employees','get_shift'));
        }
        else
        {
            return response()->json(['error' => __('Permission denied.')], 401);
        }
    }

    public function store(Request $request)
    {

        if(\Auth::user()->can('Create Roaster'))
        {
            $validator = \Validator::make(
                $request->all(), [
                                   'employee_id' => 'required',
                                   'from_date' => 'required',
                                   'to_date' => 'required',
                                   'shift_type' => 'required'
                               ]
            );
            $rawqry = "SELECT * from emp_roaster_shifts where ( ('".date("Y-m-d",strtotime($request->from_date))."' BETWEEN from_date and to_date) OR ('".date("Y-m-d",strtotime($request->to_date))."' BETWEEN from_date and to_date) OR (from_date BETWEEN '".date("Y-m-d",strtotime($request->from_date))."' and '".date("Y-m-d",strtotime($request->to_date))."') OR (to_date BETWEEN '".date("Y-m-d",strtotime($request->from_date))."' and '".date("Y-m-d",strtotime($request->to_date))."') ) AND (employee_id =  ".$request->employee_id.") ";
            $get_data= DB::select(DB::raw($rawqry ));
            //var_dump($get_data);
            //exit();
            if(!empty($get_data))
            {
                return redirect()->route('roaster.create')->with('error', 'On that same day, an employee does not work multiple shifts.');
            }
            //

            if($validator->fails())
            {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }
            $created_date_time=date("Y-m-d h:i:s");
            $emproastershifts              = new EmpRoasterShifts();
            $emproastershifts->employee_id        = $request->employee_id;
            $emproastershifts->from_date  = date("Y-m-d",strtotime($request->from_date));
            $emproastershifts->to_date      = date("Y-m-d",strtotime($request->to_date));
            $emproastershifts->shift_type      = $request->shift_type;
            $emproastershifts->siteid      = $request->siteid;
            $emproastershifts->cid      = $request->cid;
            $emproastershifts->weekdays      = $request->weekdays;
            $emproastershifts->created_at   = $created_date_time;
            $emproastershifts->created_by  = \Auth::user()->creatorId();
            $emproastershifts->save();


            return redirect()->route('roaster.index')->with('success', 'Roaster shift name  successfully created.');
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }



    public function edit($id)
    {

        $emproastershifts = EmpRoasterShifts::find($id);
        if(\Auth::user()->can('Edit Roaster'))
        {
            if($emproastershifts->created_by == \Auth::user()->creatorId())
            {

                $employees=Employee::all();
                $get_shift=ShiftTypes::all();
                return view('roaster.edit', compact('emproastershifts','employees','get_shift'));
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

        $emproastershifts = EmpRoasterShifts::find($id);

        if(1) //if(\Auth::user()->can('Edit Roaster'))
        {

            if(1) //if($emproastershifts->created_by == \Auth::user()->creatorId())
            {

                /* $validator = \Validator::make(
                    $request->all(), [

                        'employee_id' => 'required',
                        'from_date' => 'required',
                        'to_date' => 'required',
                                   ]
                );
                if($validator->fails())
                {
                    $messages = $validator->getMessageBag();

                    return redirect()->back()->with('error', $messages->first());
                } */

                $rawqry = "SELECT * from emp_roaster_shifts where ( ('".date("Y-m-d",strtotime($request->from_date))."' BETWEEN from_date and to_date) OR ('".date("Y-m-d",strtotime($request->to_date))."' BETWEEN from_date and to_date) OR (from_date BETWEEN '".date("Y-m-d",strtotime($request->from_date))."' and '".date("Y-m-d",strtotime($request->to_date))."') OR (to_date BETWEEN '".date("Y-m-d",strtotime($request->from_date))."' and '".date("Y-m-d",strtotime($request->to_date))."') ) AND (employee_id =  ".$emproastershifts->employee_id." AND id <> ".$emproastershifts->id." )   ";
                $get_data= DB::select(DB::raw($rawqry ));
                //var_dump($get_data);
                //exit();
                if(!empty($get_data))
                {
                    return redirect()->route('roaster.list')->with('error', 'On that same day, an employee does not work multiple shifts.');
                }

                $emproastershifts->from_date  = date("Y-m-d",strtotime($request->from_date));
                $emproastershifts->to_date      = date("Y-m-d",strtotime($request->to_date));
                //$emproastershifts->shift_type      = $request->shift_type;
                $emproastershifts->siteid      = $request->siteid;
                $emproastershifts->cid      = $request->cid;
                $emproastershifts->weekdays      = $request->weekdays;
                $emproastershifts->save();
              //  exit();
              if(str_contains($request->oldurl,'roaster/'.$emproastershifts->employee_id)) {
                //echo $emproastershifts->employee_id;
                //exit();
                return redirect()->route('roaster.show',[$emproastershifts->employee_id])->with('success', 'Roaster shift type  successfully updated.');
              } else {
                return redirect()->route('roaster.index')->with('success', 'Roaster shift type  successfully updated.');
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

    public function destroy($id)
    {
        $emproastershifts = EmpRoasterShifts::find($id);
        if(\Auth::user()->can('Roaster'))
        {
            if($emproastershifts->created_by == \Auth::user()->creatorId())
            {

                $emproastershifts->delete();

                return redirect()->back()->with('success', __('Roaster shift successfully deleted.'));
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
