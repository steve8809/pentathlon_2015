@extends('master')
@section('title', 'Ló szerkesztése')

@section('content')
    <div class="container col-md-8 col-md-offset-2">
        <div class="well well bs-component">

            {!! Form::model($horse, array('class' => 'form-horizontal')) !!}

                @include('errors.list')

                @include('statuses.alert_success')

                @include('backend.horses.form', ['submitButtonText' => 'Ló szerkesztése', 'legend' => 'Ló szerkesztése'])

            {!! Form::close() !!}
        </div>
        <a href="/admin/horses" class="btn btn-info">Vissza a lovakhoz</a>
    </div>
@endsection