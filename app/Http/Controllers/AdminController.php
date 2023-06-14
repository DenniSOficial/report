<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Custom\WebServiceManagerCurl;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class AdminController extends Controller
{
    protected $urlApiSAG = 'http://161.132.181.82:85/sag-app/public/api';

    public function AdminDashboard()
    {
        return view('admin.dashboard');
    }
    
    public function AdminLogout(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }

    public function AdminChangePassword()
    {
        return view('admin.administration.users.change-password');
    }

    public function AdminUpdatePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed'
        ]);

        if (!Hash::check($request->old_password, Auth::user()->password)) {
            $notification = array(
                'message' => 'Contraseña anterior no coinciden!',
                'alert-type' => 'error'
            );
    
            return redirect()->back()->with($notification);
        }

        User::whereId(Auth::user()->id)->update([
            'decrypt_key' => $request->new_password,
            'password' => Hash::make($request->new_password)
        ]);

        $notification = array(
            'message' => 'Contraseña cambiada satisfactoriamente.',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }

    public function AllUser()
    {
        $users = User::where('role', '<>', 'user')->latest()->get();
        return view('admin.administration.users.index', compact('users'));
    }

    public function AddUser()
    {
        $user = null;
        $roles = ['admin', 'agent'];

        return view('admin.administration.users.create', compact('user', 'roles'));
    }

    public function StoreUser(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'username' => 'required',
            'role' => 'required',
            'email' => 'required',
            'password' => 'required',
            'repassword' => 'required',
        ]);

        if ($request->password !== $request->repassword) {
            $notification = array(
                'message' => 'Las contraseñas no coinciden.',
                'alert-type' => 'warning'
            );
            return redirect()->back()->with($notification);
        }

        User::insert([
            'name' => strtoupper($request->name),
            'username' => strtoupper($request->username),
            'email' => strtoupper($request->email),
            'decrypt_key' => strtoupper($request->password),
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'created_user_id' => Auth::user()->id,
            'created_at' => Carbon::now()
        ]);

        $notification = array(
            'message' => 'Usuario registrado satisfactoriamente.',
            'alert-type' => 'success'
        );

        return redirect()->route('all.user')->with($notification);
    }

    public function EditUser($id)
    {
        $user = User::findOrFail($id);
        $roles = ['admin', 'agent'];

        return view('admin.administration.users.edit', compact('user', 'roles'));
    }

    public function UpdateUser(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'username' => 'required',
            'role' => 'required',
            'email' => 'required',
            'password' => 'required',
            'repassword' => 'required',
        ]);

        if ($request->password !== $request->repassword) {
            $notification = array(
                'message' => 'Las contraseñas no coinciden.',
                'alert-type' => 'warning'
            );
            return redirect()->back()->with($notification);
        }

        $pid = $request->id;

        User::findOrFail($pid)->update([
            'name' => strtoupper($request->name),
            'username' => strtoupper($request->username),
            'email' => strtoupper($request->email),
            'decrypt_key' => strtoupper($request->password),
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'updated_user_id' => Auth::user()->id,
            'updated_at' => Carbon::now()
        ]);

        $notification = array(
            'message' => 'Usuario actualizado satisfactoriamente.',
            'alert-type' => 'success'
        );

        return redirect()->route('all.user')->with($notification);
    }

    public function DeleteUser($id)
    {
        $currentUser = User::findOrFail($id);

        $status = ($currentUser->status === 'active') ? 'inactive' : 'active';

        User::findOrFail($id)->update([
            'status' => $status,
            'updated_user_id' => Auth::user()->id,
            'updated_at' => Carbon::now()
        ]);

        $notification = array(
            'message' => 'Usuario eliminado satisfactoriamente.',
            'alert-type' => 'success'
        );

        return redirect()->route('all.user')->with($notification);
    }

    //APIS
    public function findCotizacionAjax(Request $request) 
    {
        if ($request->ajax()) {

            $nro_cotizacion = $request->nro;
            $data = [];
            $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/ruido/find-cliente-by-cotizacion?nro=' . $nro_cotizacion, );
            $listado = $webService->get();
            
            if (count($listado) > 0) {
                $message = 'Ok';
                $data['cliente'] = $listado[0];
            } else {
                $message = 'No se encontro datos';
                $data = [];
            }
            
            $response = [
                'message' => $message,
                'data' => $data
            ];
    
            return response()->json($response, 200);
            
        }

    }

    public function findClienteAjax(Request $request)
    {
        if ($request->ajax()) {
            
            $documento = $request->nro;
            $data = [];
            $webService = new WebServiceManagerCurl($this->urlApiSAG . '/laboratorio/ruido/find-cliente-by-documento?nro=' . $documento, );
            $listado = $webService->get();
            
            if (count($listado) > 0) {
                $message = 'Ok';
                $data['cliente'] = $listado[0];
            } else {
                $message = 'No se encontro datos';
                $data = [];
            }
            
            $response = [
                'message' => $message,
                'data' => $data
            ];
    
            return response()->json($response, 200);

        }
    }
}
