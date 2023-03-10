<?php

namespace App;
use App\ClaimsItems;

use Illuminate\Database\Eloquent\Model;

class Claim extends Model
{
    //




    protected $fillable = [
        'employee_id',
        'title',
        'amount',
        'remark',
        'status',
        'documents',
        'created_by',
        'claimdate',
    ];


    public static function claim_id()
    {
        $claim = Claim::latest()->first();

        return !empty($claim) ? $claim->id + 1 : 1;
    }


    public static function claim_tax_values()
    {
      // TODO values in array to be replaced by language file variables

      return array(
        'Yes' => 'Yes',
        'No' => 'No'
      );

    }


    public static function CalculateAmount($claim_id) {
        $taxconfig  = \App\Claim::claim_tax_pcent();
        $claim_items = ClaimsItems::where('claim_id', '=', $claim_id)->get();
        $subtot = 0;
        foreach($claim_items as $item) {

          $linecal = $item['qty'] * $item['price'];
            if($item['tax'] == $taxconfig[1]) {
              $linetax = ($linecal) * $taxconfig[0];
            } else {
              $linetax = 0;
            }
            $subtot = $subtot + $linecal + $linetax;
        }
        return $subtot;
    }


    public static function claim_status_values()
    {
      // TODO values in array to be replaced by language file variables

      return array(
        'Pending' => 'Pending',
        'Approved' => 'Approved'
      );
    }

    public static function claim_tax_pcent()
    {

      return array(0.07,'Yes');
    }
  /*  public function documents()
    {
        return $this->hasMany('App\EmployeeDocument', 'employee_id', 'employee_id')->get();
    }
*/
    public function employee()
    {
        return $this->hasOne('App\Employee', 'id', 'employee_id');
    }






}
