@extends('master')
@section('title', 'Összes versenyző')
@section('content')

    <div class="container col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">
                <a href="{!! action('Admin\CompetitorsController@create') !!}" class="btn btn-info pull-right new-item">Új versenyző felvétele</a>
                <h2> Összes versenyző </h2>

            </div>

            @include('statuses.alert_success')

            @if ($competitors->isEmpty())
                <p> Nincs egy versenyző sem.</p>
            @else
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Vezetéknév</th>
                            <th>Keresztnév</th>
                            <th>Nem</th>
                            <th>Születési idő</th>
                            <th>Nemzet</th>
                            <th>Klub</th>
                            <th colspan="2">Műveletek</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($competitors as $competitor)
                            <tr>
                                <td>{!! $competitor->last_name !!}</td>
                                <td>{!! $competitor->first_name !!} </td>
                                <td>{!! $competitor->sex !!}</td>
                                <td>{!! $competitor->birthday !!}</td>
                                <td>{!! $competitor->country->name !!}</td>
                                <td>{!! $competitor->club->name !!}</td>
                                <td class="btn-edit">
                                    <a href="{!! action('Admin\CompetitorsController@edit', $competitor->id) !!}" class="btn btn-warning"><span class='glyphicon glyphicon-edit'></span> Szerkesztés</a>
                                </td>
                                <td>
                                    {!! Form::open(['method' => 'DELETE', 'route'=>['admin.competitors.destroy', $competitor->id]]) !!}
                                    <button class='btn btn-danger @if ($competitor->in_competition == 1) disabled @endif' type='button' data-toggle="modal"
                                            data-target="@if ($competitor->in_competition == 0) #confirmDelete @endif"
                                            data-title="Versenyző törlése" data-message='Biztos, hogy törlöd a következő versenyzőt: {!! $competitor->last_name.' '.$competitor->first_name !!}?'>
                                        <span class='glyphicon glyphicon-trash'></span> Törlés
                                    </button>
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <?php echo $competitors->render(); ?>
                </div>
            @endif

            @include('modals.confirm_delete')

        </div>
        <a href="/admin" class="btn btn-info">Vissza az admin főoldalára</a>
    </div>

@endsection