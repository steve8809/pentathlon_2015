@extends('master')
@section('title', 'Összes klub')
@section('content')

    <div class="container col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">
                <a href="{!! action('Admin\ClubsController@create') !!}" class="btn btn-info pull-right new-item">Új klub felvétele</a>
                <h2> Összes klub </h2>
            </div>
            @include('statuses.alert_success')
            @if ($clubs->isEmpty())
                <p> Nincs egy klub sem.</p>
            @else
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>Klub neve</th>
                            <th>Ország</th>
                            <th>Város</th>
                            <th colspan="2" class="text-left">Műveletek</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($clubs as $club)
                            <tr>
                                <td>{!! $club->name !!}</td>
                                <td>{!! $club->country !!} </td>
                                <td>{!! $club->town !!}</td>
                                <td class="text_left btn-edit">
                                    <a href="{!! action('Admin\ClubsController@edit', $club->id) !!}" class="btn btn-sm btn-warning"><span class='glyphicon glyphicon-edit'></span> Szerkesztés</a>
                                </td>
                                <td class="text_left">
                                    {!! Form::open(['method' => 'DELETE', 'route'=>['admin.clubs.destroy', $club->id]]) !!}
                                    <button class='btn btn-sm btn-danger @if ($club->in_competition == 1) disabled @endif' type='button' data-toggle="modal"
                                            data-target="@if ($club->in_competition == 0) #confirmDelete @endif"
                                            data-title="Klub törlése" data-message='Biztos, hogy törlöd a következő klubot: {!! $club->name !!}?'>
                                        <span class='glyphicon glyphicon-trash'></span> Törlés
                                    </button>
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <?php echo $clubs->render(); ?>
                </div>
            @endif
            @include('modals.confirm_delete')
        </div>
        <a href="/admin" class="btn btn-info">Vissza az admin főoldalára</a>
        <div class="placeholder"></div>
    </div>

@endsection