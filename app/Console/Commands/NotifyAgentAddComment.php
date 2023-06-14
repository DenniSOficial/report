<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\ReportCommitment;
use App\Models\ReportManager;
use Illuminate\Support\Facades\Mail;

class NotifyAgentAddComment extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:notify-agent-add-comment {id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Envio de email al agente de comentarios agregados';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $id = $this->argument('id');

        $report_commitment = ReportCommitment::findOrFail($id);
        $report_manager = ReportManager::findOrFail($report_commitment->report->report_manager_id);
        
        $emails = [$report_manager->email, 'programador@sagperu.com'];
        
        $data = [];
        $data['client_name'] = $report_commitment->report->client->name;
        $data['report'] = $report_commitment->report->code;
        $report_code = $report_commitment->report->code;
        //$data['username'] = $user->username;
        //$data['password'] = $user->decrypt_key;
        
        Mail::send('admin.reports.email.notify-agent-add-comment', $data, function ($message) use ($emails, $report_code) {
            $message->from('comunicaciones@sagperu.com', 'Comunicaciones SAG PERU');
            $message->to($emails);
            $message->subject($report_code . ' - NUEVAS OBSERVACIONES REGISTRADAS');
        });

        $this->info('El mensaje ha sido enviado satisfactoriamente.');
    }
}
