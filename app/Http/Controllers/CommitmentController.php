<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Commitment;
use App\Models\Norm;
use App\Models\Phase;
use App\Models\Frequency;
use Auth;
use Excel;
use App\Imports\CommitmentsImport;
use Carbon\Carbon;

class CommitmentController extends Controller
{
    public function AllCommitment()
    {
        $commitments = Commitment::where('status', 'active')->latest()->get();
        $title = 'Listado de Compromisos';
        return view('admin.maintenance.commitments.index', compact('commitments', 'title'));
    }

    public function AddCommitment()
    {
        $commitment = null;
        $norms = Norm::where('status', 'active')->orderBy('applicable_standard')->pluck('applicable_standard', 'id');
        $phases = Phase::orderBy('name')->pluck('name', 'id');
        $frequencies = Frequency::orderBy('name')->pluck('name', 'id');

        return view('admin.maintenance.commitments.create')
                ->with('commitment', $commitment)
                ->with('norms', $norms)
                ->with('phases', $phases)
                ->with('frequencies', $frequencies);
    }

    public function StoreCommitment(Request $request)
    {
        $request->validate([
            'code' => 'required',
            'norm_id' => 'required',
            'phase_id' => 'required',
            'frequency_id' => 'required',
            'summary' => 'required',
            'description' => 'required',
        ]);

        Commitment::insert([
            'norm_id' => $request->norm_id,
            'phase_id' => $request->phase_id,
            'frequency_id' => $request->frequency_id,
            'code' => $request->code,
            'summary' => $request->summary,
            'description' => $request->description,
            'coordinate_utm' => $request->coordinate_utm,
            'coordinate_nutm' => $request->coordinate_nutm,
            'related_impact' => $request->related_impact,
            'created_user_id' => Auth::user()->id,
            'created_at' => Carbon::now()
        ]);

        $notification = array(
            'message' => 'Compromiso registrado satisfactoriamente.',
            'alert-type' => 'success'
        );

        return redirect()->route('all.commitment')->with($notification);

    }

    public function EditCommitment($id)
    {
        $commitment = Commitment::findOrFail($id);
        $norms = Norm::where('status', 'active')->orderBy('applicable_standard')->pluck('applicable_standard', 'id');
        $phases = Phase::orderBy('name')->pluck('name', 'id');
        $frequencies = Frequency::orderBy('name')->pluck('name', 'id');

        return view('admin.maintenance.commitments.edit')
                ->with('commitment', $commitment)
                ->with('norms', $norms)
                ->with('phases', $phases)
                ->with('frequencies', $frequencies);
    }

    public function UpdateCommitment(Request $request)
    {
        $pid = $request->id;

        Commitment::findOrFail($pid)->update([
            'norm_id' => $request->norm_id,
            'phase_id' => $request->phase_id,
            'frequency_id' => $request->frequency_id,
            'code' => $request->code,
            'summary' => $request->summary,
            'description' => $request->description,
            'coordinate_utm' => $request->coordinate_utm,
            'coordinate_nutm' => $request->coordinate_nutm,
            'related_impact' => $request->related_impact,
            'updated_user_id' => Auth::user()->id,
            'updated_at' => Carbon::now()
        ]);

        $notification = array(
            'message' => 'Compromiso actualizado satisfactoriamente.',
            'alert-type' => 'success'
        );

        return redirect()->route('all.commitment')->with($notification);
    }

    public function DeleteCommitment($id)
    {
        Commitment::findOrFail($id)->update([
            'status' => 'inactive',
            'updated_user_id' => Auth::user()->id,
            'updated_at' => Carbon::now()
        ]);

        $notification = array(
            'message' => 'Compromiso eliminando satisfactoriamente.',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function ImportCommitment(Request $request)
    {
        Excel::import(new CommitmentsImport, $request->file);

        $notification = array(
            'message' => 'Compromisos importados satisfactoriamente.',
            'alert-type' => 'success'
        );

        return redirect()->route('all.commitment')->with($notification);
    }
}
