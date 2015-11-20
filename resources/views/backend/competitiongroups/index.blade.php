@extends('master')
@section('title', 'Összes csoport')
@section('content')

    <div class="container col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">
                <a href="{!! action('Admin\CompetitiongroupsController@create') !!}" class="btn btn-info pull-right new-item">Új csoport felvétele</a>
                <h2> Összes csoport </h2>

            </div>

            @include('statuses.alert_success')

            @if ($competitiongroups->isEmpty())
                <p> Nincs egy csoport sem.</p>
            @else
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Név</th>
                            <th>Verseny</th>
                            <th>Dátum</th>
                            <th>Típus</th>
                            <th>Korosztály</th>
                            <th>Nem</th>
                            <th colspan="3">Műveletek</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($competitiongroups as $competitiongroup)
                            <tr>
                                <td>{!! $competitiongroup->name !!}</td>
                                <td>{!! $competitiongroup->competition->name !!} </td>
                                <td>{!! $competitiongroup->date !!}</td>
                                <td>{!! $competitiongroup->type !!}</td>
                                <td>{!! $competitiongroup->age_group !!}</td>
                                <td>{!! $competitiongroup->sex !!}</td>
                                <td class="btn-edit">
                                    <a href="{!! action('Admin\CompetitiongroupsController@edit', $competitiongroup->id) !!}" class="btn btn-warning"><span class='glyphicon glyphicon-edit'></span> Szerkesztés</a>
                                </td>
                                <td class="btn-edit">
                                    {!! Form::open(['method' => 'DELETE', 'route'=>['admin.competitiongroups.destroy', $competitiongroup->id]]) !!}
                                    <button class='btn btn-danger' type='button' data-toggle="modal" data-target="#confirmDelete"
                                            data-title="Csoport törlése" data-message='Biztos, hogy törlöd a következő csoportot: {!! $competitiongroup->competition->name.': '.$competitiongroup->name !!}?'>
                                        <span class='glyphicon glyphicon-trash'></span> Törlés
                                    </button>
                                    {!! Form::close() !!}
                                </td>
                                <td class="btn-edit">
                                    <a href="{!! action('Admin\CompetitiongroupsController@entry', $competitiongroup->id) !!}" class="btn btn-info"><span class='glyphicon glyphicon-edit'></span> Nevezés</a>
                                </td>
                                <td class="btn-edit">
                                    <div class="btn-group pull-right">
                                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                            <i class="glyphicon glyphicon-fire"></i> Eredmények <span class="caret"></span>
                                        </button>

                                        <ul class="dropdown-menu" role="menu">
                                            <li>
                                                <a href="{!! action('Admin\CompetitiongroupsController@swimming', $competitiongroup->id) !!}">Úszás</a>
                                                <a href="{!! action('Admin\CompetitiongroupsController@riding', $competitiongroup->id) !!}">Lovaglás</a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <?php echo $competitiongroups->render(); ?>
                </div>
            @endif

            @include('modals.confirm_delete')

        </div>
    </div>

@endsection