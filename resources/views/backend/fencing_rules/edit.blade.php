@extends('master')
@section('title', 'Vívás pontozás szerkesztése')

@section('content')
    <div class="container col-md-8 col-md-offset-2">
        <div class="well well bs-component">

            {!! Form::model($fencing_rule, array('class' => 'form-horizontal')) !!}

            @include('errors.list')

            @include('statuses.alert_success')

            @include('backend.fencing_rules.form', ['submitButtonText' => 'Pontozás szerkesztése', 'legend' => 'Pontozás szerkesztése - Tusok száma: '.$fencing_rule->bouts])

            {!! Form::close() !!}

        </div>
    </div>
@endsection