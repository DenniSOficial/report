<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Norm;
use App\Models\Authority;
use Auth;
use Excel;
use App\Imports\NormsImport;
use Carbon\Carbon;

class NormController extends Controller
{
    public function AllNorm()
    {
        $norms = Norm::where('status', 'active')->latest()->get();
        $title = 'Listado de Normas / IGA';
        return view('admin.maintenance.norms.index', compact('norms', 'title'));
    }

    public function AddNorm()
    {
        $norm = null;
        $authorities = Authority::orderBy('name')->pluck('name', 'id');

        return view('admin.maintenance.norms.create')
                ->with('norm', $norm)
                ->with('authorities', $authorities);
    }

    public function StoreNorm(Request $request)
    {
        $request->validate([
            'code' => 'required',
            'authority_id' => 'required',
            'applicable_standard' => 'required',
            'large_name' => 'required',
            'short_name' => 'required',
            'place_application' => 'required',
            'expedition' => 'required',
        ]);

        Norm::insert([
            'code' => $request->code,
            'authority_id' => $request->authority_id,
            'applicable_standard' => $request->applicable_standard,
            'large_name' => $request->large_name,
            'short_name' => $request->short_name,
            'place_application' => $request->place_application,
            'expedition' => $request->expedition,
            'notification' => is_null($request->notification) ? null : $request->notification,
            'url' => is_null($request->url) ? null : $request->url,
            'created_user_id' => Auth::user()->id,
            'created_at' => Carbon::now()
        ]);

        $notification = array(
            'message' => 'Norma/IGA registrada satisfactoriamente.',
            'alert-type' => 'success'
        );

        return redirect()->route('all.norm')->with($notification);
    }

    public function EditNorm($id)
    {
        $norm = Norm::findOrFail($id);
        $authorities = Authority::orderBy('name')->pluck('name', 'id');

        return view('admin.maintenance.norms.edit')
                ->with('norm', $norm)
                ->with('authorities', $authorities);
    }

    public function UpdateNorm(Request $request)
    {
        $pid = $request->id;

        Norm::findOrFail($pid)->update([
            'code' => $request->code,
            'authority_id' => $request->authority_id,
            'applicable_standard' => $request->applicable_standard,
            'large_name' => $request->large_name,
            'short_name' => $request->short_name,
            'place_application' => $request->place_application,
            'expedition' => $request->expedition,
            'notification' => is_null($request->notification) ? null : $request->notification,
            'url' => is_null($request->url) ? null : $request->url,
            'updated_user_id' => Auth::user()->id,
            'updated_at' => Carbon::now()
        ]);

        $notification = array(
            'message' => 'Norma/IGA actualizada satisfactoriamente.',
            'alert-type' => 'success'
        );

        return redirect()->route('all.norm')->with($notification);
    }

    public function DeleteNorm($id)
    {
        Norm::findOrFail($id)->update([
            'status' => 'inactive',
            'updated_user_id' => Auth::user()->id,
            'updated_at' => Carbon::now()
        ]);

        $notification = array(
            'message' => 'Norma/IGA eliminada satisfactoriamente.',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function ImportNorm(Request $request)
    {
        Excel::import(new NormsImport, $request->file);

        $notification = array(
            'message' => 'Normas importadas satisfactoriamente.',
            'alert-type' => 'success'
        );

        return redirect()->route('all.norm')->with($notification);

    }
}
