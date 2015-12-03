@extends('master')
@section('title', 'Lovaglás eredmények')

@section('content')
    <div class="container col-lg-8 col-lg-offset-2">
        <div class="well well bs-component">

            @if ($errors->has())
                <p class="alert alert-danger">{!! $errors->first() !!}</p>
            @endif

            @include('statuses.alert_success')

            {!! Form::model($competitiongroup, array('class' => 'form-horizontal')) !!}

            <fieldset>
                <legend>Lovaglás pontszámok a következő versenyen: {!! $competitiongroup->competition->name.' - '.$competitiongroup->name !!}</legend>
                <ul class="list-group">
                    <li class="list-group-item">A lovaglás pontszáma 0 és 300 közötti érték, időeredmény túllépés nélküli pontszámot kell megadni.</li>
                    <li class="list-group-item">Lovas szintidő a versenyen: {!! $competitiongroup->riding_time_limit !!}. Időeredmény megadása a következő formátumban: mm:ss.uu, pl.: 01:20.34</li>
                </ul>
                @if (empty($competitor_in))
                    <p> Nincs egy nevezett versenyző sem.</p>
                @else
                    <div class="form-group">
                        {!! Form::label('riding_point', 'Pontszám', array('class' => 'col-xs-offset-2 col-xs-2')) !!}
                        {!! Form::label('riding_time', 'Idő', array('class' => 'col-xs-2')) !!}
                        {!! Form::label('horse_id', 'Ló neve', array('class' => 'col-xs-3')) !!}
                        {!! Form::label('riding_points', 'Végső pontszám', array('class' => 'col-xs-2')) !!}
                    </div>
                    @foreach($competitor_in as $key => $comp)
                        <div class="form-group">
                            @if ($competitor_riding_point[$key] == "")
                                {!! Form::label('riding_point['.$key.']', $comp, array('class' => 'col-xs-2 control-label label-orange')) !!}
                            @else
                                {!! Form::label('riding_point['.$key.']', $comp, array('class' => 'col-xs-2 control-label')) !!}
                            @endif

                            <div class="col-xs-2 @if ($errors->has('riding_point.'.$key)) has-error @endif">
                                {!! Form::text('riding_point['.$key.']', $competitor_riding_point[$key] , array('min' => 0, 'max' => 300, 'class' => 'form-control')) !!}
                            </div>
                            <div class="col-xs-2 @if ($errors->has('riding_time.'.$key)) has-error @endif">
                                {!! Form::text('riding_time['.$key.']', $competitor_riding_time[$key] , array('class' => 'form-control masked_input')) !!}
                            </div>
                            <div class="col-xs-3 @if ($errors->has('horse_id.'.$key)) has-error @endif">
                                {!! Form::select('horse_id['.$key.']', array('' => 'Válassz lovat') + $horses, $competitor_horse[$key] ? $competitor_horse[$key] : null , array('class' => 'form-control')) !!}
                            </div>
                            <div class="col-xs-2">
                                {!! Form::text('riding_points['.$key.']', $competitor_riding_points[$key] , array('class' => 'form-control', 'disabled')) !!}
                            </div>
                        </div>
                    @endforeach

                    <div class="form-group">
                        <div class="col-lg-10 col-lg-offset-2">
                            {!! Form::submit('Lovaglás pontszámok mentése', array('class' => 'btn btn-primary')) !!}
                        </div>
                    </div>
                @endif
            </fieldset>

            {!! Form::close() !!}
        </div>
        <a href="/admin/competitiongroups" class="btn btn-info">Vissza a csoportokhoz</a>
        <div class="placeholder"></div>
    </div>

@endsection