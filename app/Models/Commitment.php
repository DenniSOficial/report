<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commitment extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function norm() {
        return $this->belongsTo('App\Models\Norm', 'norm_id');
    }

    public function frequency() {
        return $this->belongsTo('App\Models\Frequency', 'frequency_id');
    }

    public function phase() {
        return $this->belongsTo('App\Models\Phase', 'phase_id');
    }
}
