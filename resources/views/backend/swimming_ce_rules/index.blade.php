@extends('master')
@section('title', 'Összes úszás, kombinált szabály')
@section('content')

    <div class="container col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2> Összes úszás, kombinált szabály </h2>
            </div>
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            @if ($swimming_ce_rules->isEmpty())
                <p> Nincs szabály.</p>
            @else
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>Típus</th>
                            <th>Korcsoport</th>
                            <th>Úszóidő</th>
                            <th>Úszás hossza</th>
                            <th>Kombinált idő</th>
                            <th>Kombinált hossza</th>
                            <th>Műveletek</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($swimming_ce_rules as $swimming_ce_rule)
                            <tr>
                                <td>{!! $swimming_ce_rule->type !!}</td>
                                <td>{!! $swimming_ce_rule->age_group !!}</td>
                                <td>{!! $swimming_ce_rule->swimming_time !!}</td>
                                <td>{!! $swimming_ce_rule->swimming_dist !!}</td>
                                <td>{!! $swimming_ce_rule->ce_time !!}</td>
                                <td>{!! $swimming_ce_rule->ce_dist !!}</td>
                                <td>
                                    <a href="{!! action('Admin\SwimmingCeRulesController@edit', $swimming_ce_rule->id) !!}" class="btn btn-sm btn-warning"><span class='glyphicon glyphicon-edit'></span> Szerkesztés</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <?php echo $swimming_ce_rules->render(); ?>
                </div>
            @endif

            @include('modals.confirm_delete')

        </div>
        <a href="/admin" class="btn btn-info">Vissza az admin főoldalára</a>
        <div class="placeholder"></div>
    </div>

@endsection