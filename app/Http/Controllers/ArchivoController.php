<?php

namespace App\Http\Controllers;

use File;
use Redirect;
use Response;
use ZipArchive;
use App\Models\Archivo;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ArchivoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Retorna la vista para subir archivo, si el usuario es administrador y se envia
     * la id de un usuario, se envian los datos del usuario
     */
    public function index(Request $request){
        $request->user()->authorizeRoles(['user', 'admin']);

        $user_id=0;
        $user_name='';
        if(Auth::user()->hasRole('admin') and $request->user_id){
            $user=User::find($request->user_id);
            $user_id=$user->id;
            $user_name=$user->name;
        }
        return view('subir_archivo',compact('user_id','user_name'));
    }
    
    /**
     * Retorna la vista del historial de archivos para el usuario
     */
    public function historial_archivo(Request $request){
        $request->user()->authorizeRoles(['user', 'admin']);

        $user=Auth::user();
        $usuarios=false;
        $archivos=Archivo::where('user_id',$user->id)->paginate(10);
        return view('historial_archivo',compact('archivos','usuarios'));
    }

    /**
     * Carga una lista con todos los archivos solitados por el administrador.
     * Dependiendo de la id de usuario enviada se filtran los archivos.
     */
    public function historial_archivo_admin(Request $request){
        $request->user()->authorizeRoles(['admin']);

        $archivos=DB::table('archivos');
        if($request->user_id){
            $archivos=$archivos->where('user_id',$request->user_id);
            $archivos=$archivos->paginate(10)->appends('user_id',request('user_id'));
        }else{
            $archivos=$archivos->paginate(10);
        }
        $usuarios=User::all();
        return view('historial_archivo',compact('archivos','usuarios'));
    }

    /**
     * Guarda un archivo en el servidor dentro de una carpeta con el nombre del usuario.
     */
    public function upload_file(Request $request){
        $request->user()->authorizeRoles(['user', 'admin']);
        
        $user=Auth::user();
        if(!is_null($request->file)){
            try{
                $validator = Validator::make($request->all(), [
                    'file' => 'max:10240',
                ]);
                if($validator->fails()){
                    return redirect::to('/archivo')->with('fail','Debe cargar un que no exceda los 10 MB.');    
                }
                $peso=$request->file('file')->getSize();          
                     
                $filename = time() .'.'. $request->file->getClientOriginalExtension();
                $path=public_path('/files/'.$user->name.'_'.$user->id);
                $request->file->move($path,$filename);
                $archivo=new Archivo();
                $archivo->nombre=$request->file->getClientOriginalName();
                $archivo->nombre_archivo=$filename;
                $archivo->peso=$peso;
                if(Auth::user()->hasRole('admin') and $request->user_id){
                    $archivo->user_id=$request->user_id;
                }else{
                    $archivo->user_id=$user->id;
                }
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
     * Elimina el registro del archivo de la base como el archivo en el servidor.
     */
    public function destroy_file(Request $request){
        $request->user()->authorizeRoles(['user', 'admin']);

        $user=Auth::user();
        $archivo=Archivo::find($request->id);
        if($archivo->user_id==$user->id or Auth::user()->hasRole('admin')){
            $path=public_path('/files/'.$user->name.'_'.$user->id.'/'.$archivo->nombre_archivo);
            File::delete($path);
            $archivo->delete();
            if($request->admin){
                return redirect::to('/historial_archivo_admin')->with('success','El archivo '.$archivo->nombre.' fue eliminado de forma correcta.');
            }else{
                return redirect::to('/historial')->with('success','El archivo '.$archivo->nombre.' fue eliminado de forma correcta.');
            }
        }
        return redirect::to('/historial')->with('fail','Usted no posee autorización para realizar esta acción');
        
    }

    /**
     * Envia un enlace de descargar del archivo solicitado por id.
     */
    public function download_file(Request $request){
        $request->user()->authorizeRoles(['user', 'admin']);

        $user=Auth::user();
        $archivo=Archivo::find($request->id);
        $file= public_path('/files/'.$user->name.'_'.$user->id.'/'.$archivo->nombre_archivo);
        return Response::download($file, $archivo->nombre);
    }

    /**
     * Genera un archivo zip con todos los archivos que tiene almacenado el usuario en su carpeta.
     */
    public function download_file_all(Request $request){
        $request->user()->authorizeRoles(['user', 'admin']);

        $user=Auth::user();
        $zip=new ZipArchive;
        $fileName = 'Archivos.zip';
        if(count($user->archivos()->get())!=0){
            if ($zip->open(public_path($fileName), ZipArchive::CREATE) === TRUE) {
                $files = File::files(public_path('/files/'.$user->name.'_'.$user->id.'/'));
                foreach ($files as $value) {
                    $relativeName = basename($value);
                    $zip->addFile($value, $relativeName);
                }
                $zip->close();
            }
            return response()->download(public_path($fileName));;
        }
        return redirect::to('/historial')->with('fail','No existen archivos para descargar');
    }
}
