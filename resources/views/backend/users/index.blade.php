@extends('master')
@section('title', 'Összes felhasználó')
@section('content')

    <div class="container col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2> Összes felhasználó </h2>
            </div>

            @include('statuses.alert_success')
            
            @if ($users->isEmpty())
                <p> Nincs egy felhasználó sem.</p>
            @else
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Név</th>
                            <th>E-mail</th>
                            <th>Csatlakozott</th>
                            <th colspan="2">Műveletek</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{!! $user->name !!}</td>
                                <td>{!! $user->email !!}</td>
                                <td>{!! $user->created_at !!}</td>
                                <td class="btn-edit">
                                    <a href="{!! action('Admin\UsersController@edit', $user->id) !!}" class="btn btn-warning"><span class='glyphicon glyphicon-edit'></span> Szerkesztés</a>
                                </td>
                                @if ($user->name != 'Admin')
                                <td>
                                    {!! Form::open(['method' => 'DELETE', 'route'=>['admin.users.destroy', $user->id]]) !!}
                                    <button class='btn btn-danger' type='button' data-toggle="modal" data-target="#confirmDelete"
                                            data-title="Felhasználó törlése" data-message='Biztos, hogy törlöd a következő felhasználót: {!! $user->name !!}?'>
                                        <span class='glyphicon glyphicon-trash'></span> Törlés
                                    </button>
                                    {!! Form::close() !!}
                                </td>
                                @endif
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <?php echo $users->render(); ?>
                </div>
            @endif

            @include('modals.confirm_delete')

        </div>
        <a href="/admin" class="btn btn-info">Vissza az admin főoldalára</a>
    </div>

@endsection