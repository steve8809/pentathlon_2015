@extends('master_main')
@section('title', 'Összes verseny')
@section('content')

    <div class="container col-md-10 col-md-offset-1">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2> Összes verseny </h2>
            </div>
            @if ($competitions->isEmpty())
                <p> Nincs egy verseny sem.</p>
            @else
                <div class="table-responsive">
                    <table class="table table-text-center table-hover">
                        <thead>
                        <tr>
                            <th>Név</th>
                            <th>Ország</th>
                            <th>Város</th>
                            <th>Rendező</th>
                            <th>Dátum</th>
                            <th>Kategória</th>
                            <th colspan="1">Műveletek</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($competitions as $competition)
                            <tr>
                                <td>{!! $competition->name !!}</td>
                                <td>{!! $competition->country->name !!} </td>
                                <td>{!! $competition->town !!}</td>
                                <td>{!! $competition->host !!}</td>
                                <td>{!! $competition->date !!} </td>
                                <td>{!! $competition->category !!}</td>
                                <td class="btn-edit">
                                    <a href="{!! action('PageController@competition_show', $competition->id) !!}" class="btn btn-primary"><span class='glyphicon glyphicon-edit'></span> Eredmények megtekintése</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <?php echo $competitions->render(); ?>
                </div>
            @endif

        </div>
        <div class="placeholder"></div>
    </div>

@endsection