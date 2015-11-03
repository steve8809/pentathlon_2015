@extends('master')
@section('title', 'Új jogosultság készítése')

@section('content')
    <div class="container col-md-8 col-md-offset-2">
        <div class="well well bs-component">

            {!! Form::open(array('url' => 'admin/roles', 'class' => 'form-horizontal')) !!}

                @include('errors.list')

                @include('statuses.alert_success')

                @include('backend.roles.form', ['submitButtonText' => 'Jogosultság mentése', 'legend' => 'Új jogosultság felvétele'])

            {!! Form::close() !!}

        </div>
    </div>
@endsection