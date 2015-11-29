@extends('master')
@section('title', 'Verseny szerkesztése')

@section('content')
    <div class="container col-md-8 col-md-offset-2">
        <div class="well well bs-component">

            {!! Form::model($competition, array('class' => 'form-horizontal')) !!}

            @include('errors.list')

            @include('statuses.alert_success')

            @include('backend.competitions.form', ['submitButtonText' => 'Verseny szerkesztése', 'legend' => 'Verseny szerkesztése'])

            {!! Form::close() !!}
        </div>
        <a href="/admin/competitions" class="btn btn-info">Vissza a versenyekhez</a>
        <div class="placeholder"></div>
    </div>
@endsection