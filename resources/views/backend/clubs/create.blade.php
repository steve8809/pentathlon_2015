@extends('master')
@section('title', 'Új klub felvétele')

@section('content')
    <div class="container col-md-8 col-md-offset-2">
        <div class="well well bs-component">

            {!! Form::open(array('url' => 'admin/clubs', 'class' => 'form-horizontal')) !!}

            @include('errors.list')

            @include('statuses.alert_success')

            @include('backend.clubs.form', ['submitButtonText' => 'Klub felvétele', 'legend' => 'Új klub felvétele'])

            {!! Form::close() !!}

        </div>
    </div>
@endsection