<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\User;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Artisan;

class ClientController extends Controller
{
    public function AllClient()
    {
        $clients = Client::latest()->get();
        $title = 'Listado de Clientes';
        return view('admin.maintenance.clients.index', compact('clients', 'title'));
    }

    public function AddClient()
    {
        $client = null;
                
        return view('admin.maintenance.clients.create')
                ->with('client', $client);
    }

    public function StoreClient(Request $request)
    {
        $request->validate([
            'document' => 'required',
            'name' => 'required',
            'identifier' => 'required',
        ]);

        Client::insert([
            'document' => $request->document,
            'identifier' => $request->identifier,
            'name' => $request->name,
            'contact' => strtoupper($request->contact),
            'email' => strtoupper($request->email),
            'created_user_id' => Auth::user()->id,
            'created_at' => Carbon::now()
        ]);

        $notification = array(
            'message' => 'Cliente actualizado satisfactoriamente.',
            'alert-type' => 'success'
        );

        return redirect()->route('all.client')->with($notification);
    }

    public function EditClient($id)
    {
        $client = Client::findOrFail($id);
                
        return view('admin.maintenance.clients.edit')
                ->with('client', $client);
    }

    public function UpdateClient(Request $request)
    {
        $pid = $request->id;

        Client::findOrFail($pid)->update([
            'contact' => strtoupper($request->contact),
            'email' => strtoupper($request->email),
            'updated_user_id' => Auth::user()->id,
            'updated_at' => Carbon::now()
        ]);

        $notification = array(
            'message' => 'Cliente actualizado satisfactoriamente.',
            'alert-type' => 'success'
        );

        return redirect()->route('all.client')->with($notification);

    }

    public function DeleteClient()
    {
        
    }

    public function EnableUserClient($id)
    {
        $client = Client::findOrFail($id);

        Client::findOrFail($id)->update([
            'status' => 'active',
            'updated_user_id' => Auth::user()->id,
            'updated_at' => Carbon::now()
        ]);

        $user = User::where('client_id', $client->id)->first();
        
        if (!isset($user)) {

            User::insert([
                'name' => $client->name,
                'username' => $client->document,
                'email' => $client->email,
                'decrypt_key' => $client->document,
                'password' => Hash::make($client->document),
                'client_id' => $client->id,
                'role' => 'user',
                'created_user_id' => Auth::user()->id,
                'created_at' => Carbon::now()
            ]);

        } else {
            User::findOrFail($user->id)->update([
                'status' => 'active',
                'decrypt_key' => $client->document,
                'password' => Hash::make($client->document),
                'updated_user_id' => Auth::user()->id,
                'updated_at' => Carbon::now()
            ]);
        }

        //Enviando correo
        Artisan::call("email:send-user-to-client", ['id' => $client->id]);

        $notification = array(
            'message' => 'Se enviaros las credenciales de acceso al cliente satisfactoriamente.',
            'alert-type' => 'success'
        );

        return redirect()->route('all.client')->with($notification);

    }

    public function DisableUserClient($id)
    {
        $client = Client::findOrFail($id);
        $client->status = 'inactive';
        $client->updated_user_id = Auth::user()->id;
        $client->updated_at = Carbon::now();
        $client->save();

        $user = User::where('client_id', $id)->first();

        User::findOrFail($user->id)->update([
            'status' => 'inactive',
            'updated_user_id' => Auth::user()->id,
            'updated_at' => Carbon::now()
        ]);

        $notification = array(
            'message' => 'Cliente deshabilitado satisfactoriamente.',
            'alert-type' => 'success'
        );

        return redirect()->route('all.client')->with($notification);
    }
}
