<?php

namespace App\Imports;

use App\Models\Commitment;
use App\Models\Norm;
use App\Models\Frequency;
use App\Models\Phase;
use Maatwebsite\Excel\Concerns\ToModel;
use Carbon\Carbon;
use Auth;

class CommitmentsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $norm = Norm::where('code', $row[0])->first();
        
        if (!isset($norm) || !is_null($row[0])) {
            
            $frequency = Frequency::where('name', trim($row[4]))->first();

            if (!isset($frequency)) {
                $frequency = new Frequency;
                $frequency->name = trim($row[4]);
                $frequency->save();
            }
            
            $phase = Phase::where('name', trim($row[3]))->first();

            if (!isset($phase)) {
                $phase = new Phase;
                $phase->name = trim($row[3]);
                $phase->save();
            }
                        
            if (!is_null($norm)) {
                return new Commitment([
                    'norm_id' => $norm->id,
                    'phase_id' => $phase->id,
                    'frequency_id' => $frequency->id,
                    'code' => trim($row[1]),
                    'summary' => trim($row[2]),
                    'description' => trim($row[5]),
                    'coordinate_utm' => trim($row[6]),
                    'coordinate_nutm' => trim($row[7]),
                    'related_impact' => trim($row[8]),
                    'created_user_id' => Auth::user()->id,
                    'created_at' => Carbon::now()
                ]);
            }
            
            
        }
        
    }
}
