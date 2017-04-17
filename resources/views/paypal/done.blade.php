@extends('layouts.app')
@section('title')La compra ha sido un exito! @stop
@section('message')
	<div class="modal2 active" id="modal1">
		<div class="content">
			<div class="row">
				<div class="ten columns centered text-left">
					<h1>La compra ha sido un exito</h1>
						<a href="javascript: history.go(-1)" class="btn btn-primary">
							Regresar
						</a>
				</div>
			</div>
		</div>
	</div>
@stop