<?php

namespace App\Http\Controllers;


use App\Employee;
use App\EmpPaygrades;
use App\AttendanceEmployee;
use App\CPF;
use Illuminate\Http\Request;
use DB;
use DateTime;
class CpfController extends Controller
{



  public function index()
     {
       $get_employee=Employee::all();
       $get_salary_date=DB::table("emp_set_date")->first();
       $get_cpf_percentage=$get_cpf_percentage1=$total_salary=$get_allowannce=$allnc_cost='';
       $final_calculation=$al_name=$final_calculation1=array();
       $donation_amount=$allnc_cost=0; $created_date_time=date("Y-m-d h:i:s");
       foreach($get_employee as $row)
      {
          $get_past_salary_details=DB::table('employee_salary')->where("employee_id",$row->id)->orderBy("created_at","DESC")->first();

          $commission_cost=$get_overtime_cost=$bonus_cost=0;
         $get_commission_id=$bonus_id='';
         //$get_attandence=AttendanceEmployee::where("employee_id",$row->id)->whereBetween('date',[date('Y-m-d', strtotime($get_past_salary_details->created_at)),date('Y-m-d')])->sum('total_hrs');
         $get_employee_grade=EmpPaygrades::Where("id",$row->pay_grade)->first();
         //$slot_diff=date("d")-date('d', strtotime($get_past_salary_details->created_at));
         //$get_number_of_days=$slot_diff;
         $get_hrlu_sal1=$get_employee_grade->gross_salary;
          $total_monthly_hrs_salr=round($get_hrlu_sal1,2);
          $get_cpf_percentage=(round($total_monthly_hrs_salr,2))/100;
         $get_cpf_percentage1=(round($total_monthly_hrs_salr,2))/100;

                                                $final_calculation['name']=$row->first_name." ".$row->last_name;
                                                $final_calculation['gross_salary']=round($total_monthly_hrs_salr,2);
                                                $final_calculation['salary_type']= $get_employee_grade->grade_type;
                                                $final_calculation['get_cpf_percentage']= round($get_cpf_percentage,2);
                                                $final_calculation['get_cpf_percentage1']= round($get_cpf_percentage1,2);
                                                $final_calculation['donation_type']=$row->donation_type;
                                                if($row->donation_type=='CDAC')
                                                                                    {
                                                                                        if($total_monthly_hrs_salr<2000)
                                                                                        {
                                                                                            $donation_amount=.50;
                                                                                        }
                                                                                        if($total_monthly_hrs_salr>=2000 && $total_monthly_hrs_salr<3000)
                                                                                        {
                                                                                            $donation_amount=1;
                                                                                        }
                                                                                        if($total_monthly_hrs_salr>=3000 && $total_monthly_hrs_salr<5000)
                                                                                        {
                                                                                            $donation_amount=1.5;
                                                                                        }
                                                                                        if($total_monthly_hrs_salr>=5000 && $total_monthly_hrs_salr<7000)
                                                                                        {
                                                                                            $donation_amount=2;
                                                                                        }
                                                                                        if($total_monthly_hrs_salr>=7000)
                                                                                        {
                                                                                            $donation_amount=3;
                                                                                        }
                                                                                    }elseif($row->donation_type=='ECF')
                                                                                    {
                                                                                        if($total_monthly_hrs_salr<=1000)
                                                                                        {
                                                                                            $donation_amount=2;
                                                                                        }
                                                                                        if($total_monthly_hrs_salr>1000 && $total_monthly_hrs_salr<1500)
                                                                                        {
                                                                                            $donation_amount=4;
                                                                                        }
                                                                                        if($total_monthly_hrs_salr>=1500 && $total_monthly_hrs_salr<2500)
                                                                                        {
                                                                                            $donation_amount=6;
                                                                                        }
                                                                                        if($total_monthly_hrs_salr>=2500 && $total_monthly_hrs_salr<4000)
                                                                                        {
                                                                                            $donation_amount=9;
                                                                                        }
                                                                                        if($total_monthly_hrs_salr>=4000 && $total_monthly_hrs_salr<7000)
                                                                                        {
                                                                                            $donation_amount=12;
                                                                                        }
                                                                                        if($total_monthly_hrs_salr>=7000 && $total_monthly_hrs_salr<10000)
                                                                                        {
                                                                                            $donation_amount=16;
                                                                                        }
                                                                                        if($total_monthly_hrs_salr>=10000)
                                                                                        {
                                                                                            $donation_amount=20;
                                                                                        }
                                                                                    }
                                                                                    elseif($row->donation_type=='SINDA')
                                                                                    {

                                                                                        if($total_monthly_hrs_salr<=1000)
                                                                                        {
                                                                                            $donation_amount=1;
                                                                                        }
                                                                                        if($total_monthly_hrs_salr>1000 && $total_monthly_hrs_salr<1500)
                                                                                        {
                                                                                            $donation_amount=3;
                                                                                        }
                                                                                        if($total_monthly_hrs_salr>=1500 && $total_monthly_hrs_salr<2500)
                                                                                        {
                                                                                            $donation_amount=5;
                                                                                        }
                                                                                        if($total_monthly_hrs_salr>=2500 && $total_monthly_hrs_salr<4500)
                                                                                        {

                                                                                            $donation_amount=7;
                                                                                        }
                                                                                        if($total_monthly_hrs_salr>=4500 && $total_monthly_hrs_salr<7500)
                                                                                        {
                                                                                            $donation_amount=9;
                                                                                        }
                                                                                        if($total_monthly_hrs_salr>=7500 && $total_monthly_hrs_salr<10000)
                                                                                        {
                                                                                            $donation_amount=12;
                                                                                        }
                                                                                        if($total_monthly_hrs_salr>=10000 && $total_monthly_hrs_salr<15000)
                                                                                        {
                                                                                            $donation_amount=18;
                                                                                        }
                                                                                        if($total_monthly_hrs_salr>=15000)
                                                                                        {
                                                                                            $donation_amount=30;
                                                                                        }
                                                                                    }
                                                                                    elseif($row->donation_type=='MBMF')
                                                                                    {

                                                                                        if($total_monthly_hrs_salr<=1000)
                                                                                        {
                                                                                            $donation_amount=3;
                                                                                        }
                                                                                        if($total_monthly_hrs_salr>1000 && $total_monthly_hrs_salr<2000)
                                                                                        {
                                                                                            $donation_amount=4.5;
                                                                                        }
                                                                                        if($total_monthly_hrs_salr>=2000 && $total_monthly_hrs_salr<3000)
                                                                                        {

                                                                                            $donation_amount=6.5;
                                                                                        }
                                                                                        if($total_monthly_hrs_salr>=3000 && $total_monthly_hrs_salr<4000)
                                                                                        {
                                                                                            $donation_amount=15;
                                                                                        }
                                                                                        if($total_monthly_hrs_salr>=4000 && $total_monthly_hrs_salr<6000)
                                                                                        {
                                                                                            $donation_amount=19.5;
                                                                                        }
                                                                                        if($total_monthly_hrs_salr>=6000 && $total_monthly_hrs_salr<8000)
                                                                                        {
                                                                                            $donation_amount=22;
                                                                                        }
                                                                                        if($total_monthly_hrs_salr>=8000 && $total_monthly_hrs_salr<10000)
                                                                                        {
                                                                                            $donation_amount=24;
                                                                                        }
                                                                                        if($total_monthly_hrs_salr>=10000)
                                                                                        {
                                                                                            $donation_amount=26;
                                                                                        }
                                                                                    }
                                                                                    else
                                                                                    {
                                                                                        $donation_amount=0;
                                                                                    }
                                                $final_calculation['donation_amount']=$donation_amount;
                                                //$final_calculation['allnc_cost']=$allnc_cost;
                                                //$final_calculation['commission_cost']=$commission_cost;
                                                //$final_calculation['bonus_cost']=$bonus_cost;
                                                //$final_calculation['get_overtime_cost']=$get_overtime_cost;
                                                //$final_calculation['total_salary']= $total_salary+$allnc_cost+$commission_cost+$get_overtime_cost;
               $final_calculation1[]=$final_calculation;



      }
return view('cpf.index', compact('final_calculation1'));
}
    // public function index()
    // {
    //
    //     $get_employee=Employee::all();
    //     $get_salary_date=DB::table("emp_set_date")->first();
    //     $get_cpf_percentage=$get_cpf_percentage1=$total_salary=$get_allowannce=$allnc_cost='';
    //     $final_calculation=$al_name=$final_calculation1=array();
    //     $donation_amount=$allnc_cost=0; $created_date_time=date("Y-m-d h:i:s");
    //
    //     foreach($get_employee as $row)
    //     {
    //         //$get_past_salary_details=DB::table('employee_salary')->where("employee_id",$row->id)->whereMonth("created_at","=",date('m'))->whereYear("created_at","=",date('Y'))->first();
    //         $get_past_salary_details=DB::table('employee_salary')->where("employee_id",$row->id)->orderBy("created_at","DESC")->first();
    //
    //       if(!empty($get_past_salary_details))
    //             {
    //
    //                 $commission_cost=$get_overtime_cost=$bonus_cost=0;
    //                 $get_commission_id=$bonus_id='';
    //                 $get_employee_grade=EmpPaygrades::Where("id",$row->pay_grade)->first();
    //                 $get_allowannce=DB::table("emp_grade_allowances")->join('allowance_options', 'emp_grade_allowances.allowance_id', '=', 'allowance_options.id')->where("grade_id",$get_employee_grade->id)->sum('limit_month');
    //                 $get_attandence=AttendanceEmployee::where("employee_id",$row->id)->whereBetween('date',[date('Y-m-d', strtotime($get_past_salary_details->created_at)),date('Y-m-d')])->sum('total_hrs');
    //                 $get_overtime=AttendanceEmployee::where("employee_id",$row->id)->whereBetween('date',[date('Y-m-d', strtotime($get_past_salary_details->created_at)),date('Y-m-d')])->sum(DB::raw("HOUR(overtime)"));
    //                 $get_overtime_cost=$get_overtime*$get_employee_grade->overtime;
    //                 $get_commission=DB::table("commissions")->join('emp_commissionbonus_type', 'commissions.title', '=', 'emp_commissionbonus_type.id')->select('commissions.*', 'emp_commissionbonus_type.name','emp_commissionbonus_type.amount')->where("employee_id",$row->id)->where("status","Approved")->first();
    //
    //                 $get_bonus=DB::table("emp_bonus")->join('emp_commissionbonus_type', 'emp_bonus.bonus_id', '=', 'emp_commissionbonus_type.id')->select('emp_bonus.*', 'emp_commissionbonus_type.amount')->where("employee_id",$row->id)->whereYear('date_bonus', date('Y'))->whereMonth('date_bonus', date('m'))->first();
    //
    //
    //                     if(!empty($get_bonus))
    //                     {
    //                         $bonus_id=$get_bonus->id;
    //                         $bonus_cost=$get_bonus->amount;
    //                     }
    //
    //                 if(!empty($get_commission))
    //                 {
    //                     $get_commission_id=$get_commission->id;
    //                     $commission_cost=$get_commission->amount;
    //                 }
    //                 $allnc_cost=$get_allowannce;
    //                 $dob=$row->dob;
    //                 $diff = (date('Y') - date('Y',strtotime($dob)));
    //
    //
    //                 $slot_diff=date("d")-date('d', strtotime($get_past_salary_details->created_at));
    //
    //                 if($slot_diff==$get_salary_date->to_d)
    //                 {
    //
    //                     if(!empty($row->emp_type) && ($row->emp_type=='Singapore Citizen' || $row->emp_type=='Permanent Resident'))
    //                     {
    //
    //                         $sundays=$saturdy=0;
    //                         $total_days=cal_days_in_month(CAL_GREGORIAN, date('m'),date('Y'));
    //                         for($i=1;$i<=$total_days;$i++){
    //                             if(date('N',strtotime(date('Y').'-'.date('m').'-'.$i))==7){
    //                             $sundays++;
    //                             $saturdy++;
    //                             }
    //
    //                         }
    //
    //
    //                         $get_number_of_days=$slot_diff;
    //                         if($get_employee_grade->grade_type=='Monthly')
    //                         {
    //
    //
    //                             $get_hrlu_sal1=$get_employee_grade->gross_salary/($get_number_of_days*8);
    //
    //                             $total_monthly_hrs_salr=round($get_hrlu_sal1,2)*$get_attandence;
    //
    //                                     if($row->donation_type=='CDAC')
    //                                     {
    //                                         if($total_monthly_hrs_salr<2000)
    //                                         {
    //                                             $donation_amount=.50;
    //                                         }
    //                                         if($total_monthly_hrs_salr>=2000 && $total_monthly_hrs_salr<3000)
    //                                         {
    //                                             $donation_amount=1;
    //                                         }
    //                                         if($total_monthly_hrs_salr>=3000 && $total_monthly_hrs_salr<5000)
    //                                         {
    //                                             $donation_amount=1.5;
    //                                         }
    //                                         if($total_monthly_hrs_salr>=5000 && $total_monthly_hrs_salr<7000)
    //                                         {
    //                                             $donation_amount=2;
    //                                         }
    //                                         if($total_monthly_hrs_salr>=7000)
    //                                         {
    //                                             $donation_amount=3;
    //                                         }
    //                                     }elseif($row->donation_type=='ECF')
    //                                     {
    //                                         if($total_monthly_hrs_salr<=1000)
    //                                         {
    //                                             $donation_amount=2;
    //                                         }
    //                                         if($total_monthly_hrs_salr>1000 && $total_monthly_hrs_salr<1500)
    //                                         {
    //                                             $donation_amount=4;
    //                                         }
    //                                         if($total_monthly_hrs_salr>=1500 && $total_monthly_hrs_salr<2500)
    //                                         {
    //                                             $donation_amount=6;
    //                                         }
    //                                         if($total_monthly_hrs_salr>=2500 && $total_monthly_hrs_salr<4000)
    //                                         {
    //                                             $donation_amount=9;
    //                                         }
    //                                         if($total_monthly_hrs_salr>=4000 && $total_monthly_hrs_salr<7000)
    //                                         {
    //                                             $donation_amount=12;
    //                                         }
    //                                         if($total_monthly_hrs_salr>=7000 && $total_monthly_hrs_salr<10000)
    //                                         {
    //                                             $donation_amount=16;
    //                                         }
    //                                         if($total_monthly_hrs_salr>=10000)
    //                                         {
    //                                             $donation_amount=20;
    //                                         }
    //                                     }
    //                                     elseif($row->donation_type=='SINDA')
    //                                     {
    //
    //                                         if($total_monthly_hrs_salr<=1000)
    //                                         {
    //                                             $donation_amount=1;
    //                                         }
    //                                         if($total_monthly_hrs_salr>1000 && $total_monthly_hrs_salr<1500)
    //                                         {
    //                                             $donation_amount=3;
    //                                         }
    //                                         if($total_monthly_hrs_salr>=1500 && $total_monthly_hrs_salr<2500)
    //                                         {
    //                                             $donation_amount=5;
    //                                         }
    //                                         if($total_monthly_hrs_salr>=2500 && $total_monthly_hrs_salr<4500)
    //                                         {
    //
    //                                             $donation_amount=7;
    //                                         }
    //                                         if($total_monthly_hrs_salr>=4500 && $total_monthly_hrs_salr<7500)
    //                                         {
    //                                             $donation_amount=9;
    //                                         }
    //                                         if($total_monthly_hrs_salr>=7500 && $total_monthly_hrs_salr<10000)
    //                                         {
    //                                             $donation_amount=12;
    //                                         }
    //                                         if($total_monthly_hrs_salr>=10000 && $total_monthly_hrs_salr<15000)
    //                                         {
    //                                             $donation_amount=18;
    //                                         }
    //                                         if($total_monthly_hrs_salr>=15000)
    //                                         {
    //                                             $donation_amount=30;
    //                                         }
    //                                     }
    //                                     elseif($row->donation_type=='MBMF')
    //                                     {
    //
    //                                         if($total_monthly_hrs_salr<=1000)
    //                                         {
    //                                             $donation_amount=3;
    //                                         }
    //                                         if($total_monthly_hrs_salr>1000 && $total_monthly_hrs_salr<2000)
    //                                         {
    //                                             $donation_amount=4.5;
    //                                         }
    //                                         if($total_monthly_hrs_salr>=2000 && $total_monthly_hrs_salr<3000)
    //                                         {
    //
    //                                             $donation_amount=6.5;
    //                                         }
    //                                         if($total_monthly_hrs_salr>=3000 && $total_monthly_hrs_salr<4000)
    //                                         {
    //                                             $donation_amount=15;
    //                                         }
    //                                         if($total_monthly_hrs_salr>=4000 && $total_monthly_hrs_salr<6000)
    //                                         {
    //                                             $donation_amount=19.5;
    //                                         }
    //                                         if($total_monthly_hrs_salr>=6000 && $total_monthly_hrs_salr<8000)
    //                                         {
    //                                             $donation_amount=22;
    //                                         }
    //                                         if($total_monthly_hrs_salr>=8000 && $total_monthly_hrs_salr<10000)
    //                                         {
    //                                             $donation_amount=24;
    //                                         }
    //                                         if($total_monthly_hrs_salr>=10000)
    //                                         {
    //                                             $donation_amount=26;
    //                                         }
    //                                     }
    //                                     else
    //                                     {
    //                                         $donation_amount=0;
    //                                     }
    //
    //
    //                                     if($diff<=50)
    //                                     {
    //                                             $emp_intrest=20;
    //                                             $emp_intrest_c=17;
    //                                     }
    //                                     if($diff>50)
    //                                     {
    //                                             $emp_intrest=7.5;
    //                                             $emp_intrest_c=9;
    //                                     }
    //                                     $get_cpf_percentage=(round($total_monthly_hrs_salr,2)*$emp_intrest)/100;
    //                                     $get_cpf_percentage1=(round($total_monthly_hrs_salr,2)*$emp_intrest_c)/100;
    //                                     $total_salary=(round($total_monthly_hrs_salr,2)-$get_cpf_percentage)+$get_cpf_percentage1;
    //                                     $total_salary=round($total_salary,2)-$donation_amount;
    //                                     $final_calculation['name']=$row->first_name." ".$row->last_name;
    //                                     $final_calculation['gross_salary']=round($total_monthly_hrs_salr,2);
    //                                     $final_calculation['salary_type']= $get_employee_grade->grade_type;
    //                                     $final_calculation['get_cpf_percentage']= round($get_cpf_percentage,2);
    //                                     $final_calculation['get_cpf_percentage1']= round($get_cpf_percentage1,2);
    //                                     $final_calculation['donation_type']=$row->donation_type;
    //                                     $final_calculation['donation_amount']=$donation_amount;
    //                                     $final_calculation['allnc_cost']=$allnc_cost;
    //                                     $final_calculation['commission_cost']=$commission_cost;
    //                                     $final_calculation['bonus_cost']=$bonus_cost;
    //                                     $final_calculation['get_overtime_cost']=$get_overtime_cost;
    //                                     $final_calculation['total_salary']= $total_salary+$allnc_cost+$commission_cost+$get_overtime_cost;
    //
    //
    //
    //
    //                         }
    //
    //                         if($get_employee_grade->grade_type=='Hourly')
    //                         {
    //
    //
    //                             $get_hrlu_sal=$get_employee_grade->gross_salary*$get_attandence;
    //
    //                                     if($row->donation_type=='CDAC')
    //                                     {
    //                                         if($get_hrlu_sal<2000)
    //                                         {
    //                                             $donation_amount=.50;
    //                                         }
    //                                         if($get_hrlu_sal>=2000 && $get_hrlu_sal<3000)
    //                                         {
    //                                             $donation_amount=1;
    //                                         }
    //                                         if($get_hrlu_sal>=3000 && $get_hrlu_sal<5000)
    //                                         {
    //                                             $donation_amount=1.5;
    //                                         }
    //                                         if($get_hrlu_sal>=5000 && $get_hrlu_sal<7000)
    //                                         {
    //                                             $donation_amount=2;
    //                                         }
    //                                         if($get_hrlu_sal>=7000)
    //                                         {
    //                                             $donation_amount=3;
    //                                         }
    //                                     }elseif($row->donation_type=='ECF')
    //                                     {
    //                                         if($get_hrlu_sal<=1000)
    //                                         {
    //                                             $donation_amount=2;
    //                                         }
    //                                         if($get_hrlu_sal>1000 && $get_hrlu_sal<1500)
    //                                         {
    //                                             $donation_amount=4;
    //                                         }
    //                                         if($get_hrlu_sal>=1500 && $get_hrlu_sal<2500)
    //                                         {
    //                                             $donation_amount=6;
    //                                         }
    //                                         if($get_hrlu_sal>=2500 && $get_hrlu_sal<4000)
    //                                         {
    //                                             $donation_amount=9;
    //                                         }
    //                                         if($get_hrlu_sal>=4000 && $get_hrlu_sal<7000)
    //                                         {
    //                                             $donation_amount=12;
    //                                         }
    //                                         if($get_hrlu_sal>=7000 && $get_hrlu_sal<10000)
    //                                         {
    //                                             $donation_amount=16;
    //                                         }
    //                                         if($get_hrlu_sal>=10000)
    //                                         {
    //                                             $donation_amount=20;
    //                                         }
    //                                     }
    //                                     elseif($row->donation_type=='SINDA')
    //                                     {
    //
    //                                         if($get_hrlu_sal<=1000)
    //                                         {
    //                                             $donation_amount=1;
    //                                         }
    //                                         if($get_hrlu_sal>1000 && $get_hrlu_sal<1500)
    //                                         {
    //                                             $donation_amount=3;
    //                                         }
    //                                         if($get_hrlu_sal>=1500 && $get_hrlu_sal<2500)
    //                                         {
    //                                             $donation_amount=5;
    //                                         }
    //                                         if($get_hrlu_sal>=2500 && $get_hrlu_sal<4500)
    //                                         {
    //
    //                                             $donation_amount=7;
    //                                         }
    //                                         if($get_hrlu_sal>=4500 && $get_hrlu_sal<7500)
    //                                         {
    //                                             $donation_amount=9;
    //                                         }
    //                                         if($get_hrlu_sal>=7500 && $get_hrlu_sal<10000)
    //                                         {
    //                                             $donation_amount=12;
    //                                         }
    //                                         if($get_hrlu_sal>=10000 && $get_hrlu_sal<15000)
    //                                         {
    //                                             $donation_amount=18;
    //                                         }
    //                                         if($get_hrlu_sal>=15000)
    //                                         {
    //                                             $donation_amount=30;
    //                                         }
    //                                     }
    //                                     elseif($row->donation_type=='MBMF')
    //                                     {
    //
    //                                         if($get_hrlu_sal<=1000)
    //                                         {
    //                                             $donation_amount=3;
    //                                         }
    //                                         if($get_hrlu_sal>1000 && $get_hrlu_sal<2000)
    //                                         {
    //                                             $donation_amount=4.5;
    //                                         }
    //                                         if($get_hrlu_sal>=2000 && $get_hrlu_sal<3000)
    //                                         {
    //
    //                                             $donation_amount=6.5;
    //                                         }
    //                                         if($get_hrlu_sal>=3000 && $get_hrlu_sal<4000)
    //                                         {
    //                                             $donation_amount=15;
    //                                         }
    //                                         if($get_hrlu_sal>=4000 && $get_hrlu_sal<6000)
    //                                         {
    //                                             $donation_amount=19.5;
    //                                         }
    //                                         if($get_hrlu_sal>=6000 && $get_hrlu_sal<8000)
    //                                         {
    //                                             $donation_amount=22;
    //                                         }
    //                                         if($get_hrlu_sal>=8000 && get_hrlu_sal<10000)
    //                                         {
    //                                             $donation_amount=24;
    //                                         }
    //                                         if($get_hrlu_sal>=10000)
    //                                         {
    //                                             $donation_amount=26;
    //                                         }
    //                                     }
    //                                     else
    //                                     {
    //                                         $donation_amount=0;
    //                                     }
    //
    //
    //                                     if($diff<=50)
    //                                     {
    //                                             $emp_intrest=20;
    //                                             $emp_intrest_c=17;
    //                                     }
    //                                     if($diff>50)
    //                                     {
    //                                             $emp_intrest=7.5;
    //                                             $emp_intrest_c=9;
    //                                     }
    //
    //                                     $get_cpf_percentage=($get_hrlu_sal*$emp_intrest)/100;
    //                                     $get_cpf_percentage1=($get_hrlu_sal*$emp_intrest_c)/100;
    //                                     $total_salary=($get_hrlu_sal-$get_cpf_percentage)+$get_cpf_percentage1;
    //                                     $total_salary=$total_salary-$donation_amount;
    //                                     $final_calculation['name']=$row->first_name." ".$row->last_name;
    //                                     $final_calculation['gross_salary']=$get_hrlu_sal;
    //                                     $final_calculation['salary_type']= $get_employee_grade->grade_type;
    //                                     $final_calculation['get_cpf_percentage']= $get_cpf_percentage;
    //                                     $final_calculation['get_cpf_percentage1']= $get_cpf_percentage1;
    //                                     $final_calculation['donation_type']=$row->donation_type;
    //                                     $final_calculation['donation_amount']=$donation_amount;
    //                                     $final_calculation['allnc_cost']=$allnc_cost;
    //                                     $final_calculation['commission_cost']=$commission_cost;
    //                                     $final_calculation['bonus_cost']=$bonus_cost;
    //                                     $final_calculation['get_overtime_cost']=$get_overtime_cost;
    //                                     $final_calculation['get_cpf_percentage1']= $get_cpf_percentage1;
    //                                     $final_calculation['total_salary']= $total_salary+$allnc_cost+$commission_cost+$get_overtime_cost;
    //
    //
    //
    //
    //                         }
    //
    //                         if($get_employee_grade->grade_type=='Daily')
    //                         {
    //
    //                             $get_hrlu_sal11=$get_employee_grade->gross_salary/9;
    //
    //                             $total_monthly_hrs_salr1=round($get_hrlu_sal11,2)*$get_attandence;
    //
    //                             $get_hrlu_sal=$get_employee_grade->gross_salary*$get_attandence;
    //
    //                                     if($row->donation_type=='CDAC')
    //                                     {
    //                                         if($get_hrlu_sal<2000)
    //                                         {
    //                                             $donation_amount=.50;
    //                                         }
    //                                         if($get_hrlu_sal>=2000 && $get_hrlu_sal<3000)
    //                                         {
    //                                             $donation_amount=1;
    //                                         }
    //                                         if($get_hrlu_sal>=3000 && $get_hrlu_sal<5000)
    //                                         {
    //                                             $donation_amount=1.5;
    //                                         }
    //                                         if($get_hrlu_sal>=5000 && $get_hrlu_sal<7000)
    //                                         {
    //                                             $donation_amount=2;
    //                                         }
    //                                         if($get_hrlu_sal>=7000)
    //                                         {
    //                                             $donation_amount=3;
    //                                         }
    //                                     }elseif($row->donation_type=='ECF')
    //                                     {
    //                                         if($get_hrlu_sal<=1000)
    //                                         {
    //                                             $donation_amount=2;
    //                                         }
    //                                         if($get_hrlu_sal>1000 && $get_hrlu_sal<1500)
    //                                         {
    //                                             $donation_amount=4;
    //                                         }
    //                                         if($get_hrlu_sal>=1500 && $get_hrlu_sal<2500)
    //                                         {
    //                                             $donation_amount=6;
    //                                         }
    //                                         if($get_hrlu_sal>=2500 && $get_hrlu_sal<4000)
    //                                         {
    //                                             $donation_amount=9;
    //                                         }
    //                                         if($get_hrlu_sal>=4000 && $get_hrlu_sal<7000)
    //                                         {
    //                                             $donation_amount=12;
    //                                         }
    //                                         if($get_hrlu_sal>=7000 && $get_hrlu_sal<10000)
    //                                         {
    //                                             $donation_amount=16;
    //                                         }
    //                                         if($get_hrlu_sal>=10000)
    //                                         {
    //                                             $donation_amount=20;
    //                                         }
    //                                     }
    //                                     elseif($row->donation_type=='SINDA')
    //                                     {
    //
    //                                         if($get_hrlu_sal<=1000)
    //                                         {
    //                                             $donation_amount=1;
    //                                         }
    //                                         if($get_hrlu_sal>1000 && $get_hrlu_sal<1500)
    //                                         {
    //                                             $donation_amount=3;
    //                                         }
    //                                         if($get_hrlu_sal>=1500 && $get_hrlu_sal<2500)
    //                                         {
    //                                             $donation_amount=5;
    //                                         }
    //                                         if($get_hrlu_sal>=2500 && $get_hrlu_sal<4500)
    //                                         {
    //
    //                                             $donation_amount=7;
    //                                         }
    //                                         if($get_hrlu_sal>=4500 && $get_hrlu_sal<7500)
    //                                         {
    //                                             $donation_amount=9;
    //                                         }
    //                                         if($get_hrlu_sal>=7500 && $get_hrlu_sal<10000)
    //                                         {
    //                                             $donation_amount=12;
    //                                         }
    //                                         if($get_hrlu_sal>=10000 && $get_hrlu_sal<15000)
    //                                         {
    //                                             $donation_amount=18;
    //                                         }
    //                                         if($get_hrlu_sal>=15000)
    //                                         {
    //                                             $donation_amount=30;
    //                                         }
    //                                     }
    //                                     elseif($row->donation_type=='MBMF')
    //                                     {
    //
    //                                         if($get_hrlu_sal<=1000)
    //                                         {
    //                                             $donation_amount=3;
    //                                         }
    //                                         if($get_hrlu_sal>1000 && $get_hrlu_sal<2000)
    //                                         {
    //                                             $donation_amount=4.5;
    //                                         }
    //                                         if($get_hrlu_sal>=2000 && $get_hrlu_sal<3000)
    //                                         {
    //
    //                                             $donation_amount=6.5;
    //                                         }
    //                                         if($get_hrlu_sal>=3000 && $get_hrlu_sal<4000)
    //                                         {
    //                                             $donation_amount=15;
    //                                         }
    //                                         if($get_hrlu_sal>=4000 && $get_hrlu_sal<6000)
    //                                         {
    //                                             $donation_amount=19.5;
    //                                         }
    //                                         if($get_hrlu_sal>=6000 && $get_hrlu_sal<8000)
    //                                         {
    //                                             $donation_amount=22;
    //                                         }
    //                                         if($get_hrlu_sal>=8000 && get_hrlu_sal<10000)
    //                                         {
    //                                             $donation_amount=24;
    //                                         }
    //                                         if($get_hrlu_sal>=10000)
    //                                         {
    //                                             $donation_amount=26;
    //                                         }
    //                                     }
    //                                     else
    //                                     {
    //                                         $donation_amount=0;
    //                                     }
    //
    //
    //                                     if($diff<=50)
    //                                     {
    //                                             $emp_intrest=20;
    //                                             $emp_intrest_c=17;
    //                                     }
    //                                     if($diff>50)
    //                                     {
    //                                             $emp_intrest=7.5;
    //                                             $emp_intrest_c=9;
    //                                     }
    //
    //                                     $get_cpf_percentage=($get_hrlu_sal*$emp_intrest)/100;
    //                                     $get_cpf_percentage1=($get_hrlu_sal*$emp_intrest_c)/100;
    //                                     $total_salary=($get_hrlu_sal-$get_cpf_percentage)+$get_cpf_percentage1;
    //                                     $total_salary=$total_salary-$donation_amount;
    //                                     $final_calculation['name']=$row->first_name." ".$row->last_name;
    //                                     $final_calculation['gross_salary']=$get_hrlu_sal;
    //                                     $final_calculation['salary_type']= $get_employee_grade->grade_type;
    //                                     $final_calculation['get_cpf_percentage']= $get_cpf_percentage;
    //                                     $final_calculation['get_cpf_percentage1']= $get_cpf_percentage1;
    //                                     $final_calculation['donation_type']=$row->donation_type;
    //                                     $final_calculation['donation_amount']=$donation_amount;
    //                                     $final_calculation['allnc_cost']=$allnc_cost;
    //                                     $final_calculation['commission_cost']=$commission_cost;
    //                                     $final_calculation['bonus_cost']=$bonus_cost;
    //                                     $final_calculation['get_overtime_cost']=$get_overtime_cost;
    //                                     $final_calculation['get_cpf_percentage1']= $get_cpf_percentage1;
    //                                     $final_calculation['total_salary']= $total_salary+$allnc_cost+$commission_cost+$get_overtime_cost;
    //
    //
    //
    //
    //                         }
    //
    //
    //                     }
    //                     else
    //                     {
    //                         if($get_employee_grade->grade_type=='Monthly')
    //                         {
    //
    //
    //
    //
    //
    //                                     $donation_amount=0;
    //
    //
    //                                     $get_cpf_percentage=0;
    //                                     $get_cpf_percentage1=0;
    //                                     $total_salary=($get_employee_grade->gross_salary-$get_cpf_percentage)+$get_cpf_percentage1;
    //                                     $total_salary=$total_salary-$donation_amount;
    //                                     $final_calculation['name']=$row->first_name." ".$row->last_name;
    //                                     $final_calculation['gross_salary']=$get_employee_grade->gross_salary;
    //                                     $final_calculation['salary_type']= $get_employee_grade->grade_type;
    //                                     $final_calculation['get_cpf_percentage']= $get_cpf_percentage;
    //                                     $final_calculation['get_cpf_percentage1']= $get_cpf_percentage1;
    //                                     $final_calculation['donation_type']=$row->donation_type;
    //                                     $final_calculation['donation_amount']=$donation_amount;
    //                                     $final_calculation['allnc_cost']=$allnc_cost;
    //                                     $final_calculation['commission_cost']=$commission_cost;
    //                                     $final_calculation['bonus_cost']=$bonus_cost;
    //                                     $final_calculation['get_overtime_cost']=$get_overtime_cost;
    //                                     $final_calculation['get_cpf_percentage1']= $get_cpf_percentage1;
    //                                     $final_calculation['total_salary']= $total_salary+$allnc_cost+$commission_cost+$get_overtime_cost;
    //
    //
    //
    //
    //                         }
    //
    //                         if($get_employee_grade->grade_type=='Hourly')
    //                         {
    //
    //
    //
    //                             $get_hrlu_sal=$get_employee_grade->gross_salary*$get_attandence;
    //
    //                                     $donation_amount=0;
    //
    //
    //                                     $get_cpf_percentage=0;
    //                                     $get_cpf_percentage1=0;
    //                                     $total_salary=($get_hrlu_sal-$get_cpf_percentage)+$get_cpf_percentage1;
    //                                     $total_salary=$total_salary-$donation_amount;
    //                                     $final_calculation['name']=$row->first_name." ".$row->last_name;
    //                                     $final_calculation['gross_salary']=$get_hrlu_sal;
    //                                     $final_calculation['salary_type']= $get_employee_grade->grade_type;
    //                                     $final_calculation['get_cpf_percentage']= $get_cpf_percentage;
    //                                     $final_calculation['get_cpf_percentage1']= $get_cpf_percentage1;
    //                                     $final_calculation['donation_type']=$row->donation_type;
    //                                     $final_calculation['donation_amount']=$donation_amount;
    //                                     $final_calculation['allnc_cost']=$allnc_cost;
    //                                     $final_calculation['commission_cost']=$commission_cost;
    //                                     $final_calculation['bonus_cost']=$bonus_cost;
    //                                     $final_calculation['get_overtime_cost']=$get_overtime_cost;
    //                                     $final_calculation['get_cpf_percentage1']= $get_cpf_percentage1;
    //                                     $final_calculation['total_salary']= $total_salary+$allnc_cost+$commission_cost+$get_overtime_cost;
    //
    //
    //
    //
    //                         }
    //
    //                         if($get_employee_grade->grade_type=='Daily')
    //                         {
    //
    //
    //                             $get_hrlu_sal11=$get_employee_grade->gross_salary/9;
    //
    //                             $total_monthly_hrs_salr1=round($get_hrlu_sal11,2)*$get_attandence;
    //
    //                             $get_hrlu_sal=$get_employee_grade->gross_salary*$get_attandence;
    //
    //                                     $donation_amount=0;
    //
    //
    //                                     $get_cpf_percentage=0;
    //                                     $get_cpf_percentage1=0;
    //                                     $total_salary=($get_hrlu_sal-$get_cpf_percentage)+$get_cpf_percentage1;
    //                                     $total_salary=$total_salary-$donation_amount;
    //                                     $final_calculation['name']=$row->first_name." ".$row->last_name;
    //                                     $final_calculation['gross_salary']=$get_hrlu_sal;
    //                                     $final_calculation['salary_type']= $get_employee_grade->grade_type;
    //                                     $final_calculation['get_cpf_percentage']= $get_cpf_percentage;
    //                                     $final_calculation['get_cpf_percentage1']= $get_cpf_percentage1;
    //                                     $final_calculation['donation_type']=$row->donation_type;
    //                                     $final_calculation['donation_amount']=$donation_amount;
    //                                     $final_calculation['allnc_cost']=$allnc_cost;
    //                                     $final_calculation['commission_cost']=$commission_cost;
    //                                     $final_calculation['bonus_cost']=$bonus_cost;
    //                                     $final_calculation['get_overtime_cost']=$get_overtime_cost;
    //                                     $final_calculation['get_cpf_percentage1']= $get_cpf_percentage1;
    //                                     $final_calculation['total_salary']= $total_salary+$allnc_cost+$commission_cost+$get_overtime_cost;
    //
    //
    //
    //
    //                         }
    //                     }
    //                            $final_calculation1[]=$final_calculation;
    //
    //                             $input=array(
    //                                 'employee_id' => $row->id,
    //                                 'grade_id' => $row->pay_grade,
    //                                 'gross_salary' => $final_calculation['gross_salary'],
    //                                 'salary_type' => $final_calculation['salary_type'],
    //                                 'cpf_e' => $final_calculation['get_cpf_percentage'],
    //                                 'cpf_c' => $final_calculation['get_cpf_percentage1'],
    //                                 'donation_type' =>  $final_calculation['donation_type'],
    //                                 'donation_amount' =>  $final_calculation['donation_amount'],
    //                                 'allnc_cost' => $final_calculation['allnc_cost'],
    //                                 'get_commission_id' =>  $get_commission_id,
    //                                 'get_overtime_cost' => $final_calculation['get_overtime_cost'],
    //                                 'total_salary' => $final_calculation['total_salary'],
    //                                 'created_by' => \Auth::user()->creatorId(),
    //                                 'created_at' => $created_date_time
    //
    //                             );
    //
    //                             DB::table('employee_salary')->insert($input);
    //                             if(!empty($get_commission_id))
    //                             {
    //                             $input1=array('status' => "Applied");
    //                                 DB::table('commissions')->where("id",$get_commission_id)->update($input1);
    //                             }
    //
    //
    //
    //
    //
    //
    //                  }
    //                     else
    //                     {
    //                         $get_salary_details=DB::table("employee_salary")->where("employee_id",$row->id)->orderBy("created_at","desc")->get();
    //
    //                         if(!empty($get_salary_details))
    //                         {
    //                             foreach($get_salary_details as $get_salary_detail)
    //                             {
    //                                 $get_commission_data    = DB::table("commissions")->join('emp_commissionbonus_type', 'commissions.title', '=', 'emp_commissionbonus_type.id')->select('commissions.*', 'emp_commissionbonus_type.name','emp_commissionbonus_type.amount')->where("commissions.title",$get_salary_detail->get_commission_id)->first();
    //                                 $get_bonus_data         = DB::table("emp_bonus")->join('emp_commissionbonus_type', 'emp_bonus.bonus_id', '=', 'emp_commissionbonus_type.id')->select('emp_bonus.*', 'emp_commissionbonus_type.name','emp_commissionbonus_type.amount')->where("emp_bonus.id",$get_salary_detail->get_bonus_id)->first();
    //                                 if(!empty($get_bonus_data))
    //                                     $bonus_cost=$get_bonus_data->amount;
    //
    //                                 if(!empty($get_commission_data))
    //                                     $commission_cost=$get_commission_data->amount;
    //
    //                                 $final_calculation['name']=$row->first_name." ".$row->last_name;
    //                                 $final_calculation['gross_salary']=$get_salary_detail->gross_salary;
    //                                 $final_calculation['salary_type']= $get_salary_detail->salary_type;
    //                                 $final_calculation['get_cpf_percentage']= $get_salary_detail->cpf_e;
    //                                 $final_calculation['get_cpf_percentage1']= $get_salary_detail->cpf_c;
    //                                 $final_calculation['donation_type']=$get_salary_detail->donation_type;
    //                                 $final_calculation['donation_amount']=$get_salary_detail->donation_amount;
    //                                 $final_calculation['allnc_cost']    =$get_salary_detail->allnc_cost;
    //                                 $final_calculation['commission_cost']=$commission_cost;
    //                                 $final_calculation['bonus_cost']=$bonus_cost;
    //                                 $final_calculation['get_overtime_cost']=$get_salary_detail->get_overtime_cost;
    //                                 $final_calculation['total_salary']= $get_salary_detail->total_salary;
    //
    //                                 $final_calculation1[]=$final_calculation;
    //                             }
    //                         }
    //
    //                     }
    //
    //
    //
    //
    //             }
    //             else
    //             {
    //
    //
    //                 $from_sal_date=date('Y-m-d', strtotime(date('Y').'-'.date('m').'-'.$get_salary_date->from_d));
    //                 $commission_cost=$get_overtime_cost=$bonus_cost=0;
    //                 $get_commission_id=$bonus_id='';
    //                 $get_employee_grade=EmpPaygrades::Where("id",$row->pay_grade)->first();
    //                 $get_allowannce=DB::table("emp_grade_allowances")->join('allowance_options', 'emp_grade_allowances.allowance_id', '=', 'allowance_options.id')->where("grade_id",$get_employee_grade->id)->sum('limit_month');
    //
    //                 $get_attandence=AttendanceEmployee::where("employee_id",$row->id)->whereBetween('date',[$from_sal_date,date('Y-m-d')])->sum('total_hrs');
    //                 $get_overtime=AttendanceEmployee::where("employee_id",$row->id)->whereBetween('date',[$from_sal_date,date('Y-m-d')])->sum(DB::raw("HOUR(overtime)"));
    //
    //                 $get_overtime_cost=$get_overtime*$get_employee_grade->overtime;
    //                // $get_commission=DB::table("commissions")->where("employee_id",$row->id)->where("status","Approved")->first();
    //                 $get_commission=DB::table("commissions")->join('emp_commissionbonus_type', 'commissions.title', '=', 'emp_commissionbonus_type.id')->select('commissions.*', 'emp_commissionbonus_type.name','emp_commissionbonus_type.amount')->where("employee_id",$row->id)->where("status","Approved")->first();
    //
    //                 $get_bonus=DB::table("emp_bonus")->join('emp_commissionbonus_type', 'emp_bonus.bonus_id', '=', 'emp_commissionbonus_type.id')->select('emp_bonus.*', 'emp_commissionbonus_type.amount')->where("employee_id",$row->id)->whereYear('date_bonus', date('Y'))->whereMonth('date_bonus', date('m'))->first();
    //             // dd($get_bonus);
    //                 if(!empty($get_commission))
    //                 {
    //                     $get_commission_id=$get_commission->id;
    //                     $commission_cost=$get_commission->amount;
    //                 }
    //
    //                 if(!empty($get_bonus))
    //                 {
    //                     $bonus_id=$get_bonus->id;
    //                     $bonus_cost=$get_bonus->amount;
    //                 }
    //                 $allnc_cost=$get_allowannce;
    //                 $dob=$row->dob;
    //                 $diff = (date('Y') - date('Y',strtotime($dob)));
    //
    //                 $slot_diff=date("d")-$get_salary_date->from_d;
    //                 //$slot_diff=6-$get_salary_date->from_d;
    //                // $slot_diff=date("d")-date('d', strtotime($get_past_salary_details->created_at));
    //
    //                 if($slot_diff==$get_salary_date->to_d)
    //                 {
    //
    //                     if(!empty($row->emp_type) && ($row->emp_type=='Singapore Citizen' || $row->emp_type=='Permanent Resident'))
    //                     {
    //
    //                         $sundays=$saturdy=0;
    //                         $total_days=cal_days_in_month(CAL_GREGORIAN, date('m'),date('Y'));
    //                         for($i=1;$i<=$total_days;$i++){
    //                             if(date('N',strtotime(date('Y').'-'.date('m').'-'.$i))==7){
    //                             $sundays++;
    //                             $saturdy++;
    //                             }
    //
    //                         }
    //
    //
    //                     $get_number_of_days=$slot_diff;
    //                         if($get_employee_grade->grade_type=='Monthly')
    //                         {
    //
    //
    //                             $get_hrlu_sal1=$get_employee_grade->gross_salary/($get_number_of_days*8);
    //
    //                             $total_monthly_hrs_salr=round($get_hrlu_sal1,2)*$get_attandence;
    //
    //                                     if($row->donation_type=='CDAC')
    //                                     {
    //                                         if($total_monthly_hrs_salr<2000)
    //                                         {
    //                                             $donation_amount=.50;
    //                                         }
    //                                         if($total_monthly_hrs_salr>=2000 && $total_monthly_hrs_salr<3000)
    //                                         {
    //                                             $donation_amount=1;
    //                                         }
    //                                         if($total_monthly_hrs_salr>=3000 && $total_monthly_hrs_salr<5000)
    //                                         {
    //                                             $donation_amount=1.5;
    //                                         }
    //                                         if($total_monthly_hrs_salr>=5000 && $total_monthly_hrs_salr<7000)
    //                                         {
    //                                             $donation_amount=2;
    //                                         }
    //                                         if($total_monthly_hrs_salr>=7000)
    //                                         {
    //                                             $donation_amount=3;
    //                                         }
    //                                     }elseif($row->donation_type=='ECF')
    //                                     {
    //                                         if($total_monthly_hrs_salr<=1000)
    //                                         {
    //                                             $donation_amount=2;
    //                                         }
    //                                         if($total_monthly_hrs_salr>1000 && $total_monthly_hrs_salr<1500)
    //                                         {
    //                                             $donation_amount=4;
    //                                         }
    //                                         if($total_monthly_hrs_salr>=1500 && $total_monthly_hrs_salr<2500)
    //                                         {
    //                                             $donation_amount=6;
    //                                         }
    //                                         if($total_monthly_hrs_salr>=2500 && $total_monthly_hrs_salr<4000)
    //                                         {
    //                                             $donation_amount=9;
    //                                         }
    //                                         if($total_monthly_hrs_salr>=4000 && $total_monthly_hrs_salr<7000)
    //                                         {
    //                                             $donation_amount=12;
    //                                         }
    //                                         if($total_monthly_hrs_salr>=7000 && $total_monthly_hrs_salr<10000)
    //                                         {
    //                                             $donation_amount=16;
    //                                         }
    //                                         if($total_monthly_hrs_salr>=10000)
    //                                         {
    //                                             $donation_amount=20;
    //                                         }
    //                                     }
    //                                     elseif($row->donation_type=='SINDA')
    //                                     {
    //
    //                                         if($total_monthly_hrs_salr<=1000)
    //                                         {
    //                                             $donation_amount=1;
    //                                         }
    //                                         if($total_monthly_hrs_salr>1000 && $total_monthly_hrs_salr<1500)
    //                                         {
    //                                             $donation_amount=3;
    //                                         }
    //                                         if($total_monthly_hrs_salr>=1500 && $total_monthly_hrs_salr<2500)
    //                                         {
    //                                             $donation_amount=5;
    //                                         }
    //                                         if($total_monthly_hrs_salr>=2500 && $total_monthly_hrs_salr<4500)
    //                                         {
    //
    //                                             $donation_amount=7;
    //                                         }
    //                                         if($total_monthly_hrs_salr>=4500 && $total_monthly_hrs_salr<7500)
    //                                         {
    //                                             $donation_amount=9;
    //                                         }
    //                                         if($total_monthly_hrs_salr>=7500 && $total_monthly_hrs_salr<10000)
    //                                         {
    //                                             $donation_amount=12;
    //                                         }
    //                                         if($total_monthly_hrs_salr>=10000 && $total_monthly_hrs_salr<15000)
    //                                         {
    //                                             $donation_amount=18;
    //                                         }
    //                                         if($total_monthly_hrs_salr>=15000)
    //                                         {
    //                                             $donation_amount=30;
    //                                         }
    //                                     }
    //                                     elseif($row->donation_type=='MBMF')
    //                                     {
    //
    //                                         if($total_monthly_hrs_salr<=1000)
    //                                         {
    //                                             $donation_amount=3;
    //                                         }
    //                                         if($total_monthly_hrs_salr>1000 && $total_monthly_hrs_salr<2000)
    //                                         {
    //                                             $donation_amount=4.5;
    //                                         }
    //                                         if($total_monthly_hrs_salr>=2000 && $total_monthly_hrs_salr<3000)
    //                                         {
    //
    //                                             $donation_amount=6.5;
    //                                         }
    //                                         if($total_monthly_hrs_salr>=3000 && $total_monthly_hrs_salr<4000)
    //                                         {
    //                                             $donation_amount=15;
    //                                         }
    //                                         if($total_monthly_hrs_salr>=4000 && $total_monthly_hrs_salr<6000)
    //                                         {
    //                                             $donation_amount=19.5;
    //                                         }
    //                                         if($total_monthly_hrs_salr>=6000 && $total_monthly_hrs_salr<8000)
    //                                         {
    //                                             $donation_amount=22;
    //                                         }
    //                                         if($total_monthly_hrs_salr>=8000 && $total_monthly_hrs_salr<10000)
    //                                         {
    //                                             $donation_amount=24;
    //                                         }
    //                                         if($total_monthly_hrs_salr>=10000)
    //                                         {
    //                                             $donation_amount=26;
    //                                         }
    //                                     }
    //                                     else
    //                                     {
    //                                         $donation_amount=0;
    //                                     }
    //
    //
    //                                     if($diff<=50)
    //                                     {
    //                                             $emp_intrest=20;
    //                                             $emp_intrest_c=17;
    //                                     }
    //                                     if($diff>50)
    //                                     {
    //                                             $emp_intrest=7.5;
    //                                             $emp_intrest_c=9;
    //                                     }
    //
    //                                     $get_cpf_percentage=(round($total_monthly_hrs_salr,2)*$emp_intrest)/100;
    //                                     $get_cpf_percentage1=(round($total_monthly_hrs_salr,2)*$emp_intrest_c)/100;
    //                                     $total_salary=(round($total_monthly_hrs_salr,2)-$get_cpf_percentage)+$get_cpf_percentage1;
    //                                     $total_salary=round($total_salary,2)-$donation_amount;
    //                                     $final_calculation['name']=$row->first_name." ".$row->last_name;
    //                                     $final_calculation['gross_salary']=round($total_monthly_hrs_salr,2);
    //                                     $final_calculation['salary_type']= $get_employee_grade->grade_type;
    //                                     $final_calculation['get_cpf_percentage']= round($get_cpf_percentage,2);
    //                                     $final_calculation['get_cpf_percentage1']= round($get_cpf_percentage1,2);
    //                                     $final_calculation['donation_type']=$row->donation_type;
    //                                     $final_calculation['donation_amount']=$donation_amount;
    //                                     $final_calculation['allnc_cost']=$allnc_cost;
    //                                     $final_calculation['commission_cost']=$commission_cost;
    //                                     $final_calculation['bonus_cost']=$bonus_cost;
    //                                     $final_calculation['get_overtime_cost']=$get_overtime_cost;
    //                                     $final_calculation['total_salary']= $total_salary+$allnc_cost+$commission_cost+$get_overtime_cost+$bonus_cost;
    //
    //
    //
    //
    //                         }
    //
    //                         if($get_employee_grade->grade_type=='Hourly')
    //                         {
    //
    //
    //                             $get_hrlu_sal=$get_employee_grade->gross_salary*$get_attandence;
    //
    //                                     if($row->donation_type=='CDAC')
    //                                     {
    //                                         if($get_hrlu_sal<2000)
    //                                         {
    //                                             $donation_amount=.50;
    //                                         }
    //                                         if($get_hrlu_sal>=2000 && $get_hrlu_sal<3000)
    //                                         {
    //                                             $donation_amount=1;
    //                                         }
    //                                         if($get_hrlu_sal>=3000 && $get_hrlu_sal<5000)
    //                                         {
    //                                             $donation_amount=1.5;
    //                                         }
    //                                         if($get_hrlu_sal>=5000 && $get_hrlu_sal<7000)
    //                                         {
    //                                             $donation_amount=2;
    //                                         }
    //                                         if($get_hrlu_sal>=7000)
    //                                         {
    //                                             $donation_amount=3;
    //                                         }
    //                                     }elseif($row->donation_type=='ECF')
    //                                     {
    //                                         if($get_hrlu_sal<=1000)
    //                                         {
    //                                             $donation_amount=2;
    //                                         }
    //                                         if($get_hrlu_sal>1000 && $get_hrlu_sal<1500)
    //                                         {
    //                                             $donation_amount=4;
    //                                         }
    //                                         if($get_hrlu_sal>=1500 && $get_hrlu_sal<2500)
    //                                         {
    //                                             $donation_amount=6;
    //                                         }
    //                                         if($get_hrlu_sal>=2500 && $get_hrlu_sal<4000)
    //                                         {
    //                                             $donation_amount=9;
    //                                         }
    //                                         if($get_hrlu_sal>=4000 && $get_hrlu_sal<7000)
    //                                         {
    //                                             $donation_amount=12;
    //                                         }
    //                                         if($get_hrlu_sal>=7000 && $get_hrlu_sal<10000)
    //                                         {
    //                                             $donation_amount=16;
    //                                         }
    //                                         if($get_hrlu_sal>=10000)
    //                                         {
    //                                             $donation_amount=20;
    //                                         }
    //                                     }
    //                                     elseif($row->donation_type=='SINDA')
    //                                     {
    //
    //                                         if($get_hrlu_sal<=1000)
    //                                         {
    //                                             $donation_amount=1;
    //                                         }
    //                                         if($get_hrlu_sal>1000 && $get_hrlu_sal<1500)
    //                                         {
    //                                             $donation_amount=3;
    //                                         }
    //                                         if($get_hrlu_sal>=1500 && $get_hrlu_sal<2500)
    //                                         {
    //                                             $donation_amount=5;
    //                                         }
    //                                         if($get_hrlu_sal>=2500 && $get_hrlu_sal<4500)
    //                                         {
    //
    //                                             $donation_amount=7;
    //                                         }
    //                                         if($get_hrlu_sal>=4500 && $get_hrlu_sal<7500)
    //                                         {
    //                                             $donation_amount=9;
    //                                         }
    //                                         if($get_hrlu_sal>=7500 && $get_hrlu_sal<10000)
    //                                         {
    //                                             $donation_amount=12;
    //                                         }
    //                                         if($get_hrlu_sal>=10000 && $get_hrlu_sal<15000)
    //                                         {
    //                                             $donation_amount=18;
    //                                         }
    //                                         if($get_hrlu_sal>=15000)
    //                                         {
    //                                             $donation_amount=30;
    //                                         }
    //                                     }
    //                                     elseif($row->donation_type=='MBMF')
    //                                     {
    //
    //                                         if($get_hrlu_sal<=1000)
    //                                         {
    //                                             $donation_amount=3;
    //                                         }
    //                                         if($get_hrlu_sal>1000 && $get_hrlu_sal<2000)
    //                                         {
    //                                             $donation_amount=4.5;
    //                                         }
    //                                         if($get_hrlu_sal>=2000 && $get_hrlu_sal<3000)
    //                                         {
    //
    //                                             $donation_amount=6.5;
    //                                         }
    //                                         if($get_hrlu_sal>=3000 && $get_hrlu_sal<4000)
    //                                         {
    //                                             $donation_amount=15;
    //                                         }
    //                                         if($get_hrlu_sal>=4000 && $get_hrlu_sal<6000)
    //                                         {
    //                                             $donation_amount=19.5;
    //                                         }
    //                                         if($get_hrlu_sal>=6000 && $get_hrlu_sal<8000)
    //                                         {
    //                                             $donation_amount=22;
    //                                         }
    //                                         if($get_hrlu_sal>=8000 && get_hrlu_sal<10000)
    //                                         {
    //                                             $donation_amount=24;
    //                                         }
    //                                         if($get_hrlu_sal>=10000)
    //                                         {
    //                                             $donation_amount=26;
    //                                         }
    //                                     }
    //                                     else
    //                                     {
    //                                         $donation_amount=0;
    //                                     }
    //
    //
    //                                     if($diff<=50)
    //                                     {
    //                                             $emp_intrest=20;
    //                                             $emp_intrest_c=17;
    //                                     }
    //                                     if($diff>50)
    //                                     {
    //                                             $emp_intrest=7.5;
    //                                             $emp_intrest_c=9;
    //                                     }
    //
    //                                     $get_cpf_percentage=($get_hrlu_sal*$emp_intrest)/100;
    //                                     $get_cpf_percentage1=($get_hrlu_sal*$emp_intrest_c)/100;
    //                                     $total_salary=($get_hrlu_sal-$get_cpf_percentage)+$get_cpf_percentage1;
    //                                     $total_salary=$total_salary-$donation_amount;
    //                                     $final_calculation['name']=$row->first_name." ".$row->last_name;
    //                                     $final_calculation['gross_salary']=$get_hrlu_sal;
    //                                     $final_calculation['salary_type']= $get_employee_grade->grade_type;
    //                                     $final_calculation['get_cpf_percentage']= $get_cpf_percentage;
    //                                     $final_calculation['get_cpf_percentage1']= $get_cpf_percentage1;
    //                                     $final_calculation['donation_type']=$row->donation_type;
    //                                     $final_calculation['donation_amount']=$donation_amount;
    //                                     $final_calculation['allnc_cost']=$allnc_cost;
    //                                     $final_calculation['commission_cost']=$commission_cost;
    //                                     $final_calculation['bonus_cost']=$bonus_cost;
    //                                     $final_calculation['get_overtime_cost']=$get_overtime_cost;
    //                                     $final_calculation['get_cpf_percentage1']= $get_cpf_percentage1;
    //                                     $final_calculation['total_salary']= $total_salary+$allnc_cost+$commission_cost+$get_overtime_cost+$bonus_cost;
    //
    //
    //
    //
    //                         }
    //
    //                         if($get_employee_grade->grade_type=='Daily')
    //                         {
    //
    //                             $get_hrlu_sal11=$get_employee_grade->gross_salary/9;
    //
    //                             $get_hrlu_sal=round($get_hrlu_sal11,2)*$get_attandence;
    //
    //                            // $get_hrlu_sal=$get_employee_grade->gross_salary*$get_attandence;
    //
    //                                     if($row->donation_type=='CDAC')
    //                                     {
    //                                         if($get_hrlu_sal<2000)
    //                                         {
    //                                             $donation_amount=.50;
    //                                         }
    //                                         if($get_hrlu_sal>=2000 && $get_hrlu_sal<3000)
    //                                         {
    //                                             $donation_amount=1;
    //                                         }
    //                                         if($get_hrlu_sal>=3000 && $get_hrlu_sal<5000)
    //                                         {
    //                                             $donation_amount=1.5;
    //                                         }
    //                                         if($get_hrlu_sal>=5000 && $get_hrlu_sal<7000)
    //                                         {
    //                                             $donation_amount=2;
    //                                         }
    //                                         if($get_hrlu_sal>=7000)
    //                                         {
    //                                             $donation_amount=3;
    //                                         }
    //                                     }elseif($row->donation_type=='ECF')
    //                                     {
    //                                         if($get_hrlu_sal<=1000)
    //                                         {
    //                                             $donation_amount=2;
    //                                         }
    //                                         if($get_hrlu_sal>1000 && $get_hrlu_sal<1500)
    //                                         {
    //                                             $donation_amount=4;
    //                                         }
    //                                         if($get_hrlu_sal>=1500 && $get_hrlu_sal<2500)
    //                                         {
    //                                             $donation_amount=6;
    //                                         }
    //                                         if($get_hrlu_sal>=2500 && $get_hrlu_sal<4000)
    //                                         {
    //                                             $donation_amount=9;
    //                                         }
    //                                         if($get_hrlu_sal>=4000 && $get_hrlu_sal<7000)
    //                                         {
    //                                             $donation_amount=12;
    //                                         }
    //                                         if($get_hrlu_sal>=7000 && $get_hrlu_sal<10000)
    //                                         {
    //                                             $donation_amount=16;
    //                                         }
    //                                         if($get_hrlu_sal>=10000)
    //                                         {
    //                                             $donation_amount=20;
    //                                         }
    //                                     }
    //                                     elseif($row->donation_type=='SINDA')
    //                                     {
    //
    //                                         if($get_hrlu_sal<=1000)
    //                                         {
    //                                             $donation_amount=1;
    //                                         }
    //                                         if($get_hrlu_sal>1000 && $get_hrlu_sal<1500)
    //                                         {
    //                                             $donation_amount=3;
    //                                         }
    //                                         if($get_hrlu_sal>=1500 && $get_hrlu_sal<2500)
    //                                         {
    //                                             $donation_amount=5;
    //                                         }
    //                                         if($get_hrlu_sal>=2500 && $get_hrlu_sal<4500)
    //                                         {
    //
    //                                             $donation_amount=7;
    //                                         }
    //                                         if($get_hrlu_sal>=4500 && $get_hrlu_sal<7500)
    //                                         {
    //                                             $donation_amount=9;
    //                                         }
    //                                         if($get_hrlu_sal>=7500 && $get_hrlu_sal<10000)
    //                                         {
    //                                             $donation_amount=12;
    //                                         }
    //                                         if($get_hrlu_sal>=10000 && $get_hrlu_sal<15000)
    //                                         {
    //                                             $donation_amount=18;
    //                                         }
    //                                         if($get_hrlu_sal>=15000)
    //                                         {
    //                                             $donation_amount=30;
    //                                         }
    //                                     }
    //                                     elseif($row->donation_type=='MBMF')
    //                                     {
    //
    //                                         if($get_hrlu_sal<=1000)
    //                                         {
    //                                             $donation_amount=3;
    //                                         }
    //                                         if($get_hrlu_sal>1000 && $get_hrlu_sal<2000)
    //                                         {
    //                                             $donation_amount=4.5;
    //                                         }
    //                                         if($get_hrlu_sal>=2000 && $get_hrlu_sal<3000)
    //                                         {
    //
    //                                             $donation_amount=6.5;
    //                                         }
    //                                         if($get_hrlu_sal>=3000 && $get_hrlu_sal<4000)
    //                                         {
    //                                             $donation_amount=15;
    //                                         }
    //                                         if($get_hrlu_sal>=4000 && $get_hrlu_sal<6000)
    //                                         {
    //                                             $donation_amount=19.5;
    //                                         }
    //                                         if($get_hrlu_sal>=6000 && $get_hrlu_sal<8000)
    //                                         {
    //                                             $donation_amount=22;
    //                                         }
    //                                         if($get_hrlu_sal>=8000 && get_hrlu_sal<10000)
    //                                         {
    //                                             $donation_amount=24;
    //                                         }
    //                                         if($get_hrlu_sal>=10000)
    //                                         {
    //                                             $donation_amount=26;
    //                                         }
    //                                     }
    //                                     else
    //                                     {
    //                                         $donation_amount=0;
    //                                     }
    //
    //
    //                                     if($diff<=50)
    //                                     {
    //                                             $emp_intrest=20;
    //                                             $emp_intrest_c=17;
    //                                     }
    //                                     if($diff>50)
    //                                     {
    //                                             $emp_intrest=7.5;
    //                                             $emp_intrest_c=9;
    //                                     }
    //
    //                                     $get_cpf_percentage=($get_hrlu_sal*$emp_intrest)/100;
    //                                     $get_cpf_percentage1=($get_hrlu_sal*$emp_intrest_c)/100;
    //                                     $total_salary=($get_hrlu_sal-$get_cpf_percentage)+$get_cpf_percentage1;
    //                                     $total_salary=$total_salary-$donation_amount;
    //                                     $final_calculation['name']=$row->first_name." ".$row->last_name;
    //                                     $final_calculation['gross_salary']=$get_hrlu_sal;
    //                                     $final_calculation['salary_type']= $get_employee_grade->grade_type;
    //                                     $final_calculation['get_cpf_percentage']= $get_cpf_percentage;
    //                                     $final_calculation['get_cpf_percentage1']= $get_cpf_percentage1;
    //                                     $final_calculation['donation_type']=$row->donation_type;
    //                                     $final_calculation['donation_amount']=$donation_amount;
    //                                     $final_calculation['allnc_cost']=$allnc_cost;
    //                                     $final_calculation['commission_cost']=$commission_cost;
    //                                     $final_calculation['bonus_cost']=$bonus_cost;
    //                                     $final_calculation['get_overtime_cost']=$get_overtime_cost;
    //                                     $final_calculation['get_cpf_percentage1']= $get_cpf_percentage1;
    //                                     $final_calculation['total_salary']= $total_salary+$allnc_cost+$commission_cost+$get_overtime_cost+$bonus_cost;
    //
    //
    //
    //
    //                         }
    //
    //
    //                     }
    //                     else
    //                     {
    //                         if($get_employee_grade->grade_type=='Monthly')
    //                         {
    //
    //
    //
    //
    //
    //                                     $donation_amount=0;
    //
    //
    //                                     $get_cpf_percentage=0;
    //                                     $get_cpf_percentage1=0;
    //                                     $total_salary=($get_employee_grade->gross_salary-$get_cpf_percentage)+$get_cpf_percentage1;
    //                                     $total_salary=$total_salary-$donation_amount;
    //                                     $final_calculation['name']=$row->first_name." ".$row->last_name;
    //                                     $final_calculation['gross_salary']=$get_employee_grade->gross_salary;
    //                                     $final_calculation['salary_type']= $get_employee_grade->grade_type;
    //                                     $final_calculation['get_cpf_percentage']= $get_cpf_percentage;
    //                                     $final_calculation['get_cpf_percentage1']= $get_cpf_percentage1;
    //                                     $final_calculation['donation_type']=$row->donation_type;
    //                                     $final_calculation['donation_amount']=$donation_amount;
    //                                     $final_calculation['allnc_cost']=$allnc_cost;
    //                                     $final_calculation['commission_cost']=$commission_cost;
    //                                     $final_calculation['bonus_cost']=$bonus_cost;
    //                                     $final_calculation['get_overtime_cost']=$get_overtime_cost;
    //                                     $final_calculation['get_cpf_percentage1']= $get_cpf_percentage1;
    //                                     $final_calculation['total_salary']= $total_salary+$allnc_cost+$commission_cost+$get_overtime_cost+$bonus_cost;
    //
    //
    //
    //
    //                         }
    //
    //                         if($get_employee_grade->grade_type=='Hourly')
    //                         {
    //
    //
    //
    //                             $get_hrlu_sal=$get_employee_grade->gross_salary*$get_attandence;
    //
    //                                     $donation_amount=0;
    //
    //
    //                                     $get_cpf_percentage=0;
    //                                     $get_cpf_percentage1=0;
    //                                     $total_salary=($get_hrlu_sal-$get_cpf_percentage)+$get_cpf_percentage1;
    //                                     $total_salary=$total_salary-$donation_amount;
    //                                     $final_calculation['name']=$row->first_name." ".$row->last_name;
    //                                     $final_calculation['gross_salary']=$get_hrlu_sal;
    //                                     $final_calculation['salary_type']= $get_employee_grade->grade_type;
    //                                     $final_calculation['get_cpf_percentage']= $get_cpf_percentage;
    //                                     $final_calculation['get_cpf_percentage1']= $get_cpf_percentage1;
    //                                     $final_calculation['donation_type']=$row->donation_type;
    //                                     $final_calculation['donation_amount']=$donation_amount;
    //                                     $final_calculation['allnc_cost']=$allnc_cost;
    //                                     $final_calculation['commission_cost']=$commission_cost;
    //                                     $final_calculation['bonus_cost']=$bonus_cost;
    //                                     $final_calculation['get_overtime_cost']=$get_overtime_cost;
    //                                     $final_calculation['get_cpf_percentage1']= $get_cpf_percentage1;
    //                                     $final_calculation['total_salary']= $total_salary+$allnc_cost+$commission_cost+$get_overtime_cost+$bonus_cost;
    //
    //
    //
    //
    //                         }
    //
    //                         if($get_employee_grade->grade_type=='Daily')
    //                         {
    //
    //
    //                             $get_hrlu_sal11=$get_employee_grade->gross_salary/9;
    //
    //                             $total_monthly_hrs_salr1=round($get_hrlu_sal11,2)*$get_attandence;
    //
    //                             $get_hrlu_sal=$get_employee_grade->gross_salary*$get_attandence;
    //
    //                                     $donation_amount=0;
    //
    //
    //                                     $get_cpf_percentage=0;
    //                                     $get_cpf_percentage1=0;
    //                                     $total_salary=($get_hrlu_sal-$get_cpf_percentage)+$get_cpf_percentage1;
    //                                     $total_salary=$total_salary-$donation_amount;
    //                                     $final_calculation['name']=$row->first_name." ".$row->last_name;
    //                                     $final_calculation['gross_salary']=$get_hrlu_sal;
    //                                     $final_calculation['salary_type']= $get_employee_grade->grade_type;
    //                                     $final_calculation['get_cpf_percentage']= $get_cpf_percentage;
    //                                     $final_calculation['get_cpf_percentage1']= $get_cpf_percentage1;
    //                                     $final_calculation['donation_type']=$row->donation_type;
    //                                     $final_calculation['donation_amount']=$donation_amount;
    //                                     $final_calculation['allnc_cost']=$allnc_cost;
    //                                     $final_calculation['commission_cost']=$commission_cost;
    //                                     $final_calculation['bonus_cost']=$bonus_cost;
    //                                     $final_calculation['get_overtime_cost']=$get_overtime_cost;
    //                                     $final_calculation['get_cpf_percentage1']= $get_cpf_percentage1;
    //                                     $final_calculation['total_salary']= $total_salary+$allnc_cost+$commission_cost+$get_overtime_cost+$bonus_cost;
    //
    //
    //
    //
    //                         }
    //                     }
    //                         $final_calculation1[]=$final_calculation;
    //
    //                         $input=array(
    //                             'employee_id' => $row->id,
    //                             'grade_id' => $row->pay_grade,
    //                             'gross_salary' => $final_calculation['gross_salary'],
    //                             'salary_type' => $final_calculation['salary_type'],
    //                             'cpf_e' => $final_calculation['get_cpf_percentage'],
    //                             'cpf_c' => $final_calculation['get_cpf_percentage1'],
    //                             'donation_type' =>  $final_calculation['donation_type'],
    //                             'donation_amount' =>  $final_calculation['donation_amount'],
    //                             'allnc_cost' => $final_calculation['allnc_cost'],
    //                             'get_commission_id' =>  $get_commission_id,
    //                             'get_bonus_id' =>  $bonus_id,
    //                             'get_overtime_cost' => $final_calculation['get_overtime_cost'],
    //                             'total_salary' => $final_calculation['total_salary'],
    //                             'created_by' => \Auth::user()->creatorId(),
    //                             'created_at' => $created_date_time
    //
    //                         );
    //
    //                         DB::table('employee_salary')->insert($input);
    //                         if(!empty($get_commission_id))
    //                         {
    //                         $input1=array('status' => "Applied");
    //                             DB::table('commissions')->where("id",$get_commission_id)->update($input1);
    //                         }
    //
    //
    //                 }
    //                 else
    //                 {
    //                     $get_salary_details=DB::table("employee_salary")->where("employee_id",$row->id)->orderBy("created_at","desc")->get();
    //
    //                     if(!empty($get_salary_details))
    //                     {
    //                         foreach($get_salary_details as $get_salary_detail)
    //                         {
    //                             $get_commission_data    = DB::table("commissions")->join('emp_commissionbonus_type', 'commissions.title', '=', 'emp_commissionbonus_type.id')->select('commissions.*', 'emp_commissionbonus_type.name','emp_commissionbonus_type.amount')->where("commissions.title",$get_salary_detail->get_commission_id)->first();
    //                             $get_bonus_data         = DB::table("emp_bonus")->join('emp_commissionbonus_type', 'emp_bonus.bonus_id', '=', 'emp_commissionbonus_type.id')->select('emp_bonus.*', 'emp_commissionbonus_type.name','emp_commissionbonus_type.amount')->where("emp_bonus.id",$get_salary_detail->get_bonus_id)->first();
    //                             if(!empty($get_bonus_data))
    //                                 $bonus_cost=$get_bonus_data->amount;
    //
    //                             if(!empty($get_commission_data))
    //                                 $commission_cost=$get_commission_data->amount;
    //
    //                             $final_calculation['name']=$row->first_name." ".$row->last_name;
    //                             $final_calculation['gross_salary']=$get_salary_detail->gross_salary;
    //                             $final_calculation['salary_type']= $get_salary_detail->salary_type;
    //                             $final_calculation['get_cpf_percentage']= $get_salary_detail->cpf_e;
    //                             $final_calculation['get_cpf_percentage1']= $get_salary_detail->cpf_c;
    //                             $final_calculation['donation_type']=$get_salary_detail->donation_type;
    //                             $final_calculation['donation_amount']=$get_salary_detail->donation_amount;
    //                             $final_calculation['allnc_cost']    =$get_salary_detail->allnc_cost;
    //                             $final_calculation['commission_cost']=$commission_cost;
    //                             $final_calculation['bonus_cost']=$bonus_cost;
    //                             $final_calculation['get_overtime_cost']=$get_salary_detail->get_overtime_cost;
    //                             $final_calculation['total_salary']= $get_salary_detail->total_salary;
    //
    //                             $final_calculation1[]=$final_calculation;
    //                         }
    //                     }
    //                 }
    //
    //
    //
    //             }
    //
    //     }
    //   ///dd($final_calculation1);
    //     return view('cpf.index', compact('final_calculation1'));
    // }



}
