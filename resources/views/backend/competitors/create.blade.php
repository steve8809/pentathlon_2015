@extends('master')
@section('title', 'Új versenyző felvétele')

@section('content')
    <div class="container col-md-8 col-md-offset-2">
        <div class="well well bs-component">

            {!! Form::open(array('url' => 'admin/competitors', 'class' => 'form-horizontal')) !!}

            @include('errors.list')

            @include('statuses.alert_success')

            @include('backend.competitors.form', ['submitButtonText' => 'Versenyző felvétele', 'legend' => 'Új versenyző felvétele'])

            {!! Form::close() !!}

        </div>
        <a href="/admin/competitors" class="btn btn-info">Vissza a versenyzőkhöz</a>
    </div>
@endsection