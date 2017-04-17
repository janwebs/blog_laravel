<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Noticia;

use Storage;

class NoticiasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

     public function mostrar()
    {
        $noticias = Noticia::all();
        return view('welcome')->with(['noticias'=>$noticias]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        //dd($request->titulo);
        //validacion
        $this->validate($request, [
            'titulo'=>'required',
            'descripcion'=>'required',
        ]);

        //guardando el registro nuevo
        $noticia = new Noticia();
        $noticia->titulo = $request->titulo;
        $noticia->descripcion = $request->descripcion;
        // guardando la imagen
        $img = $request->file('urlImg');
        $file_route = time()."_".$img->getClientOriginalName();
        Storage::disk('imgNoticias')->put($file_route, file_get_contents($img->getRealPath()));
        $noticia->urlImg = $file_route;

        if($noticia->save()){
            return back()->with('success_msj', 'Noticia guardada exitosamente');    
        }else{
            return back()->with('error_msj', 'Error al guardar la noticia');
        }
        
        //dd('noticia guardada');     
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        //dd('edit');
        $noticia = Noticia::find($id);
        return view('home')->with(['edit'=>true,'noticia'=>$noticia]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        // dd('update');

        //validacion
        $this->validate($request, [
            'titulo'=>'required',
            'descripcion'=>'required',
        ]);

        //modificando el registro, primero lo buscmos
        $noticia = Noticia::find($id);
        $noticia->titulo = $request->titulo;
        $noticia->descripcion = $request->descripcion;
        
        $img = $request->file('urlImg');
        $file_route = time()."_".$img->getClientOriginalName();
        
        Storage::disk('imgNoticias')->put($file_route, file_get_contents($img->getRealPath()));
        // se elimina la imagen anterior del disco
        Storage::disk('imgNoticias')->delete($request->urlImg_anterior);

        $noticia->urlImg = $file_route;

        if($noticia->save()){
            //return back()->with('success_msj', 'Noticia editada exitosamente');    
            return redirect('home');
        }else{
            //return back()->with('error_msj', 'Error al editar la noticia');
            return redirect('home');
        }
        
        //dd('noticia guardada');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        // dd('eliminar');
        Noticia::destroy($id);
        return back();
    }
}
