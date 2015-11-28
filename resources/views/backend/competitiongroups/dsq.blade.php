@extends('master')
@section('title', 'Speciális esetek')

@section('content')
    <div class="container col-md-8 col-md-offset-2">
        <div class="well well bs-component">

            @include('statuses.alert_success')

            {!! Form::open(['method' => 'get', 'class' => 'form-horizontal']) !!}

            <fieldset>
                <legend>Kizárás a következő versenyen: {!! $competitiongroup->competition->name.' - '.$competitiongroup->name !!}</legend>

                <div class="form-group">
                    {!! Form::label('competitor', 'Versenyző kiválasztása', array('class' => 'col-lg-3 control-label')) !!}
                    <div class="col-lg-3">
                        {!! Form::select('competitor', $competitor_in, $act_competitor , array('class' => 'form-control')) !!}
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-lg-10 col-lg-offset-3">
                        {!! Form::submit('Kiválaszt', array('class' => 'btn btn-primary')) !!}
                    </div>
                </div>
            </fieldset>

            {!! Form::close() !!}
        </div>
    </div>

    <div class="container col-md-8 col-md-offset-2">
        <div class="well well bs-component">

            {!! Form::model($competitiongroup, array('class' => 'form-horizontal')) !!}

            <fieldset>
                <legend>Kizárás - {!! $competitor_in[$act_competitor] !!}</legend>
                {!! Form::hidden('act_comp', $act_competitor) !!}

                <div class="form-group">
                    <div class="col-lg-10">
                        <button class='btn btn-danger' type='button' data-toggle="modal"
                                data-target="#confirmDsq"
                                data-title="Versenyző kizárása" data-message='Biztos, hogy kizárod a következő versenyzőt: {!! $competitor_in[$act_competitor] !!}?
                                Ez a lépés nem visszavonható!'>Versenyző kizárása</button>
                    </div>
                </div>


            </fieldset>

            {!! Form::close() !!}
        </div>
        @include('modals.confirm_dsq')
        <a href="/admin/competitiongroups" class="btn btn-info">Vissza a csoportokhoz</a>
        <div class="placeholder"></div>
    </div>

@endsection