<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\ReportCommitment;
use Illuminate\Support\Facades\Mail;

class NotifyClientReviewComment extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:notify-client-review-comment {id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Envio de email al cliente indicando que sus comentarios estan revisados';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $id = $this->argument('id');

        $report_commitment = ReportCommitment::findOrFail($id);

        if (isset($report_commitment->report->client->email)) {
            $emails = [$report_commitment->report->client->email, 'programador@sagperu.com'];
        
            $data = [];
            $data['client_name'] = $report_commitment->report->client->name;
            $data['report'] = $report_commitment->report->code;
            $report_code = $report_commitment->report->code;
            
            Mail::send('admin.reports.email.notify-client-review-comment', $data, function ($message) use ($emails, $report_code) {
                $message->from('comunicaciones@sagperu.com', 'Comunicaciones SAG PERU');
                $message->to($emails);
                $message->subject($report_code . ' - OBSERVACIONES REVISADAS');
            });

            $this->info('El mensaje ha sido enviado satisfactoriamente.');
        } else {
            $this->info('El mensaje no ha sido enviado.');
        }
        
    }
}
