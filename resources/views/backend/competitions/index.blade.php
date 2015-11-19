@extends('master')
@section('title', 'Összes verseny')
@section('content')

    <div class="container col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">
                <a href="{!! action('Admin\CompetitionsController@create') !!}" class="btn btn-info pull-right new-item">Új verseny felvétele</a>
                <h2> Összes verseny </h2>

            </div>

            @include('statuses.alert_success')

            @if ($competitions->isEmpty())
                <p> Nincs egy verseny sem.</p>
            @else
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Név</th>
                            <th>Ország</th>
                            <th>Város</th>
                            <th>Rendező</th>
                            <th>Dátum</th>
                            <th>Kategória</th>
                            <th colspan="2">Műveletek</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($competitions as $competition)
                            <tr>
                                <td>{!! $competition->name !!}</td>
                                <td>{!! $competition->country->name !!} </td>
                                <td>{!! $competition->town !!}</td>
                                <td>{!! $competition->host !!}</td>
                                <td>{!! $competition->start_date !!} - {!! $competition->end_date !!}</td>
                                <td>{!! $competition->category !!}</td>
                                <td class="btn-edit">
                                    <a href="{!! action('Admin\CompetitionsController@edit', $competition->id) !!}" class="btn btn-warning"><span class='glyphicon glyphicon-edit'></span> Szerkesztés</a>
                                </td>
                                <td>
                                    {!! Form::open(['method' => 'DELETE', 'route'=>['admin.competitions.destroy', $competition->id]]) !!}
                                    <button class='btn btn-danger' type='button' data-toggle="modal" data-target="#confirmDelete"
                                            data-title="Verseny törlése" data-message='Biztos, hogy törlöd a következő versenyt: {!! $competition->name !!}?'>
                                        <span class='glyphicon glyphicon-trash'></span> Törlés
                                    </button>
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <?php echo $competitions->render(); ?>
                </div>
            @endif

            @include('modals.confirm_delete')

        </div>
    </div>

@endsection