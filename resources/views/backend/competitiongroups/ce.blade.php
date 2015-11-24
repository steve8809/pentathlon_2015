@extends('master')
@section('title', 'Kombinált eredmények')

@section('content')
    <div class="container col-md-8 col-md-offset-2">
        <div class="well well bs-component">

            @if ($errors->has())
                <p class="alert alert-danger">{!! $errors->first() !!}</p>
            @endif

            @include('statuses.alert_success')

            {!! Form::model($competitiongroup, array('class' => 'form-horizontal')) !!}

            <fieldset>
                <legend>Kombinált eredmények a következő versenyen: {!! $competitiongroup->competition->name.' - '.$competitiongroup->name.' - Táv: '.$ce_dist->ce_dist!!}</legend>

                @if (empty($competitor_in))
                    <p> Nincs egy nevezett versenyző sem.</p>
                @else
                    @foreach($competitor_in as $key => $comp)
                        <div class="form-group @if ($errors->has('ce.'.$key)) has-error @endif">
                            {!! Form::label('ce['.$key.']', $comp, array('class' => 'col-lg-2 control-label')) !!}
                            <div class="col-lg-6">
                                {!! Form::text('ce['.$key.']', $competitor_ce[$key] , array('class' => 'form-control masked_input')) !!}
                            </div>
                            <div class="col-lg-2">
                                {!! Form::text('ce_points['.$key.']', $competitor_ce_points[$key] , array('class' => 'form-control', 'disabled')) !!}
                            </div>
                            {!! Form::label('points', 'pont', array('class' => 'col-1 control-label')) !!}
                        </div>
                    @endforeach

                    <div class="form-group">
                        <div class="col-lg-10 col-lg-offset-2">
                            {!! Form::submit('Kombinált idők mentése', array('class' => 'btn btn-primary')) !!}
                        </div>
                    </div>
                @endif
            </fieldset>

            {!! Form::close() !!}
        </div>
        <a href="/admin/competitiongroups" class="btn btn-info">Vissza a csoportokhoz</a>
    </div>

@endsection