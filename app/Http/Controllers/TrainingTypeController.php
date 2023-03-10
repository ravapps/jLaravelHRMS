<?php

namespace App\Http\Controllers;

use App\TrainingType;
use Illuminate\Http\Request;

class TrainingTypeController extends Controller
{

    public function index(Request $request)
    {
        if(\Auth::user()->can('Manage Training Type'))
        {
            $trainingtypes = TrainingType::where('created_by', '=', \Auth::user()->creatorId());

            if(!empty($request->train_type_id))
            {
               
                $trainingtypes->where('id', $request->train_type_id);
            }

            if($request->has('status'))
            {
               
                $trainingtypes->where('status', $request->status);
            }

            $trainingtypes = $trainingtypes->paginate(10);
            return view('trainingtype.index', compact('trainingtypes'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }


    public function create()
    {
        if(\Auth::user()->can('Create Training Type'))
        {
            return view('trainingtype.create');
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }


    public function store(Request $request)
    {
        if(\Auth::user()->can('Create Training Type'))
        {

            $validator = \Validator::make(
                $request->all(), [
                                   'name' => 'required',
                                   'description' => 'required',
                                   'status' => 'required',
                               ]
            );
            if($validator->fails())
            {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }

            $trainingtype             = new TrainingType();
            $trainingtype->name       = $request->name;
            $trainingtype->description= $request->description;
            $trainingtype->status     = $request->status;
            $trainingtype->created_by = \Auth::user()->creatorId();
            $trainingtype->save();

            return redirect()->route('trainingtype.index')->with('success', __('TrainingType  successfully created.'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }


    public function show(TrainingType $trainingType)
    {
        //
    }


    public function edit($id)
    {

        if(\Auth::user()->can('Edit Training Type'))
        {
            $trainingType = TrainingType::find($id);
            if($trainingType->created_by == \Auth::user()->creatorId())
            {

                return view('trainingtype.edit', compact('trainingType'));
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


    public function update(Request $request, $id)
    {
        if(\Auth::user()->can('Edit Training Type'))
        {
            $trainingType = TrainingType::find($id);
            if($trainingType->created_by == \Auth::user()->creatorId())
            {
                $validator = \Validator::make(
                    $request->all(), [
                        'name' => 'required',
                        'description' => 'required',
                        'status' => 'required',

                                   ]
                );

                $trainingType->name       = $request->name;
                $trainingType->description= $request->description;
                $trainingType->status     = $request->status;
                $trainingType->save();

                return redirect()->route('trainingtype.index')->with('success', __('TrainingType successfully updated.'));
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
        if(\Auth::user()->can('Delete Training Type'))
        {

            $trainingType = TrainingType::find($id);
            if($trainingType->created_by == \Auth::user()->creatorId())
            {
                $trainingType->delete();

                return redirect()->route('trainingtype.index')->with('success', __('TrainingType successfully deleted.'));
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
