<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportManager extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function NombreCompleto()
    {
        return $this->lastname . ' ' . $this->lastname2 . ' ' . $this->name;
    }
}
