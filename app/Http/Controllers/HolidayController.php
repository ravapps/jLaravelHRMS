<?php

namespace App\Http\Controllers;

use App\Holiday;
use Illuminate\Http\Request;

class HolidayController extends Controller
{

    public function index(Request $request)
    {
        if(\Auth::user()->can('Manage Holiday'))
        {
            $holidays = Holiday::where('created_by', '=', \Auth::user()->creatorId());

            if(!empty($request->occasion))
            {
                $holidays->where('occasion', 'like', '%' . $request->occasion . '%');
            }

            if(!empty($request->start_date))
            {
                $holidays->where('date', '>=', $request->start_date);
            }
            if(!empty($request->end_date))
            {
                $holidays->where('date', '<=', $request->end_date);
            }
            $holidays = $holidays->paginate(10);

            return view('holiday.index', compact('holidays'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }


    }


    public function create()
    {
        if(\Auth::user()->can('Create Holiday'))
        {
            return view('holiday.create');
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }


    }


    public function store(Request $request)
    {
        if(\Auth::user()->can('Create Holiday'))
        {
            $validator = \Validator::make(
                $request->all(), [
                                   'date' => 'required',
                                   'occasion' => 'required',
                               ]
            );

            if($validator->fails())
            {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }

            $holiday             = new Holiday();
            $holiday->date       =  date('Y-m-d', strtotime($request->date));
            $holiday->occasion   = $request->occasion;
            $holiday->end_date       = date('Y-m-d', strtotime($request->end_date));
            $holiday->start_time   = $request->start_time;
            $holiday->end_time       = $request->end_time;
            $holiday->comment   = $request->comment;
            $holiday->created_by = \Auth::user()->creatorId();
            $holiday->save();

            return redirect()->route('holiday.index')->with(
                'success', 'Holiday successfully created.'
            );
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }


    }


    public function show(Holiday $holiday)
    {
        //
    }


    public function edit(Holiday $holiday)
    {
        if(\Auth::user()->can('Edit Holiday'))
        {
            return view('holiday.edit', compact('holiday'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }


    }


    public function update(Request $request, Holiday $holiday)
    {
        if(\Auth::user()->can('Edit Holiday'))
        {
            $validator = \Validator::make(
                $request->all(), [
                                   'date' => 'required',
                                   'occasion' => 'required',
                               ]
            );

            if($validator->fails())
            {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }

            $holiday->date     = date('Y-m-d', strtotime($request->date));
            $holiday->occasion = $request->occasion;
            $holiday->end_date       = date('Y-m-d', strtotime($request->end_date));
            $holiday->start_time   = $request->start_time;
            $holiday->end_time       = $request->end_time;
            $holiday->comment   = $request->comment;
            $holiday->save();

            return redirect()->route('holiday.index')->with(
                'success', 'Holiday successfully updated.'
            );
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }


    }


    public function destroy(Holiday $holiday)
    {
        if(\Auth::user()->can('Delete Holiday'))
        {
            $holiday->delete();

            return redirect()->route('holiday.index')->with(
                'success', 'Holiday successfully deleted.'
            );
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }


    }
}
