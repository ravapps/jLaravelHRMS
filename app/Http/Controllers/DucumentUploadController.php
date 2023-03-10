<?php

namespace App\Http\Controllers;

use App\DucumentUpload;
use App\Employee;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use DB;
class DucumentUploadController extends Controller
{

    public function index()
    {
        if(\Auth::user()->can('Manage Document'))
        {
            if(\Auth::user()->type == 'company')
            {
                $documents = DucumentUpload::where('created_by', \Auth::user()->creatorId())->get();
            }
            else
            {
                $userRole  = \Auth::user()->roles->first();
                $documents = DucumentUpload::whereIn(
                    'role', [
                              $userRole->id,
                              0,
                          ]
                )->where('created_by', \Auth::user()->creatorId())->get();
            }
            $employees=Employee::all();
            return view('documentUpload.index', compact('documents','employees'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }


    public function create()
    {
        if(\Auth::user()->can('Create Document'))
        {
            $roles = Role::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
            $roles->prepend('All', '0');

            return view('documentUpload.create', compact('roles'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }


    public function store(Request $request)
    {

$created_date_time=date("Y-m-d h:i:s");
        if(\Auth::user()->can('Create Document'))
        {
            $validator = \Validator::make(
                $request->all(), [
                                   'name' => 'required',
                                   'images' => 'required',
                               ]
            );
            if($validator->fails())
            {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }
            $document              = new DucumentUpload();
            $document->name        = $request->name;
            $document->role        = $request->role;
            $document->created_by  = \Auth::user()->creatorId();
            $document->save();
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

                        $inputqua=array('document_id' => $document->id,
                        'image_name' => $fileNameToStore,
                        'created_at' => $created_date_time,
                        'created_by'=>\Auth::user()->creatorId());
                            DB::table('document_images')->insert($inputqua);
                    }

            }

          

            return redirect()->route('document-upload.index')->with('success', __('Document successfully uploaded.'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }


    public function show(DucumentUpload $ducumentUpload)
    {
        //
    }


    public function edit($id)
    {

        if(\Auth::user()->can('Edit Document'))
        {
           

            $ducumentUpload = DucumentUpload::find($id);

            return view('documentUpload.edit', compact('ducumentUpload'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function update(Request $request, $id)
    {
        
        $created_date_time=date("Y-m-d h:i:s");
        if(\Auth::user()->can('Edit Document'))
        {
            $validator = \Validator::make(
                $request->all(), [
                                   'name' => 'required',
                                  
                               ]
            );
            if($validator->fails())
            {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }
            $document = DucumentUpload::find($id);
            $document->name        = $request->name;
            $document->save();
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

                        $inputqua=array('document_id' => $document->id,
                        'image_name' => $fileNameToStore,
                        'created_at' => $created_date_time,
                        'created_by'=>\Auth::user()->creatorId());
                            DB::table('document_images')->insert($inputqua);
                    }

            }



           
            return redirect()->route('document-upload.index')->with('success', __('Document successfully uploaded.'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function delete_image_docs(Request $request)
    {
        
        DB::table('document_images')->where("id",$request->image_id)->where("document_id",$request->docs_id)->delete();
        $url_send=url("document-upload")."/".$request->docs_id.'/edit';
        $result=array("docs_id"=>$url_send);
        return response()->json($result);
    }


    public function delete_assign_emp(Request $request)
    {
        
        DB::table('assign_emp_document')->where("id",$request->docs_id)->where("document_id",$request->image_id)->delete();
        $url_send=url("document-upload/assign")."/".$request->image_id;
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
            DB::table('assign_emp_document')->insert($inputqua);
        }
        return redirect('document-upload/assign/'.$request->docs_ids)->with('success', __('Document assigned successfully.'));
    }

    public function assign($id)
    {
        $employees=Employee::all();
        $ge_employee_name=DB::table('assign_emp_document')->join('employees', 'assign_emp_document.employee_id', '=', 'employees.id')->select('assign_emp_document.*', 'employees.name')->where("assign_emp_document.document_id",$id)->get();
        $get_employee_id=array();
        if(!empty($ge_employee_name))
        {
            foreach($ge_employee_name as $row)
            {
                $get_employee_id[]=$row->employee_id;
            }
        }
        $docs_ids=$id;
        return view('documentUpload.assign', compact('employees','ge_employee_name','get_employee_id','docs_ids'));
    }

    public function destroy($id)
    {
        if(\Auth::user()->can('Delete Document'))
        {
            $document = DucumentUpload::find($id);
            if($document->created_by == \Auth::user()->creatorId())
            {
                $document->delete();
                DB::table('document_images')->where("document_id",$id)->delete();
                $dir = storage_path('uploads/documentUpload/');

                if(!empty($document->document))
                {
                    unlink($dir . $document->document);
                }

                return redirect()->route('document-upload.index')->with('success', __('Document successfully deleted.'));
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
