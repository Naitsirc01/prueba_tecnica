<?php

namespace App\Http\Controllers;

use Redirect;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Acceso_usuario;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request){
        $request->user()->authorizeRoles(['admin']);
        $usuarios=User::paginate(10);
        return view('usuarios',compact('usuarios'));
    }

    public function permisos(Request $request){
        $request->user()->authorizeRoles(['admin']);
        $user=User::find($request->user_id);
        $permisos=$user->acceso_usuario()->get();
        return view('permisos',compact('user','permisos'));
    }

    public function update_permisos(Request $request){
        $request->user()->authorizeRoles(['admin']);
        $permisos=[];
        if($request->permisos){
            $permisos=$request->permisos;
        }
        // Creacion de accesos
        foreach($permisos as $id_acceso){
            $acceso_usuario=Acceso_usuario::where('user_id',$request->user_id)->where('acceso_id',$id_acceso)->get()->first();
            if(!$acceso_usuario){
                $acceso_usuario=new Acceso_usuario();
                $acceso_usuario->user_id=$request->user_id;
                $acceso_usuario->acceso_id=$id_acceso;
                $acceso_usuario->save();
            }
        }
        // Eliminacion de accesos
        for($i=1;$i<=3;$i++){
            if(!in_array($i,$permisos)){
                $acceso_usuario=Acceso_usuario::where('user_id',$request->user_id)->where('acceso_id',$i)->get()->first();
                if($acceso_usuario){
                    $acceso_usuario->delete();
                }
            }
        }
        return redirect::to('/usuarios')->with('success','Los permisos del usuario: '.$request->user_name.' fueron actulizados de forma correcta.');
        
    }
    
}
