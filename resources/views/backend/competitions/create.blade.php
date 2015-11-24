@extends('master')
@section('title', 'Új verseny felvétele')

@section('content')
    <div class="container col-md-8 col-md-offset-2">
        <div class="well well bs-component">

            {!! Form::open(array('url' => 'admin/competitions', 'class' => 'form-horizontal')) !!}

            @include('errors.list')

            @include('statuses.alert_success')

            @include('backend.competitions.form', ['submitButtonText' => 'Verseny felvétele', 'legend' => 'Új verseny felvétele'])

            {!! Form::close() !!}

        </div>
        <a href="/admin/competitions" class="btn btn-info">Vissza a versenyekhez</a>
    </div>
@endsection