@extends('master')
@section('title', 'Csoport szerkesztése')

@section('content')
    <div class="container col-md-8 col-md-offset-2">
        <div class="well well bs-component">

            {!! Form::model($competitiongroup, array('class' => 'form-horizontal')) !!}

            @include('errors.list')

            @include('statuses.alert_success')

            @include('backend.competitiongroups.form', ['submitButtonText' => 'Csoport szerkesztése', 'legend' => 'Csoport szerkesztése'])

            {!! Form::close() !!}
        </div>
    </div>
@endsection