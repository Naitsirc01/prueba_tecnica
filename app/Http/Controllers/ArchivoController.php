<?php

namespace App\Http\Controllers;

use Redirect;
use App\Models\Archivo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArchivoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request){
        $request->user()->authorizeRoles(['user', 'admin']);
        return view('subir_archivo');
    }

    public function subir_archivo(Request $request){
        $request->user()->authorizeRoles(['user', 'admin']);
    }

    public function historial_archivo(Request $request){
        $request->user()->authorizeRoles(['user', 'admin']);
        return view('historial_archivo');
    }

    public function upload_file(Request $request){
        $user=Auth::user();
        if(!is_null($request->file)){
            try{
                $filename = $request->file->getClientOriginalName() .'_'. time() .'.'. $request->file->getClientOriginalExtension();
                $path=asset('storage/'.$user->name.'/');
                $request->file->move($path,$filename);
                $archivo=new Archivo();
                $archivo->nombre=$request->file->getClientOriginalName();
                $archivo->peso=$request->file('file')->getSize();
                $archivo->save();
                return redirect::to('/archivo')->with('success','El archivo '.$request->file->getClientOriginalName().' fue subido de forma correcta.');
            }catch(Exception $e){
                return redirect::to('/archivo')->with('fail','Ha ocurrido un error al subir el archivo intentelo denuevo.');
            }
        }else{
            return redirect::to('/archivo')->with('fail','Debe cargar un archivo antes en enviarlo.');    
        }
    }
}
