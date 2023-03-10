<?php

namespace App\Imports;
use App\Jbr;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\RemembersRowNumber;

class JbrImport implements ToModel
{

  protected $fillable = [
      'des_id',
      'created_by',
    ];

  use Importable;


 use RemembersRowNumber;

    public function model(array $row)
    {

      $currentRowNumber = $this->getRowNumber();

      if($currentRowNumber < 2) {
          return null;
      }


            if (!isset($row[1])) {
                return null;
            }

      $jbcheck = Jbr::where('res_name',$row[1])->where('designation_id', $this->des_id)->get();
      //var_dump($jbcheck );
      if(count($jbcheck) == 0) {
        return new Jbr([
            'designation_id'  => $this->des_id,
            'res_name'    => $row[1],
            'created_by' => \Auth::user()->creatorId()
        ]);

      }


    }





}
