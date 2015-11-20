@extends('master')
@section('title', 'Összes jogosultság')
@section('content')

    <div class="container col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">
                <a href="{!! action('Admin\RolesController@create') !!}" class="btn btn-info pull-right new-item">Új jogosultság felvétele</a>
                <h2> Összes jogosultság </h2>
            </div>
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            @if ($roles->isEmpty())
                <p> Nincs jogosultság.</p>
            @else
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Név</th>
                            <th>Megjelenített név</th>
                            <th>Leírás</th>
                            <th colspan="2">Műveletek</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($roles as $role)
                            <tr>
                                <td>{!! $role->name !!}</td>
                                <td>{!! $role->display_name !!}</td>
                                <td>{!! $role->description !!}</td>
                                <td class="btn-edit">
                                    <a href="{!! action('Admin\RolesController@edit', $role->id) !!}" class="btn btn-warning"><span class='glyphicon glyphicon-edit'></span> Szerkesztés</a>
                                </td>
                                <td>
                                    {!! Form::open(['method' => 'DELETE', 'route'=>['admin.roles.destroy', $role->id]]) !!}
                                    @if ($role->name != 'admin' && $role->name != 'felhasználó')
                                        <button class='btn btn-danger' type='button' data-toggle="modal" data-target="#confirmDelete"
                                            data-title="Jogosultság törlése" data-message='Biztos, hogy törlöd a következő jogosultságot: {!! $role->name !!}?'>
                                         <span class='glyphicon glyphicon-trash'></span> Törlés
                                        </button>
                                    @endif
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <?php echo $roles->render(); ?>
                </div>
            @endif

            @include('modals.confirm_delete')

        </div>
    </div>

@endsection