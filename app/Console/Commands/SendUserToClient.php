<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Client;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class SendUserToClient extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:send-user-to-client {id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Envio de email al cliente enviando sus credenciales de acceso';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $id = $this->argument('id');

        $client = Client::findOrFail($id);
        $user = User::where('client_id', $id)->first();

        $emails = [$user->email, 'programador@sagperu.com'];
        
        $data = [];
        $data['name'] = $client->name;
        $data['username'] = $user->username;
        $data['password'] = $user->decrypt_key;
            
        Mail::send('admin.maintenance.clients.email.credentials', $data, function ($message) use ($emails) {
            $message->from('comunicaciones@sagperu.com', 'Comunicaciones SAG PERU');
            $message->to($emails);
            $message->subject('👏 BIENVENIDO AL SISTEMA DE INFORMES DE SAG');
        });

        $this->info('El mensaje de las credenciales del cliente ha sido enviado satisfactoriamente.');

    }
}
