<?php

namespace App\Http\Controllers;

use File;
use Redirect;
use App\Models\Archivo;
use Illuminate\Support\Facades\DB;
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
        $archivos=Archivo::paginate(10);
        return view('historial_archivo',compact('archivos'));
    }

    /**
     * Guarda un archivo en el servidor dentro de una carpeta con el nombre del usuario
     */
    public function upload_file(Request $request){
        $request->user()->authorizeRoles(['user', 'admin']);

        $user=Auth::user();
        if(!is_null($request->file)){
            try{
                $peso=$request->file('file')->getSize();
                $filename = $request->file->getClientOriginalName() .'_'. time() .'.'. $request->file->getClientOriginalExtension();
                $path=public_path('/files/'.$user->name.'_'.$user->id);
                $request->file->move($path,$filename);
                $archivo=new Archivo();
                $archivo->nombre=$request->file->getClientOriginalName();
                $archivo->nombre_archivo=$filename;
                $archivo->peso=$peso;
                $archivo->user_id=$user->id;
                $archivo->save();
                return redirect::to('/archivo')->with('success','El archivo '.$request->file->getClientOriginalName().' fue subido de forma correcta.');
            }catch(Exception $e){
                return redirect::to('/archivo')->with('fail','Ha ocurrido un error al subir el archivo intentelo denuevo.');
            }
        }else{
            return redirect::to('/archivo')->with('fail','Debe cargar un archivo antes en enviarlo.');    
        }
    }

    /**
     * Elimina el registro del archivo de la base como el archivo en el servidor
     */
    public function destroy_file(Request $request){
        $request->user()->authorizeRoles(['user', 'admin']);

        $user=Auth::user();
        $archivo=Archivo::find($request->id);
        $path=public_path('/files/'.$user->name.'_'.$user->id.'/'.$archivo->nombre_archivo);
        File::delete($path);
        $archivo->delete();
        return redirect::to('/historial')->with('success','El archivo '.$archivo->nombre.' fue eliminado de forma correcta.');
    }
}
