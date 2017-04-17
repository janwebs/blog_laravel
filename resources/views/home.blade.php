@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Noticia</div>

                <div class="panel-body">
                    @if(isset($edit))
                        @include('layouts.modificar')
                    @else
                        @include('layouts.formulario')
                        @include('layouts.tabla')
                    @endif
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
