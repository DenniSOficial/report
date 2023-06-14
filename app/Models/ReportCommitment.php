<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ReportCommitmentDocument;

class ReportCommitment extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function report() {
        return $this->belongsTo('App\Models\Report', 'report_id');
    }

    public function commitment() {
        return $this->belongsTo('App\Models\Commitment', 'commitment_id');
    }

    public function cantityDocumentsByCommitment() {
        $documents = ReportCommitmentDocument::where('status', 'active')->where('report_commitment_id', $this->id)->count();
        return $documents;
    }
}
