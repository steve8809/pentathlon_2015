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
                <ul class="list-group">
                    <li class="list-group-item">Időeredmény megadása a következő formátumban: mm:ss.uu, pl.: 13:11.67. Idő megadása kötelező, ha van büntetőpont. </li>
                    <li class="list-group-item">Büntetőpontok mezőben egy 0-nál nagyobb számot lehet megadni. Megadása nem kötelező. </li>
                </ul>
                @if (empty($competitor_in))
                    <p> Nincs egy nevezett versenyző sem.</p>
                @else
                    <div class="form-group">
                        {!! Form::label('ce', 'Idő', array('class' => 'col-xs-offset-2 col-xs-4')) !!}
                        {!! Form::label('penalty_ce', 'Büntetőpont', array('class' => 'col-xs-2')) !!}
                        {!! Form::label('ce_points', 'Pontszám', array('class' => 'col-xs-2')) !!}
                    </div>
                    @foreach($competitor_in as $key => $comp)
                        <div class="form-group">
                            @if ($competitor_ce[$key] == "")
                                {!! Form::label('ce['.$key.']', $comp, array('class' => 'col-xs-2 control-label label-orange')) !!}
                            @else
                                {!! Form::label('ce['.$key.']', $comp, array('class' => 'col-xs-2 control-label')) !!}
                            @endif
                            <div class="col-xs-4 @if ($errors->has('ce.'.$key)) has-error @endif">
                                {!! Form::text('ce['.$key.']', $competitor_ce[$key] , array('class' => 'form-control masked_input')) !!}
                            </div>
                            <div class="col-xs-2 @if ($errors->has('penalty_ce.'.$key)) has-error @endif">
                                {!! Form::text('penalty_ce['.$key.']', $competitor_penalty_ce[$key] , array('class' => 'form-control')) !!}
                            </div>
                            <div class="col-xs-2">
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
        <div class = "placeholder"></div>
    </div>

@endsection