@extends('master')
@section('title', 'Klub szerkesztése')

@section('content')
    <div class="container col-md-8 col-md-offset-2">
        <div class="well well bs-component">

            {!! Form::model($club, array('class' => 'form-horizontal')) !!}

            @include('errors.list')

            @include('statuses.alert_success')

            @include('backend.clubs.form', ['submitButtonText' => 'Klub szerkesztése', 'legend' => 'Klub szerkesztése'])

            {!! Form::close() !!}
        </div>
    </div>
@endsection