<?php

namespace App\Imports;

use App\Models\Norm;
use App\Models\Authority;
use Maatwebsite\Excel\Concerns\ToModel;
use Carbon\Carbon;
use Auth;

class NormsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $dateExpedition = Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[6]));
        if (isset($row[7])) {
            $dateNotification = Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[7]));
        }

        //Authority
        $authority = Authority::where ('name', trim($row[5]))->first();
        
        if (!isset($authority)) {
            $authority = new Authority();
            $authority->name = trim($row[5]);
            $authority->save();
        }
        
        return new Norm([
            'code' => $row[0],
            'applicable_standard' => trim($row[1]),
            'short_name' => trim($row[2]),
            'large_name' => trim($row[3]),
            'place_application' => trim($row[4]),
            'expedition' => $dateExpedition->format('Y-m-d'),
            'notification' => isset($row[7]) ? $dateNotification->format('Y-m-d') : null,
            'authority_id' => $authority->id,
            'created_user_id' => Auth::user()->id,
            'created_at' => Carbon::now()
        ]);
    }
}
