@extends('master')
@section('title', 'Csapatok nevezése')

@section('content')
    <div class="container col-md-8 col-md-offset-2">
        <div class="well well bs-component">

            @include('errors.list')

            @include('statuses.alert_success')

            {!! Form::model($competitiongroup, array('class' => 'form-horizontal')) !!}

            <fieldset>
                <legend>Nevezés a következő versenyre: {!! $competitiongroup->competition->name.' - '.$competitiongroup->name !!}</legend>

                <div class="form-group @if ($errors->has('name')) has-error @endif">
                    {!! Form::label('team_name', 'Név', array('class' => 'col-lg-2 control-label')) !!}
                    <div class="col-lg-10">
                        {!! Form::text('team_name', null , array('class' => 'form-control', 'placeholder' => 'Csapat neve')) !!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('competitors', 'Versenyző', array('class' => 'col-lg-2 control-label')) !!}
                    <div class="col-lg-10">
                        {!! Form::select('competitors[]', $competitors, null, array('id' => 'competitors', 'class' => 'form-control', 'multiple')) !!}
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-lg-10 col-lg-offset-2">
                        {!! Form::submit('Csapat nevezése', array('class' => 'btn btn-primary')) !!}
                    </div>
                </div>

            </fieldset>

            {!! Form::close() !!}
        </div>
    </div>

    <div class="container col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2> Nevezett csapatok - Összesen: {!! $team_count !!}</h2>
            </div>
            @if (empty($team_in))
                <p> Nincs egy nevezett csapat sem.</p>
                <a href="/admin/competitiongroups" class="btn btn-info">Vissza a csoportokhoz</a>
            @else
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Csapat neve</th>
                            <th>Versenyző 1</th>
                            <th>Versenyző 2</th>
                            <th>Versenyző 3</th>
                            <th>Műveletek</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($team_list as $team)
                            <tr>
                                <td>{!! $team->name !!}</td>
                                <td>{!! $team->competitor1->full_name !!}</td>
                                <td>{!! $team->competitor2->full_name !!}</td>
                                <td>{!! $team->competitor3->full_name !!}</td>
                                <td>
                                    {!! Form::open(['method' => 'DELETE', 'route'=>['admin.destroy_team_entry', $team->id]]) !!}
                                    <button class='btn btn-danger' type='button' data-toggle="modal" data-target="#confirmDelete"
                                            data-title="Csapat nevezésének törlése" data-message='Biztos, hogy törlöd a következő csapat nevezését: {!! $team->name !!}?'>
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
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($competitor_list as $competitor)
                            <tr>
                                <td>{!! $competitor->competitor->full_name !!}</td>
                                <td>{!! $competitor->competitor->birthday !!}</td>
                                <td>{!! $competitor->competitor->country->name !!}</td>
                                <td>{!! $competitor->competitor->club->name !!}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>

    <div class="container col-md-8 col-md-offset-2">
        <div class="well well bs-component">

            @include('errors.list')

            {!! Form::open(['method' => 'POST', 'class' => 'form-horizontal', 'route'=>['admin.entry_close', $competitiongroup->id]]) !!}

            <fieldset>
                <legend>Nevezés lezárása: {!! $competitiongroup->competition->name.' - '.$competitiongroup->name !!}</legend>

                <div class="form-group">
                    {!! Form::label('bouts_per_match', 'Tusok száma meccsenként', array('class' => 'col-lg-2 control-label')) !!}
                    <div class="col-lg-6">
                        {!! Form::number('bouts_per_match', 0, array('min' => 0, 'class' => 'form-control')) !!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('fencing_bouts', 'Összes tus száma', array('class' => 'col-lg-2 control-label')) !!}
                    <div class="col-lg-6">
                        {!! Form::number('fencing_bouts', 0, array('min' => 0, 'class' => 'form-control')) !!}
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-lg-10 col-lg-offset-2">
                        {!! Form::submit('Nevezés lezárása', array('class' => 'btn btn-primary')) !!}
                    </div>
                </div>

            </fieldset>

            {!! Form::close() !!}
        </div>
        <a href="/admin/competitiongroups/{!! $competitiongroup->id !!}/entry" class="btn btn-info">Vissza az egyéni nevezéshez</a>
        <div class = "placeholder"></div>
    </div>


@endsection