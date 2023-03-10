<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Utility extends Model
{
    public static function settings()
    {
        $data = DB::table('settings');
        if(\Auth::check())
        {
            $userId = \Auth::user()->creatorId();
            $data   = $data->where('created_by', '=', $userId);
        }
        else
        {
            $data = $data->where('created_by', '=', 1);
        }
        $data = $data->get();

        $settings = [
            "site_currency" => "Dollars",
            "site_currency_symbol" => "$",
            "site_currency_symbol_position" => "pre",
            "site_date_format" => "M j, Y",
            "site_time_format" => "g:i A",
            "company_name" => "",
            "company_address" => "",
            "company_city" => "",
            "company_state" => "",
            "company_zipcode" => "",
            "company_country" => "",
            "company_telephone" => "",
            "company_email" => "",
            "employee_prefix" => "#EMP00",
            "footer_title" => "",
            "footer_notes" => "",
            "company_start_time" => "09:00",
            "company_end_time" => "18:00",
            'user_create' => '1',
            'employee_create' => '1',
            'payroll_create' => '1',
            'ticket_create' => '1',
            'award_create' => '1',
            'employee_transfer' => '1',
            'employee_resignation' => '1',
            'employee_trip' => '1',
            'employee_promotion' => '1',
            'employee_complaints' => '1',
            'employee_warning' => '1',
            'employee_termination' => '1',
            'leave_status' => '1',
            "default_language" => "en",
        ];

        foreach($data as $row)
        {
            $settings[$row->name] = $row->value;
        }

        return $settings;
    }

    public static function languages()
    {
        $dir     = base_path() . '/resources/lang/';
        $glob    = glob($dir . "*", GLOB_ONLYDIR);
        $arrLang = array_map(
            function ($value) use ($dir){
                return str_replace($dir, '', $value);
            }, $glob
        );
        $arrLang = array_map(
            function ($value) use ($dir){
                return preg_replace('/[0-9]+/', '', $value);
            }, $arrLang
        );
        $arrLang = array_filter($arrLang);

        return $arrLang;
    }

    public static function getValByName($key)
    {
        $setting = Utility::settings();
        if(!isset($setting[$key]) || empty($setting[$key]))
        {
            $setting[$key] = '';
        }

        return $setting[$key];
    }

    public static function setEnvironmentValue(array $values)
    {
        $envFile = app()->environmentFilePath();
        $str     = file_get_contents($envFile);
        if(count($values) > 0)
        {
            foreach($values as $envKey => $envValue)
            {
                $keyPosition       = strpos($str, "{$envKey}=");
                $endOfLinePosition = strpos($str, "\n", $keyPosition);
                $oldLine           = substr($str, $keyPosition, $endOfLinePosition - $keyPosition);
                // If key does not exist, add it
                if(!$keyPosition || !$endOfLinePosition || !$oldLine)
                {
                    $str .= "{$envKey}='{$envValue}'\n";
                }
                else
                {
                    $str = str_replace($oldLine, "{$envKey}='{$envValue}'", $str);
                }
            }
        }
        $str = substr($str, 0, -1);
        $str .= "\n";
        if(!file_put_contents($envFile, $str))
        {
            return false;
        }

        return true;
    }

    public static $emailStatus = [
        'user_create' => 'User Create',
        'employee_create' => 'Employee Create',
        'payroll_create' => 'Payroll create',
        'ticket_create' => 'Ticket create',
        'award_create' => 'Award create',
        'employee_transfer' => 'Employee Transfer',
        'employee_resignation' => 'Employee Resignation',
        'employee_trip' => 'Employee Trip',
        'employee_promotion' => 'Employee Promotion',
        'employee_complaints' => 'Employee Complaints',
        'employee_warning' => 'Employee Warning',
        'employee_termination' => 'Employee Termination',
        'leave_status' => 'Leave Status',
    ];

    public static function employeePayslipDetail($employeeId)
    {
        $earning['allowance']         = Allowance::where('employee_id', $employeeId)->get();
        $earning['totalAllowance']    = Allowance::where('employee_id', $employeeId)->get()->sum('amount');
        $earning['commission']        = Commission::where('employee_id', $employeeId)->get();
        $earning['totalCommission']   = Commission::where('employee_id', $employeeId)->get()->sum('amount');
        $earning['otherPayment']      = OtherPayment::where('employee_id', $employeeId)->get();
        $earning['totalOtherPayment'] = OtherPayment::where('employee_id', $employeeId)->get()->sum('amount');
        $earning['overTime']          = Overtime::select('id', 'title')->selectRaw('number_of_days * hours* rate as amount')->where('employee_id', $employeeId)->get();
        $earning['totalOverTime']     = Overtime::selectRaw('number_of_days * hours* rate as total')->where('employee_id', $employeeId)->get()->sum('total');

        $deduction['loan']           = Loan::where('employee_id', $employeeId)->get();
        $deduction['totalLoan']      = Loan::where('employee_id', $employeeId)->get()->sum('amount');
        $deduction['deduction']      = SaturationDeduction::where('employee_id', $employeeId)->get();
        $deduction['totalDeduction'] = SaturationDeduction::where('employee_id', $employeeId)->get()->sum('amount');

        $payslip['earning']        = $earning;
        $payslip['totalEarning']   = $earning['totalAllowance'] + $earning['totalCommission'] + $earning['totalOtherPayment'] + $earning['totalOverTime'];
        $payslip['deduction']      = $deduction;
        $payslip['totalDeduction'] = $deduction['totalLoan'] + $deduction['totalDeduction'];

        return $payslip;
    }

    public static function delete_directory($dir)
    {
        if(!file_exists($dir))
        {
            return true;
        }
        if(!is_dir($dir))
        {
            return unlink($dir);
        }
        foreach(scandir($dir) as $item)
        {
            if($item == '.' || $item == '..')
            {
                continue;
            }
            if(!self::delete_directory($dir . DIRECTORY_SEPARATOR . $item))
            {
                return false;
            }
        }

        return rmdir($dir);
    }
}
