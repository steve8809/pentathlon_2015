@extends('master')
@section('title', 'Jogosultság szerkesztése')

@section('content')
    <div class="container col-md-8 col-md-offset-2">
        <div class="well well bs-component">

            {!! Form::model($role, array('class' => 'form-horizontal')) !!}

            @include('errors.list')

            @include('statuses.alert_success')

            @include('backend.roles.form', ['submitButtonText' => 'Jogosultság szerkesztése', 'legend' => 'Jogosultság szerkesztése'])

            {!! Form::close() !!}

        </div>
    </div>
@endsection