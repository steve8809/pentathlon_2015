@extends('master')
@section('title', 'Nevezés versenyre')

@section('content')
    <div class="container col-md-8 col-md-offset-2">
        <div class="well well bs-component">

            @include('errors.list')

            @include('statuses.alert_success')

            {!! Form::model($competitiongroup, array('class' => 'form-horizontal')) !!}

            <fieldset>
                <legend>Nevezés a következő versenyre: {!! $competitiongroup->competition->name.' - '.$competitiongroup->name !!}</legend>

                <div class="form-group">
                    {!! Form::label('competitors', 'Versenyző', array('class' => 'col-lg-2 control-label')) !!}
                    <div class="col-lg-10">
                        {!! Form::select('competitors[]', $competitors, null, array('id' => 'competitors', 'class' => 'form-control', 'multiple')) !!}
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-lg-10 col-lg-offset-2">
                        {!! Form::submit('Nevezés versenyre', array('class' => 'btn btn-primary')) !!}
                    </div>
                </div>

            </fieldset>

            {!! Form::close() !!}
        </div>
    </div>
    <div class="container col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2> Nevezett versenyzők - Összesen: {!! $comp_count !!}</h2>
            </div>
            @if (empty($competitor_in))
                <p> Nincs egy nevezett versenyző sem.</p>
                <a href="/admin/competitiongroups" class="btn btn-info">Vissza a csoportokhoz</a>
            @else
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Versenyző neve</th>
                            <th>Születési idő</th>
                            <th>Nemzet</th>
                            <th>Klub</th>
                            <th>Műveletek</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($competitor_list as $competitor)
                            <tr>
                                <td>{!! $competitor->competitor->full_name !!}</td>
                                <td>{!! $competitor->competitor->birthday !!}</td>
                                <td>{!! $competitor->competitor->country->name !!}</td>
                                <td>{!! $competitor->competitor->club->name !!}</td>
                                <td>
                                    {!! Form::open(['method' => 'DELETE', 'route'=>['admin.destroy_entry', $competitor->competitor->id]]) !!}
                                    <button class='btn btn-danger @if (in_array($competitor->competitor->id, $in_team)) disabled @endif' type='button' data-toggle="modal"
                                            data-target="@if (!in_array($competitor->competitor->id, $in_team)) #confirmDelete" @endif
                                            data-title="Versenyző nevezésének törlése" data-message='Biztos, hogy törlöd a következő versenyző nevezését: {!! $competitor->competitor->full_name !!}?'>
                                        <span class='glyphicon glyphicon-trash'></span> Nevezés törlése
                                    </button>
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
        @include('modals.confirm_delete')
    </div>
    @if (!empty($competitor_in))
        <div class="container col-md-8 col-md-offset-2">
            <div class="well well bs-component">
                <legend>Csapatok nevezése a verenyre, nevezés lezárása</legend>
                <a href="{!! action('Admin\CompetitiongroupsController@teams_entry', $competitiongroup->id) !!}" button class="btn btn-warning">Csapatok nevezése, lezárás</a>
            </div>
            <a href="/admin/competitiongroups" class="btn btn-info">Vissza a csoportokhoz</a>
            <div class="placeholder"></div>
        </div>

    @endif

@endsection