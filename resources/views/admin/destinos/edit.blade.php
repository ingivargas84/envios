@extends('admin.layoutadmin')

@section('header')
    <section class="content-header">
        <h1>
          Destinos
          <small>Editar Destino</small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="{{route('dashboard')}}"><i class="fa fa-tachometer-alt"></i> Inicio</a></li>
          <li><a href="{{route('destinos.index')}}"><i class="fa fa-list"></i> Destinos</a></li>
          <li class="active">Actualizar</li>
        </ol>
    </section>
@stop

@section('content')
    <form method="POST" id="DestinoEditForm"  action="{{route('destinos.update', $destino)}}">
            {{csrf_field()}}
            {{ method_field('PUT') }}
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-sm-8 {{$errors->has('destino')? 'has-error' : ''}}">
                                <label for="destino">Destino:</label>
                                <input type="text" class="form-control" placeholder="Destino" name="destino" value="{{old('destino', $destino->destino)}}">
                                {!!$errors->first('destino', '<label class="error">:message</label>')!!}
                            </div>
                        </div>
                        <br>
                        <div class="text-right m-t-15">
                            <a class='btn btn-primary form-button' href="{{ route('destinos.index') }}">Regresar</a>
                            <button class="btn btn-success form-button" id="ButtonDestinoUpdate">Guardar</button>
                        </div>
                    </div>
                </div>
            </div>
    </form>
    <div class="loader loader-bar"></div>

@stop


@push('styles')

@endpush


@push('scripts')
<script src="{{asset('js/destinos/edit.js')}}"></script>
@endpush