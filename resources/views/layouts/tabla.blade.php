<table class="table table-hover">
	@if(isset($noticias))
		<thead>
			<th>Titulo</th>
			<th>Descripcion</th>
			<th>Imagen</th>
			<th>Opciones</th>
		</thead>
		<tbody>
			@foreach ($noticias as $noticia)
				<tr>
					<td>{{ $noticia->titulo }}</td>
					<td>{{ $noticia->descripcion }}</td>
					<td>
						<img src="imgNoticias/{{ $noticia->urlImg }}" class="img-responsive" alt="responsive image" style="max-width: 100px;">
					</td>
					<td>
						<a href="noticias/{{ $noticia->id }}/edit" class="btn btn-warning btn-xs">Editar</a>
						<form action="{{ route('noticias.destroy',$noticia->id) }}" method="POST">
							<input name="_method" type="hidden" value="DELETE">
							{{ csrf_field() }}
							<input type="submit" class="btn btn-danger btn-xs" value="Eliminar"></input>
						</form>
					</td>
				</tr>
			@endforeach		
		</tbody>
	@endif
</table>