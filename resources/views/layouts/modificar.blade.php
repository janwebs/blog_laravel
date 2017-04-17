
@if(session()->has('success_msj'))
  <div class="alert alert-success" role="alert">{{ session('success_msj') }}</div>
@endif
@if(session()->has('error_msj'))
  <div class="alert alert-danger" role="alert">{{ session('error_msj') }}</div>
@endif

@if(isset($noticia))
  <form class="form-horizontal" role="form" method="POST" action="{{ route('noticias.update', $noticia->id) }}" enctype="multipart/form-data">

    <input name="_method" type="hidden" value="PUT">
    <input class="hide" type="text" name="urlImg_anterior" value="{{ $noticia->urlImg }}">

    <!-- TOKEN DE LA APLICACION -->
    {{ csrf_field() }}

    <div class="form-group">
      <label for="titulo" class="col-sm-2 control-label">Titulo</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="titulo" name="titulo" value="{{ $noticia->titulo }}">
        <!-- Manejo de error -->
        @if($errors->has('titulo'))
          <span style="color:red;">{{ $errors->first('titulo') }}</span>
        @endif
      </div>
    </div>
    
    <div class="form-group">
      <label for="descripcion" class="col-sm-2 control-label">Descripcion</label>
      <div class="col-sm-10">
        <textarea type="text" class="form-control" id="descripcion" name="descripcion">{{ $noticia->descripcion }}</textarea>
        @if($errors->has('descripcion'))
          <span style="color:red;">{{ $errors->first('descripcion') }}</span>
        @endif
      </div>
    </div>

    <div class="form-group">
      <label for="urlImg" class="col-sm-2 control-label">url de imagen</label>
      <div class="col-sm-10">
        <input type="file" class="form-control" id="urlImg" name="urlImg">
      </div>
    </div>
    
    <div class="form-group">
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-warning">Modificar</button>
      </div>
    </div>
  </form>
@endif