<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function client() {
        return $this->belongsTo('App\Models\Client', 'client_id');
    }

    public function type_report() {
        return $this->belongsTo('App\Models\TypeReport', 'type_report_id');
    }
}
