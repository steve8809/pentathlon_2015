@extends('master')
@section('title', 'Összes ló')
@section('content')

    <div class="container col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">
                <a href="{!! action('Admin\HorsesController@create') !!}" class="btn btn-info pull-right new-item">Új ló felvétele</a>
                <h2> Összes ló </h2>
            </div>
            @include('statuses.alert_success')
            @if ($horses->isEmpty())
                <p> Nincs egy ló sem.</p>
            @else
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>Ló neve</th>
                            <th>Nem</th>
                            <th>Szín</th>
                            <th>Kor</th>
                            <th colspan="2">Műveletek</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($horses as $horse)
                            <tr>
                                <td>{!! $horse->name !!}</td>
                                <td>{!! $horse->sex !!} </td>
                                <td>{!! $horse->colour !!}</td>
                                <td>{!! $horse->age !!}</td>
                                <td class="btn-edit">
                                    <a href="{!! action('Admin\HorsesController@edit', $horse->id) !!}" class="btn btn-sm btn-warning"><span class='glyphicon glyphicon-edit'></span> Szerkesztés</a>
                                </td>
                                <td>
                                    {!! Form::open(['method' => 'DELETE', 'route'=>['admin.horses.destroy', $horse->id]]) !!}
                                    <button class='btn btn-sm btn-danger @if ($horse->in_competition == 1) disabled @endif' type='button' data-toggle="modal"
                                            data-target="@if ($horse->in_competition == 0) #confirmDelete @endif"
                                            data-title="Ló törlése" data-message='Biztos, hogy törlöd a következő lovat: {!! $horse->name !!}?'>
                                        <span class='glyphicon glyphicon-trash'></span> Törlés
                                    </button>
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <?php echo $horses->render(); ?>
                </div>
            @endif
            @include('modals.confirm_delete')
        </div>
        <a href="/admin" class="btn btn-info">Vissza az admin főoldalára</a>
        <div class="placeholder"></div>
    </div>

@endsection