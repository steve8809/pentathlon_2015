@extends('master')
@section('title', 'Úszó eredmények')

@section('content')
    <div class="container col-md-8 col-md-offset-2">
        <div class="well well bs-component">


            @if ($errors->has())
                <p class="alert alert-danger">{!! $errors->first() !!}</p>
            @endif

            @include('statuses.alert_success')

            {!! Form::model($competitiongroup, array('class' => 'form-horizontal')) !!}

            <fieldset>
                <legend>Úszó eredmények a következő versenyen: {!! $competitiongroup->competition->name.' - '.$competitiongroup->name.' - Táv: '.$swimming_dist->swimming_dist !!}</legend>
                <ul class="list-group">
                    <li class="list-group-item">Időeredmény megadása a következő formátumban: mm:ss.uu, pl.: 02:01.45 </li>
                </ul>
                @if (empty($competitor_in))
                    <p> Nincs egy nevezett versenyző sem.</p>
                @else
                    <div class="form-group">
                        {!! Form::label('swimming', 'Idő', array('class' => 'col-xs-offset-2 col-xs-4')) !!}
                        {!! Form::label('penalty_swimming', 'Büntetőpont', array('class' => 'col-xs-2')) !!}
                        {!! Form::label('swimming_points', 'Pontszám', array('class' => 'col-xs-2')) !!}
                    </div>
                    @foreach($competitor_in as $key => $comp)
                    <div class="form-group">
                        @if ($competitor_swimming[$key] == "")
                            {!! Form::label('swimming['.$key.']', $comp, array('class' => 'col-xs-2 control-label label-orange')) !!}
                        @else
                            {!! Form::label('swimming['.$key.']', $comp, array('class' => 'col-xs-2 control-label')) !!}
                        @endif
                        <div class="col-xs-4 @if ($errors->has('swimming.'.$key)) has-error @endif">
                            {!! Form::text('swimming['.$key.']', $competitor_swimming[$key] , array('class' => 'form-control masked_input')) !!}
                        </div>
                        <div class="col-xs-2 @if ($errors->has('penalty_swimming.'.$key)) has-error @endif">
                            {!! Form::text('penalty_swimming['.$key.']', $competitor_penalty_swimming[$key] , array('class' => 'form-control')) !!}
                        </div>
                        <div class="col-xs-2">
                            {!! Form::text('swimming_points['.$key.']', $competitor_swimming_points[$key] , array('class' => 'form-control', 'disabled')) !!}
                        </div>
                        {!! Form::label('points', 'pont', array('class' => 'col-1 control-label')) !!}
                    </div>


                    @endforeach

                    <div class="form-group">
                        <div class="col-lg-10 col-lg-offset-2">
                            {!! Form::submit('Úszóidők mentése', array('class' => 'btn btn-primary')) !!}
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