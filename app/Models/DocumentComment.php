<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentComment extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user_created() {
        return $this->belongsTo('App\Models\User', 'created_user_id');
    }
}
