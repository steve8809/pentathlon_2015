@extends('master')
@section('title', 'Vívás pontozás')
@section('content')

    <div class="container col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2> Vívás pontozás </h2>
            </div>
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            @if ($fencing_rules->isEmpty())
                <p> Nincs szabály.</p>
            @else
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Tusok száma</th>
                            <th>250 ponthoz szükséges tusok száma</th>
                            <th>Győzelem pontszáma</th>
                            <th>Műveletek</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($fencing_rules as $fencing_rule)
                            <tr>
                                <td>{!! $fencing_rule->bouts !!}</td>
                                <td>{!! $fencing_rule->bouts_250 !!}</td>
                                <td>{!! $fencing_rule->victory_points !!}</td>
                                <td>
                                    <a href="{!! action('Admin\FencingRulesController@edit', $fencing_rule->id) !!}" class="btn btn-warning"><span class='glyphicon glyphicon-edit'></span> Szerkesztés</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <?php echo $fencing_rules->render(); ?>
                </div>
            @endif

            @include('modals.confirm_delete')

        </div>
        <a href="/admin" class="btn btn-info">Vissza az admin főoldalára</a>
    </div>

@endsection