@extends('master')
@section('title', 'Minden ló')
@section('content')

    <div class="container col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2> Minden ló </h2>
            </div>
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            @if ($horses->isEmpty())
                <p> Nincs egy ló sem.</p>
            @else
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <td>Ló neve</td>
                            <td>Neme</td>
                            <td>Szín</td>
                            <td>Kor</td>
                            <td>Műveletek</td>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($horses as $horse)
                            <tr>
                                <td>
                                    <a href="{!! action('Admin\HorsesController@edit', $horse->id) !!}">{!! $horse->name !!}</a>
                                </td>
                                <td>{!! $horse->sex !!} </td>
                                <td>{!! $horse->colour !!}</td>
                                <td>{!! $horse->age !!}</td>
                                <td class="btn-edit">
                                    <a href="{!! action('Admin\HorsesController@edit', $horse->id) !!}" class="btn btn-warning">Szerkesztés</a>
                                </td>
                                <td>
                                    {!! Form::open(['method' => 'DELETE', 'onsubmit' => 'return ConfirmDelete()', 'route'=>['admin.horses.destroy', $horse->id]]) !!}
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