<?php

namespace App\Http\Controllers;

use App\Department;
use App\Designation;
use App\Jbr;
use Illuminate\Http\Request;
use DB;


use Maatwebsite\Excel\Facades\Excel;
use App\Imports\JbrImport;

use Closure;
use Illuminate\Support\Facades\Log;

class ResponsbilitesController extends Controller
{
    public function index()
    {
      //$jbImp =  new JbrImport;
      //$jbImp->des_id = 8;
      //$jbImp->created_by
//Excel::import($jbImp,'C:/wamp64/www/shrms/storage/uploads/document/xyz.csv');
//Excel::import(new JbrImport, $request->file('file')->store('temp'));
//Excel::import(new UsersImport, storage_path('users.xlsx'));


        if(\Auth::user()->can('Manage Designation'))
        {
          $resp = DB::table("jbrs")->get();

          return view('responsbilites.index', compact('resp'));

        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }


    public function import(Request $request)
    {

        if($request->formsubmit) {



          if($request->hasFile('csvfile'))
          {

              $file = $request->file('csvfile');
              $filenameWithExt = $request->file('csvfile')->getClientOriginalName();
              $filename        = pathinfo($filenameWithExt, PATHINFO_FILENAME);
              $extension       = $request->file('csvfile')->getClientOriginalExtension();
              $fileNameToStore = $filename . '_' . time() . '.' . $extension;
              $dir             = storage_path('uploads/document/');
              $image_path      = $dir . $filenameWithExt;
              $file->move(public_path().'/uploads/document/', $fileNameToStore);
          }
          else
          {
            return redirect()->route('responsbilites.index')->with('error', "Please provide a csv file. Sample file format is given on the form.");
          }

          try {
            $jbImp =  new JbrImport;
            $jbImp->des_id = $request->department_id;
            $jbImp->created_by = \Auth::user()->creatorId();
            Excel::import($jbImp,public_path('uploads/document/').$fileNameToStore);
          } catch (\Exception $e) {
            Log::info(json_encode($e));
            return redirect()->route('responsbilites.index')->with('error', "Error in importing file. Please use correct extension and correct format as per the sample format on form.");
          }
          return redirect()->route('responsbilites.index')->with('error', "File imported successfully for the unique records of selected department");

                                                                    //Excel::import(new JbrImport, $request->file('file')->store('temp'));
                                                                    //Excel::import(new UsersImport, storage_path('users.xlsx'));


        } else {
            if(1)//if(\Auth::user()->can('Create Designation'))
            {
                $departments = Department::where('created_by', '=', \Auth::user()->creatorId())->get();
                $departments = $departments->pluck('name', 'id');

                return view('responsbilites.import', compact('departments'));
                          exit();
            }
            else
            {
                return response()->json(['error' => __('Permission denied.')], 401);
            }
        }
    }


    public function create()
    {


        if(\Auth::user()->can('Create Designation'))
        {
            $departments = Department::where('created_by', '=', \Auth::user()->creatorId())->get();
            $departments = $departments->pluck('name', 'id');

            return view('responsbilites.create', compact('departments'));
        }
        else
        {
            return response()->json(['error' => __('Permission denied.')], 401);
        }
    }

    public function store(Request $request)
    {


        if(\Auth::user()->can('Create Designation'))
        {
            $validator = \Validator::make(
                $request->all(), [
                                   'department_id' => 'required',
                                   'res_name' => 'required|max:50',
                               ]
            );
            if($validator->fails())
            {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }

            $jbr                            = new Jbr();
            $jbr->designation_id            = $request->department_id;
            $jbr->res_name                  = $request->res_name;
            $jbr->created_by                = \Auth::user()->creatorId();

            $jbr->save();

            return redirect()->route('responsbilites.index')->with('success', __('Responsbilites  successfully created.'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function show(Designation $designation)
    {
        return redirect()->route('responsbilites.index');
    }

    public function edit($id)
    {
$jbr = Jbr::find($id);
                $departments = Department::where('created_by', '=', \Auth::user()->creatorId())->first();
                $departments = $departments->pluck('name', 'id');

                return view('responsbilites.edit', compact('jbr', 'departments'));


    }

    public function update(Request $request, Jbr $jbr)
    {

      //echo "here";
      //exit();
        if(\Auth::user()->can('Edit Designation'))
        {

                $validator = \Validator::make(
                    $request->all(), [
                                       'department_id' => 'required',
                                       'res_name' => 'required|max:50',
                                   ]
                );
                if($validator->fails())
                {
                    $messages = $validator->getMessageBag();

                    return redirect()->back()->with('error', $messages->first());
                }

                                                 Jbr::where("id",$request->id)->update([
                                                   'res_name' => $request->res_name,
                                                   'designation_id' => $request->department_id,
                                                 ]);

                return redirect()->route('responsbilites.index')->with('success', __('Responsbility  successfully updated.'));

        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function destroy($id)
    {
        if(1) //if(\Auth::user()->can('Xesignation'))
        {
            $jbr = Jbr::find($id);

            if(1) //if($jbr->created_by == \Auth::user()->creatorId())
            {
              $employee_jbr   = DB::table("employee_jbrs")->where("jbr_id",$jbr->id)->get();
              if(count($employee_jbr)) {
                return redirect()->route('responsbilites.index')->with('error', __('Responsbility is being used in app.'));
              } else {
                Jbr::where('id',$id)->delete();
              }
                return redirect()->route('responsbilites.index')->with('success', __('Responsbility successfully deleted.'));
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


/// Excel::import(new UsersImport, $request->file('file')->store('temp'));
