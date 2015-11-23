@extends('master')
@section('title', 'Vívás eredmények')

@section('content')
    <div class="container col-md-8 col-md-offset-2">
        <div class="well well bs-component">

            @include('statuses.alert_success')

            {!! Form::open(['method' => 'get', 'class' => 'form-horizontal']) !!}

            <fieldset>
                <legend>Vívás eredmények a következő versenyen: {!! $competitiongroup->competition->name.' - '.$competitiongroup->name !!}</legend>

                @if (empty($competitor_in))
                    <p> Nincs egy nevezett versenyző sem.</p>
                @else
                    <div class="form-group">
                        {!! Form::label('valami', 'Versenyző kiválasztása', array('class' => 'col-lg-3 control-label')) !!}
                        <div class="col-lg-3">
                            {!! Form::select('competitor', $competitor_in, $act_competitor , array('class' => 'form-control')) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-lg-10 col-lg-offset-3">
                            {!! Form::submit('Listázás', array('class' => 'btn btn-primary')) !!}
                        </div>
                    </div>
                @endif
            </fieldset>

            {!! Form::close() !!}
        </div>
    </div>



    <div class="container col-md-8 col-md-offset-2">
        <div class="well well bs-component">

            {!! Form::model($competitiongroup, array('class' => 'form-horizontal')) !!}
                <fieldset>
                    {!! Form::hidden('act_comp', $act_competitor) !!}
                    @foreach($competitor_in_opp as $key => $comp)
                        <div class="form-group @if ($errors->has('fencing.'.$key)) has-error @endif">
                            {!! Form::label('fencing['.$act_competitor.']', $competitor_in[$act_competitor].' - '.$comp, array('class' => 'col-lg-4 control-label')) !!}
                            <div class="col-lg-2">
                                {!! Form::number('fencing['.$act_competitor.'_'.$key.']', $fencing_results[$act_competitor.'_'.$key] , array('min' => 0, 'class' => 'form-control')) !!}
                            </div>
                            <div class="col-lg-2">
                                {!! Form::number('fencing['.$key.'_'.$act_competitor.']', $fencing_results[$key.'_'.$act_competitor] , array('min' => 0, 'class' => 'form-control')) !!}
                            </div>
                        </div>

                    @endforeach

                    <div class="form-group">
                        <div class="col-lg-10 col-lg-offset-4">
                            {!! Form::submit('Eredmények mentése', array('class' => 'btn btn-primary')) !!}
                        </div>
                    </div>

                </fieldset>

            {!! Form::close() !!}
        </div>
        <a href="/admin/competitiongroups" class="btn btn-info">Vissza a csoportokhoz</a>
    </div>

@endsection