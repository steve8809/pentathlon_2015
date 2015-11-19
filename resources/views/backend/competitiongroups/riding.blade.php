@extends('master')
@section('title', 'Lovaglás eredmények')

@section('content')
    <div class="container col-md-8 col-md-offset-2">
        <div class="well well bs-component">

            @include('errors.list')

            @include('statuses.alert_success')

            {!! Form::model($competitiongroup, array('class' => 'form-horizontal')) !!}

            <fieldset>
                <legend>Lovaglás pontszámok a következő versenyen: {!! $competitiongroup->competition->name.' - '.$competitiongroup->name !!}</legend>

                @if (empty($competitor_in))
                    <p> Nincs egy nevezett versenyző sem.</p>
                @else
                    @foreach($competitor_in as $key => $comp)
                        <div class="form-group @if ($errors->has('riding.'.$key)) has-error @endif @if ($errors->has('riding_horse.'.$key)) has-error @endif">
                            {!! Form::label('riding['.$key.']', $comp, array('class' => 'col-lg-2 control-label')) !!}
                            <div class="col-lg-3">
                                {!! Form::text('riding['.$key.']', $competitor_riding[$key] , array('class' => 'form-control')) !!}
                            </div>
                            {!! Form::label('riding_horse['.$key.']', 'Ló neve', array('class' => 'col-lg-2 control-label')) !!}
                            <div class="col-lg-3">
                                {!! Form::select('riding_horse['.$key.']', array('' => 'Válassz lovat') + $horses, $competitor_horse[$key] , array('class' => 'form-control')) !!}
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
    </div>

@endsection