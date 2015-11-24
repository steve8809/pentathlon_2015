@extends('master')
@section('title', 'Összes jogosultság')
@section('content')

    <div class="container col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">
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
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($roles as $role)
                            <tr>
                                <td>{!! $role->name !!}</td>
                                <td>{!! $role->display_name !!}</td>
                                <td>{!! $role->description !!}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <?php echo $roles->render(); ?>
                </div>
            @endif

        </div>
        <a href="/admin" class="btn btn-info">Vissza az admin főoldalára</a>
    </div>

@endsection