@extends('master')
@section('title', 'Speciális esetek')

@section('content')
    <div class="container col-md-8 col-md-offset-2">
        <div class="well well bs-component">

            @include('statuses.alert_success')

            {!! Form::open(['method' => 'get', 'class' => 'form-horizontal']) !!}

            <fieldset>
                <legend>Speciális esetek a következő versenyen: {!! $competitiongroup->competition->name.' - '.$competitiongroup->name !!}</legend>

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
                <legend>{!! $competitor_in[$act_competitor] !!}</legend>
                {!! Form::hidden('act_comp', $act_competitor) !!}

                <div class="form-group">
                    {!! Form::label('fencing['.$act_competitor.']', 'Vívás', array('class' => 'col-lg-2 control-label')) !!}
                    <div class="col-lg-6">
                        {!! Form::select('fencing', $specials, $fencing[$act_competitor], array('class' => 'form-control', ($fencing[$act_competitor] != 0) ? 'disabled' : '')) !!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('swimming['.$act_competitor.']', 'Úszás', array('class' => 'col-lg-2 control-label')) !!}
                    <div class="col-lg-6">
                        {!! Form::select('swimming', $specials, $swimming[$act_competitor], array('class' => 'form-control', ($swimming[$act_competitor] != 0) ? 'disabled' : '')) !!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('riding['.$act_competitor.']', 'Lovaglás', array('class' => 'col-lg-2 control-label')) !!}
                    <div class="col-lg-6">
                        {!! Form::select('riding', $specials, $riding[$act_competitor], array('class' => 'form-control', ($riding[$act_competitor] != 0) ? 'disabled' : '')) !!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('ce['.$act_competitor.']', 'Kombinált', array('class' => 'col-lg-2 control-label')) !!}
                    <div class="col-lg-6">
                        {!! Form::select('ce', $specials, $ce[$act_competitor], array('class' => 'form-control', ($ce[$act_competitor] != 0) ? 'disabled' : '')) !!}
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-lg-10 col-lg-offset-2">
                        <button class='btn btn-warning' type='button' data-toggle="modal"
                                data-target="#confirmSpecial"
                                data-title="Módosítások megerősítése" data-message='Biztos, hogy módosítani szeretnéd a következő versenyzőt: {!! $competitor_in[$act_competitor] !!}?
                                Ez a lépés nem visszavonható!'>Módosítások mentése
                        </button>
                    </div>
                </div>

            </fieldset>
            {!! Form::close() !!}
        </div>
        @include('modals.confirm_special')
        <a href="/admin/competitiongroups" class="btn btn-info">Vissza a csoportokhoz</a>
    </div>

@endsection