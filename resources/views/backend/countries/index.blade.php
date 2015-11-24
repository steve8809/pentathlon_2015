@extends('master')
@section('title', 'Összes ország')
@section('content')

    <div class="container col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2> Összes ország </h2>

            </div>

            @if ($countries->isEmpty())
                <p> Nincs egy ország sem.</p>
            @else
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Zászló</th>
                            <th>Ország</th>
                            <th>Rövidítés</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($countries as $country)
                            <tr>
                                <td><img src="/images/{!! $country->flag !!}"></td>
                                <td>{!! $country->name !!}</td>
                                <td>{!! $country->iso_alpha3 !!} </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <?php echo $countries->render(); ?>
                </div>
            @endif

        </div>
        <a href="/admin" class="btn btn-info">Vissza az admin főoldalára</a>
    </div>

@endsection