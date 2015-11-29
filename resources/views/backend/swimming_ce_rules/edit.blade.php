@extends('master')
@section('title', 'Szabályok szerkesztése')

@section('content')
    <div class="container col-md-8 col-md-offset-2">
        <div class="well well bs-component">

            {!! Form::model($swimming_ce_rule, array('class' => 'form-horizontal')) !!}

            @include('errors.list')

            @include('statuses.alert_success')

            @include('backend.swimming_ce_rules.form', ['submitButtonText' => 'Szabályok szerkesztése', 'legend' => 'Szabályok szerkesztése - '.$swimming_ce_rule->age_group.' '.$swimming_ce_rule->type])

            {!! Form::close() !!}

        </div>
        <a href="/admin/swimming_ce_rules" class="btn btn-info">Vissza a szabályokhoz</a>
        <div class="placeholder"></div>
    </div>
@endsection