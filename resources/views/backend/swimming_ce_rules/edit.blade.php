@extends('master')
@section('title', 'Szabályok szerkesztése')

@section('content')
    <div class="container col-md-8 col-md-offset-2">
        <div class="well well bs-component">

            {!! Form::model($swimming_ce_rule, array('class' => 'form-horizontal')) !!}

            @include('errors.list')

            @include('statuses.alert_success')

            @include('backend.swimming_ce_rules.form', ['submitButtonText' => 'Szabályok szerkesztése', 'legend' => 'Szabályok szerkesztése'])

            {!! Form::close() !!}

        </div>
    </div>
@endsection