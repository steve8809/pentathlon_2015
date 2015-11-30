@extends('master')
@section('title', 'Versenyző szerkesztése')

@section('content')
    <div class="container col-md-8 col-md-offset-2">
        <div class="well well bs-component">

            {!! Form::model($competitor, array('class' => 'form-horizontal')) !!}

            @include('errors.list')

            @include('statuses.alert_success')

            @include('backend.competitors.form', ['submitButtonText' => 'Versenyző szerkesztése', 'legend' => 'Versenyző szerkesztése'])

            {!! Form::close() !!}

        </div>
        <a href="/admin/competitors" class="btn btn-info">Vissza a versenyzőkhöz</a>
        <div class="placeholder"></div>
    </div>
@endsection