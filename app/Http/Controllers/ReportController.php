<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;
use App\Models\Commitment;
use App\Models\ReportManager;
use App\Models\TypeReport;
use App\Models\Client;
use Auth;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function AllReport()
    {
        $reports = Report::where('status', 'active')->latest()->get();
        $title = 'Listado de Informes';
        return view('admin.reports.index', compact('reports', 'title'));
    }

    public function AddReport()
    {
        $report = null;
        $report_commitments = [];
        $commitments = Commitment::where('status', 'active')
                                    ->orderBy('code')->get();
        
        $report_managers = ReportManager::where('status', 'active')
                                            ->orderBy('lastname')
                                            ->orderBy('lastname2')
                                            ->orderBy('name')->get();

        $types = TypeReport::orderBy('description')
                                ->pluck('description', 'id');
        
        $companies = array('QYECO', 'SAG');
        
        return view('admin.reports.create')
                ->with('report', $report)
                ->with('report_commitments', $report_commitments)
                ->with('commitments', $commitments)
                ->with('report_managers', $report_managers)
                ->with('types', $types)
                ->with('companies', $companies);
    }

    public function StoreReport(Request $request)
    {
        $request->validate([
            'quote_number' => 'required',
            'report_manager_id' => 'required',
            'client_id' => 'required',
            'client_executive_id' => 'required',
            'type_report_id' => 'required',
            'expedition' => 'required',
            'to_name' => 'required'
        ]);

        //Buscamos el usuario
        $client = Client::where('Identifier', $request->client_id)->first();
        
        if (!isset($client)) {
            $client = new Client;
            $client->document = $request->client_document;
            $client->identifier = $request->client_id;
            $client->name = $request->client_name;
            $client->created_user_id =Auth::user()->id;
            $client->created_at = Carbon::now();
            $client->save();
        }

        Report::insert([
            'report_manager_id' => $request->report_manager_id,
            'report_status_id' => 1,
            'type_report_id' => $request->type_report_id,
            'client_id' => $client->id,
            'code' => $request->code,
            'client_executive_id' => $request->client_executive_id,
            'client_executive' => $request->client_executive,
            'quote_number' => strtoupper($request->quote_number),
            'to_name' => $request->to_name,
            'expedition' => $request->expedition,
            'notification' => $request->notification,
            'shipping' => $request->shipping,
            'laboratory_report_number' => $request->laboratory_report_number,
            'created_user_id' => Auth::user()->id,
            'created_at' => Carbon::now()
        ]);

        $notification = array(
            'message' => 'Informe registrado satisfactoriamente.',
            'alert-type' => 'success'
        );

        return redirect()->route('all.report')->with($notification);
    }

    public function EditReport($id)
    {
        $report = Report::findOrFail($id);
        $report_commitments = [];
        $commitments = Commitment::where('status', 'active')
                                    ->orderBy('code')->get();
        
        $report_managers = ReportManager::where('status', 'active')
                                            ->orderBy('lastname')
                                            ->orderBy('lastname2')
                                            ->orderBy('name')->get();

        $types = TypeReport::orderBy('description')
                                ->pluck('description', 'id');
        
        $companies = array('QYECO', 'SAG');
        
        return view('admin.reports.edit')
                ->with('report', $report)
                ->with('report_commitments', $report_commitments)
                ->with('commitments', $commitments)
                ->with('report_managers', $report_managers)
                ->with('types', $types)
                ->with('companies', $companies);
    }

    public function DocumentReport($id)
    {
        dd($id);
    }
}
