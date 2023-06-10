<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReportManager;
use Auth;
use Carbon\Carbon;

class ReportManagerController extends Controller
{
    public function AllReportManager()
    {
        $report_managers = ReportManager::where('status', 'active')->latest()->get();
        $title = 'Listado de Encargados';
        return view('admin.maintenance.report-managers.index', compact('report_managers', 'title'));
    }

    public function AddReportManager()
    {
        $report_manager = null;
        $types = ['DNI', 'CE'];
        
        return view('admin.maintenance.report-managers.create')
                ->with('report_manager', $report_manager)
                ->with('types', $types);
    }

    public function StoreReportManager(Request $request)
    {
        $request->validate([
            'type_document' => 'required',
            'document' => 'required',
            'lastname' => 'required',
            'lastname2' => 'required',
            'name' => 'required',
            'email' => 'required',
        ]);

        ReportManager::insert([
            'type_document' => $request->type_document,
            'document' => $request->document,
            'lastname' => strtoupper($request->lastname),
            'lastname2' => strtoupper($request->lastname2),
            'name' => strtoupper($request->name),
            'email' => $request->email,
            'telephone' => $request->telephone,
            'created_user_id' => Auth::user()->id,
            'created_at' => Carbon::now()
        ]);

        $notification = array(
            'message' => 'Encargado registrado satisfactoriamente.',
            'alert-type' => 'success'
        );

        return redirect()->route('all.report-manager')->with($notification);
    }

    public function EditReportManager($id)
    {
        $report_manager = ReportManager::findOrFail($id);
        $types = ['DNI', 'CE'];
        
        return view('admin.maintenance.report-managers.edit')
                ->with('report_manager', $report_manager)
                ->with('types', $types);
    }

    public function UpdateReportManager(Request $request)
    {
        $pid = $request->id;

        ReportManager::findOrFail($pid)->update([
            'type_document' => $request->type_document,
            'document' => $request->document,
            'lastname' => strtoupper($request->lastname),
            'lastname2' => strtoupper($request->lastname2),
            'name' => strtoupper($request->name),
            'email' => $request->email,
            'telephone' => $request->telephone,
            'updated_user_id' => Auth::user()->id,
            'updated_at' => Carbon::now()
        ]);

        $notification = array(
            'message' => 'Encargado actualizado satisfactoriamente.',
            'alert-type' => 'success'
        );

        return redirect()->route('all.report-manager')->with($notification);

    }

    public function DeleteReportManager($id)
    {
        ReportManager::findOrFail($id)->update([
            'status' => 'inactive',
            'updated_user_id' => Auth::user()->id,
            'updated_at' => Carbon::now()
        ]);

        $notification = array(
            'message' => 'Encargado eliminado satisfactoriamente.',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
