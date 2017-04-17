@extends('layouts.app')
@section('title')La compra se ha cancelado! @stop
@section('message')
	<div class="modal2 active" id="modal1">
		<div class="content">
			<div class="row">
				<div class="ten columns centered text-left">
					<h1>La compra se ha cancelado</h1>
					<a href="javascript: history.go(-1)" class="btn btn-danger">
						Regresar
					</a>
				</div>
			</div>
		</div>
	</div>
@stop