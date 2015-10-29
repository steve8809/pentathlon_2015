@extends('master')
@section('title', 'Minden felhasználó')
@section('content')

    <div class="container col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2> Minden felhasználó </h2>
            </div>
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            @if ($users->isEmpty())
                <p> Nincs egy felhasználó se.</p>
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
                                <td>
                                    <a href="{!! action('Admin\UsersController@edit', $user->id) !!}">{!! $user->name !!} </a>
                                </td>
                                <td>{!! $user->email !!}</td>
                                <td>{!! $user->created_at !!}</td>
                                <td class="btn-edit">
                                    <a href="{!! action('Admin\UsersController@edit', $user->id) !!}" class="btn btn-warning">Szerkesztés</a>
                                </td>
                                <td>
                                    {!! Form::open(['method' => 'DELETE', 'onsubmit' => 'return ConfirmDelete()', 'route'=>['admin.users.destroy', $user->id]]) !!}
                                    {!! Form::submit('Törlés', ['class' => 'btn btn-danger']) !!}
                                    {!! Form::close() !!}
                                </td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>

@endsection