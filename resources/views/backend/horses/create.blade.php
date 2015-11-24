@extends('master')
@section('title', 'Új ló felvétele')

@section('content')
    <div class="container col-md-8 col-md-offset-2">
        <div class="well well bs-component">

            {!! Form::open(array('url' => 'admin/horses', 'class' => 'form-horizontal')) !!}

                @include('errors.list')

                @include('statuses.alert_success')

                @include('backend.horses.form', ['submitButtonText' => 'Ló felvétele', 'legend' => 'Új ló felvétele'])

            {!! Form::close() !!}

        </div>
        <a href="/admin/horses" class="btn btn-info">Vissza a lovakhoz</a>
    </div>
@endsection