<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportCommitmentDocument extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function document_status() {
        return $this->belongsTo('App\Models\DocumentStatus', 'document_status_id');
    }

    public function report_commitment() {
        return $this->belongsTo('App\Models\ReportCommitment', 'report_commitment_id');
    }
}
