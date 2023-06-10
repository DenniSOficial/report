<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Norm extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function authority() {
        return $this->belongsTo('App\Models\Authority', 'authority_id');
    }
}
