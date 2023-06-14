<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;
use App\Models\Commitment;
use App\Models\ReportCommitment;
use App\Models\ReportCommitmentDocument;
use App\Models\ReportManager;
use App\Models\TypeReport;
use App\Models\DocumentComment;
use App\Models\Client;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Artisan;

class ReportController extends Controller
{
    public function AllReport()
    {
        $user = Auth::user();
        
        switch ($user->role) {
            case 'admin':
                $reports = Report::where('status', 'active')->latest()->get();
                break;
            case 'agent':
                $reports = Report::where('status', 'active')->where('created_user_id', $user->id)->latest()->get();
                break;
            case 'user':
                $reports = Report::where('status', 'active')->where('client_id', $user->client_id)->latest()->get();
                break;
            default:
                # code...
                break;
        }
        
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
            'report_manager_id' => 'required',
            'client_id' => 'required',
            'type_report_id' => 'required',
            'expedition' => 'required',
            'to_name' => 'required'
        ]);

        //Buscamos el usuario, si no existe lo creamos
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

        $report = new Report();
        $report->report_manager_id = $request->report_manager_id;
        $report->report_status_id = 1;
        $report->type_report_id = $request->type_report_id;
        $report->client_id = $client->id;
        $report->code = $request->code;
        $report->client_executive_id = $request->client_executive_id;
        $report->client_executive = $request->client_executive;
        $report->quote_number = strtoupper($request->quote_number);
        $report->to_name = $request->to_name;
        $report->expedition = $request->expedition;
        $report->notification = $request->notification;
        $report->shipping = $request->shipping;
        $report->laboratory_report_number = $request->laboratory_report_number;
        $report->created_user_id = Auth::user()->id;
        $report->created_at = Carbon::now();
        $report->save();
        
        if (isset($request->commitments)) {
            foreach ($request->commitments as $key => $value) {
                $item = new ReportCommitment();
                $item->report_id = $report->id;
                $item->commitment_id = $value;
                $item->created_user_id = Auth::user()->id;
                $item->created_at = Carbon::now();
                $item->save();
            }
        }

        $notification = array(
            'message' => 'Informe registrado satisfactoriamente.',
            'alert-type' => 'success'
        );

        return redirect()->route('all.report')->with($notification);
    }

    public function EditReport($id)
    {
        $report = Report::findOrFail($id);
        $report_commitments = ReportCommitment::where('report_id', $report->id)->where('status', 'active')->get()->toArray();
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

    public function UpdateReport(Request $request)
    {
        $pid = $request->id;

        $report = Report::findOrFail($pid);
        $report->report_manager_id = $request->report_manager_id;
        $report->type_report_id = $request->type_report_id;
        $report->code = $request->code;
        $report->quote_number = strtoupper($request->quote_number);
        $report->to_name = $request->to_name;
        $report->expedition = $request->expedition;
        $report->notification = $request->notification;
        $report->shipping = $request->shipping;
        $report->laboratory_report_number = $request->laboratory_report_number;
        $report->updated_user_id = Auth::user()->id;
        $report->updated_at = Carbon::now();
        $report->save();

        ReportCommitment::where('report_id', $pid)->delete();

        if (isset($request->commitments)) {
            foreach ($request->commitments as $key => $value) {
                $item = new ReportCommitment();
                $item->report_id = $report->id;
                $item->commitment_id = $value;
                $item->created_user_id = Auth::user()->id;
                $item->created_at = Carbon::now();
                $item->save();
            }
        }

        $notification = array(
            'message' => 'Informe actualizado satisfactoriamente.',
            'alert-type' => 'success'
        );

        return redirect()->route('all.report')->with($notification);
    }

    public function DeleteReport($id)
    {
        Report::findOrFail($id)->update([
            'status' => 'inactive',
            'updated_user_id' => Auth::user()->id,
            'updated_at' => Carbon::now()
        ]);

        $notification = array(
            'message' => 'Informe eliminado satisfactoriamente.',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function CommitmentsReport($id)
    {
        $report = Report::findOrFail($id);
        $report_commitments = ReportCommitment::where('status', 'active')->where('report_id', $id)->get();

        return view('admin.reports.commitments', compact('report', 'report_commitments'));
    }

    public function UploadDocument($id)
    {
        $pid = $id;

        $report_commitment = ReportCommitment::findOrFail($pid);
        $documents = ReportCommitmentDocument::where('status', 'active')->where('report_commitment_id', $pid)->get();
        $title = 'Listado de Documentos';

        return view('admin.reports.commitment-documents', compact('report_commitment', 'documents', 'title'));
        
    }

    public function StoreuploadDocument(Request $request)
    {

        if ($request->file('document')) {
            
            $file =$request->file('document');
            $filename = time(). '_' . $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $location = 'files';
            $file->move($location, $filename);
            $filepath = url('files/' . $filename);

            $report_commitment_document = new ReportCommitmentDocument;
            $report_commitment_document->report_commitment_id = $request->id;
            $report_commitment_document->document_status_id = 1;
            $report_commitment_document->title = $request->title;
            $report_commitment_document->url = $filepath;
            $report_commitment_document->code_document = '';
            $report_commitment_document->created_user_id = Auth::user()->id;
            $report_commitment_document->created_at = Carbon::now();
            $report_commitment_document->save();

            $notification = array(
                'message' => 'Documento subido satisfactoriamente.',
                'alert-type' => 'success'
            );

        } else {
            $notification = array(
                'message' => 'No se pudo subir el documento, verifique.',
                'alert-type' => 'warning'
            );
        }

        return redirect()->back()->with($notification);

    }

    public function AddComment($document)
    {
        $pid = $document;
        $document = ReportCommitmentDocument::findOrFail($pid);

        return view('admin.reports.add-comments')
                    ->with('document', $document);
    }

    public function StoreAddComment(Request $request)
    {
        $pid = $request->id;

        if (Auth::user()->role == 'user') {
            $report_commitment_document = ReportCommitmentDocument::findOrFail($pid);
            $report_commitment_document->document_status_id = 2;
            $report_commitment_document->updated_user_id = Auth::user()->id;
            $report_commitment_document->updated_at = Carbon::now();
            $report_commitment_document->save();
        }
        
        $document_comment = new DocumentComment();
        $document_comment->document_id = $pid;
        $document_comment->Comment = $request->summernote;
        $document_comment->created_user_id = Auth::user()->id;
        $document_comment->created_at = Carbon::now();
        $document_comment->save();

        if (Auth::user()->role == 'user') {
            Artisan::call("email:notify-agent-add-comment", ['id' => $pid]);
        }
        
        $notification = array(
            'message' => 'Comentario registrado satisfactoriamente.',
            'alert-type' => 'success'
        );

        return redirect()->route('upload.report', $pid)->with($notification);
    }

    public function TrackingComment($id)
    {
        $report_commitment_document = ReportCommitmentDocument::findOrFail($id);
        $comments = DocumentComment::where('document_id', $id)->get();

        return view('admin.reports.tracking')->with('report_commitment_document', $report_commitment_document)
                                            ->with('comments', $comments);
    }

    public function CloseComment($id)
    {
        $report_commitment_document = ReportCommitmentDocument::findOrFail($id);
        $report_commitment_document->document_status_id = 3;
        $report_commitment_document->updated_user_id = Auth::user()->id;
        $report_commitment_document->updated_at = Carbon::now();
        $report_commitment_document->save();

        Artisan::call("email:notify-client-review-comment", ['id' => $id]);

        $notification = array(
            'message' => 'Comentario cerrado satisfactoriamente.',
            'alert-type' => 'success'
        );

        return redirect()->route('upload.report', $id)->with($notification);
    }
    
}
