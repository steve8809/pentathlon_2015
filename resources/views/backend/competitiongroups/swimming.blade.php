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
                <legend>Úszó eredmények a következő versenyen: {!! $competitiongroup->competition->name.' - '.$competitiongroup->name !!}</legend>

                @if (empty($competitor_in))
                    <p> Nincs egy nevezett versenyző sem.</p>
                @else
                    @foreach($competitor_in as $key => $comp)
                    <div class="form-group @if ($errors->has('swimming.'.$key)) has-error @endif">
                        {!! Form::label('swimming['.$key.']', $comp, array('class' => 'col-lg-2 control-label')) !!}
                        <div class="col-lg-10">
                            {!! Form::text('swimming['.$key.']', $competitor_swimming[$key] , array('class' => 'form-control masked_input')) !!}
                        </div>
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
    </div>

@endsection