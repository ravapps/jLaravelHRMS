<?php

namespace App\Http\Controllers;

use App\AccountList;
use App\Announcement;
use App\AttendanceEmployee;
use App\Employee;
use App\Event;
use App\Meeting;
use App\Order;
use App\Payees;
use App\Payer;
use App\Plan;
use App\Ticket;
use App\User;
use App\Utility;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = \Auth::user();
        if($user->type == 'employee')
        {
            $emp = Employee::where('user_id', '=', $user->id)->first();

            $announcements = Announcement::orderBy('announcements.id', 'desc')
                                         ->take(5)
                                         ->leftjoin('announcement_employees', 'announcements.id', '=', 'announcement_employees.announcement_id')
                                         ->where('announcement_employees.employee_id', '=', $emp->id)
                                            ->orWhere(function($q) {
                                                $q->where('announcements.department_id', '["0"]')
                                                  ->where('announcements.employee_id', '["0"]');
                                            })
                                         ->get();

            $employees     = Employee::get();
            $meetings      = Meeting::orderBy('meetings.id', 'desc')->take(5)->leftjoin('meeting_employees', 'meetings.id', '=', 'meeting_employees.meeting_id')->where('meeting_employees.employee_id', '=', $emp->id)->orWhere(
                    function ($q){
                        $q->where('meetings.department_id', '["0"]')->where('meetings.employee_id', '["0"]');
                    }
                )->get();
            $events        = Event::where('employee_id', '=', $emp->id)->get();
            $arrEvents     = [];
            foreach($events as $event)
            {

                $arr['id']              = $event['id'];
                $arr['title']           = $event['title'];
                $arr['start']           = $event['start_date'];
                $arr['end']             = $event['end_date'];
                $arr['backgroundColor'] = $event['color'];
                $arr['borderColor']     = "#fff";
                $arr['textColor']       = "white";
                $arr['url']             = route('event.edit', $event['id']);

                $arrEvents[] = $arr;
            }

            $arrEvents = str_replace('"[', '[', str_replace(']"', ']', json_encode($arrEvents)));

            $date               = date("Y-m-d");
            $time               = date("H:i:s");
            $employeeAttendance = AttendanceEmployee::orderBy('id', 'desc')->where('employee_id', '=', !empty(\Auth::user()->employee)?\Auth::user()->employee->id:0)->where('date', '=', $date)->first();

            $officeTime['startTime'] = Utility::getValByName('company_start_time');
            $officeTime['endTime']   = Utility::getValByName('company_end_time');

            return view('dashboard.dashboard', compact('arrEvents', 'announcements', 'employees', 'meetings', 'employeeAttendance', 'officeTime'));
        }
        else if($user->type == 'super admin')
        {
            $user                       = \Auth::user();
            $user['total_user']         = $user->countCompany();
            $user['total_paid_user']    = $user->countPaidCompany();
            $user['total_orders']       = Order::total_orders();
            $user['total_orders_price'] = Order::total_orders_price();
            $user['total_plan']         = Plan::total_plan();
            $user['most_purchese_plan'] = (!empty(Plan::most_purchese_plan()) ? Plan::most_purchese_plan()->name : '');

            $chartData = $this->getOrderChart(['duration' => 'week']);

            return view('dashboard.super_admin', compact('user', 'chartData'));
        }
        else
        {
            $events    = Event::where('created_by', '=', \Auth::user()->creatorId())->get();
            $arrEvents = [];

            foreach($events as $event)
            {

                $arr['id']              = $event['id'];
                $arr['title']           = $event['title'];
                $arr['start']           = $event['start_date'];
                $arr['end']             = $event['end_date'];
                $arr['backgroundColor'] = $event['color'];
                $arr['borderColor']     = "#fff";
                $arr['textColor']       = "white";
                $arr['url']             = route('event.edit', $event['id']);

                $arrEvents[] = $arr;
            }

            $arrEvents = str_replace('"[', '[', str_replace(']"', ']', json_encode($arrEvents)));

            $announcements = Announcement::orderBy('announcements.id', 'desc')->take(5)->where('created_by', '=', \Auth::user()->creatorId())->get();


            $emp           = User::where('type', '=', 'employee')->where('created_by', '=', \Auth::user()->creatorId())->get();
            $countEmployee = count($emp);

            $user      = User::where('type', '!=', 'employee')->where('created_by', '=', \Auth::user()->creatorId())->get();
            $countUser = count($user);

            $countTicket      = Ticket::where('created_by', '=', \Auth::user()->creatorId())->count();
            $countOpenTicket  = Ticket::where('status', '=', 'open')->where('created_by', '=', \Auth::user()->creatorId())->count();
            $countCloseTicket = Ticket::where('status', '=', 'close')->where('created_by', '=', \Auth::user()->creatorId())->count();

            $currentDate = date('Y-m-d');

            $employees     = User::where('type', '=', 'employee')->where('created_by', '=', \Auth::user()->creatorId())->get();
            $countEmployee = count($employees);
            $notClockIn    = AttendanceEmployee::where('date', '=', $currentDate)->get()->pluck('employee_id');

            $notClockIns = Employee::where('created_by', '=', \Auth::user()->creatorId())->whereNotIn('user_id', $notClockIn)->get();

            $accountBalance = AccountList::where('created_by', '=', \Auth::user()->creatorId())->sum('initial_balance');

            $totalPayee = Payees::where('created_by', '=', \Auth::user()->creatorId())->count();
            $totalPayer = Payer::where('created_by', '=', \Auth::user()->creatorId())->count();

            $meetings = Meeting::where('created_by', '=', \Auth::user()->creatorId())->limit(5)->get();

            return view('dashboard.dashboard', compact('arrEvents', 'announcements', 'employees', 'meetings', 'countEmployee', 'countUser', 'countTicket', 'countOpenTicket', 'countCloseTicket', 'notClockIns', 'countEmployee', 'accountBalance', 'totalPayee', 'totalPayer'));
        }
    }

    public function getOrderChart($arrParam)
    {
        $arrDuration = [];
        if($arrParam['duration'])
        {
            if($arrParam['duration'] == 'week')
            {
                $previous_week = strtotime("-2 week +1 day");
                for($i = 0; $i < 14; $i++)
                {
                    $arrDuration[date('Y-m-d', $previous_week)] = date('d-M', $previous_week);
                    $previous_week                              = strtotime(date('Y-m-d', $previous_week) . " +1 day");
                }
            }
        }

        $arrTask          = [];
        $arrTask['label'] = [];
        $arrTask['data']  = [];
        foreach($arrDuration as $date => $label)
        {

            $data               = Order::select(\DB::raw('count(*) as total'))->whereDate('created_at', '=', $date)->first();
            $arrTask['label'][] = $label;
            $arrTask['data'][]  = $data->total;
        }

        return $arrTask;
    }
}
