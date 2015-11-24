@extends('master')
@section('title', 'Új csoport felvétele')

@section('content')
    <div class="container col-md-8 col-md-offset-2">
        <div class="well well bs-component">

            {!! Form::open(array('url' => 'admin/competitiongroups', 'class' => 'form-horizontal')) !!}

            @include('errors.list')

            @include('statuses.alert_success')

            @include('backend.competitiongroups.form', ['submitButtonText' => 'Csoport felvétele', 'legend' => 'Új csoport felvétele'])

            {!! Form::close() !!}

        </div>
        <a href="/admin/competitiongroups" class="btn btn-info">Vissza a csoportokhoz</a>
    </div>
@endsection