@extends('master_main')
@section('title', 'Eredmények')
@section('content')

    <div class="container col-md-10 col-md-offset-1">
        <div class="panel panel-default">
            <div class="panel-heading">
                @if ($competitiongroups->isEmpty())
                    <h2> {!! $competition->name !!}</h2>
                    <p> Még nincsen csoport felvéve a versenyhez</p>
                @else
                    <h2> {!! $competition->name.' - '. $competitiongroup->name.' - '.$competitiongroup->date !!} </h2>
                    <ul class="nav nav-pills">
                        @if (Route::is('competition.show') || Route::is('competition.select'))
                            @foreach($competitiongroups as $compgroup)
                                <li class="active"><a href="{!! action('PageController@competition_select', array($competition->id, $compgroup->id)) !!}">{!! $compgroup->name !!}</a></li>
                            @endforeach
                        @else
                            @foreach($competitiongroups as $compgroup)
                                <li class="active"><a href="{!! action('PageController@select', $compgroup->id) !!}">{!! $compgroup->name !!}</a></li>
                            @endforeach
                        @endif
                    </ul>
                @endif
            </div>
            @if ($competitiongroups->isEmpty())
            @else
                @if ($results->isEmpty())
                    <p> Nincs a versenyhez eredmény.</p>
                @else
                    <div class="table-responsive">
                        <table id="results" class="table table-bordered table-text-center">
                            <thead>
                            <tr>
                                <th colspan="5"></th>
                                <th colspan="4">Vívás</th>
                                <th colspan="3">Úszás</th>
                                <th colspan="3">Lovaglás</th>
                                <th colspan="3">Kombinált</th>
                                <th></th>
                            </tr>
                            <tr>
                                <th></th>
                                <th class="no-sort">Versenyző</th>
                                <th colspan="2">Nemzet</th>
                                <th>Klub</th>
                                <th>H</th>
                                <th class="no-sort">Gy</th>
                                <th class="no-sort">V</th>
                                <th class="no-sort">P</th>
                                <th>H</th>
                                <th class="no-sort">Idő</th>
                                <th class="no-sort">P</th>
                                <th>H</th>
                                <th class="no-sort">Ló</th>
                                <th class="no-sort">P</th>
                                <th>H</th>
                                <th class="no-sort">Idő</th>
                                <th class="no-sort">P</th>
                                <th>Össz</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($results as $key => $result)
                                <tr>
                                    <td>{!! $key+1 !!}</td>
                                    <td>{!! $result->competitor->full_name !!}</td>
                                    <td>{!! $result->competitor->country->iso_alpha3 !!}</td>
                                    <td><img src="/images/{!! $result->competitor->country->flag !!}"></td>
                                    <td>{!! $result->competitor->club->name !!}</td>
                                    <td>@if ($result->fencing_order != 0){!! $result->fencing_order !!} @else - @endif</td>
                                    @if($result->fencing_status == "")
                                        <td>{!! $result->fencing_win !!} </td>
                                        <td>{!! $result->fencing_lose !!}</td>
                                    @else
                                        <td>{!! $result->fencing_status !!}</td>
                                        <td>-</td>
                                    @endif
                                    <td>{!! $result->fencing_points !!}</td>
                                    <td>@if ($result->swimming_order != 0){!! $result->swimming_order !!} @else - @endif</td>
                                    @if($result->swimming_status == "")
                                        <td>{!! $result->swimming_time !!}</td>
                                    @else
                                        <td>{!! $result->swimming_status !!}</td>
                                    @endif
                                    <td>{!! $result->swimming_points !!}</td>
                                    <td>@if ($result->riding_order != 0){!! $result->riding_order !!} @else - @endif</td>
                                    <td>@if ($result->horse != null && $result->riding_status == "") {!! $result->horse->name !!} @else - @endif</td>
                                    @if($result->riding_status == "")
                                        <td>{!! $result->riding_points !!}</td>
                                    @else
                                        <td>{!! $result->riding_status !!}</td>
                                    @endif
                                    <td>@if ($result->ce_order != 0){!! $result->ce_order !!} @else - @endif</td>
                                    @if($result->ce_status == "")
                                        <td>{!! $result->ce_time !!}</td>
                                    @else
                                        <td>{!! $result->ce_status !!}</td>
                                    @endif
                                    <td>{!! $result->ce_points !!}</td>
                                    <td>{!! $result->total_points !!}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            @endif
        </div>

        @if ($results_dsq->isEmpty() && $teams->isEmpty())
        @if (Route::is('competition.show') || Route::is('competition.select'))<a href="/competitions" class="btn btn-info">Vissza a versenyekhez</a>
            <div class = "placeholder"></div> @endif
        @endif
    </div>

    @if (!$teams->isEmpty())
        <div class="container col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2> Csapatverseny eredménye</h2>
                </div>

                <div class="table-responsive">
                    <table id="results_teams" class="table table-bordered table-text-center">
                        <thead>
                        <tr>
                            <th colspan="2"></th>
                            <th colspan="2">Vívás</th>
                            <th colspan="2">Úszás</th>
                            <th colspan="2">Lovaglás</th>
                            <th colspan="2">Kombinált</th>
                            <th></th>
                        </tr>
                        <tr>
                            <th></th>
                            <th>Csapat neve</th>
                            <th>H</th>
                            <th>P</th>
                            <th>H</th>
                            <th>P</th>
                            <th>H</th>
                            <th>P</th>
                            <th>H</th>
                            <th>P</th>
                            <th>Össz</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($teams as $key => $team)
                            <tr>
                                <td rowspan="4">{!! $key+1 !!}</td>
                                <td rowspan="4"><strong>{!! $team->name !!}</strong> <br>
                                    {!! $team->competitor1->full_name !!} <br>
                                    {!! $team->competitor2->full_name !!} <br>
                                    {!! $team->competitor3->full_name !!} <br>
                                </td>
                                <td rowspan="4">{!! $team->fencing_order !!}</td>
                                <td rowspan="4">{!! $team->fencing_points !!}</td>
                                <td rowspan="4">{!! $team->swimming_order !!}</td>
                                <td rowspan="4">{!! $team->swimming_points !!}</td>
                                <td rowspan="4">{!! $team->riding_order !!}</td>
                                <td rowspan="4">{!! $team->riding_points !!}</td>
                                <td rowspan="4">{!! $team->ce_order !!}</td>
                                <td rowspan="4">{!! $team->ce_points !!}</td>
                                <td rowspan="4">{!! $team->total_points !!}</td>
                            </tr>
                            <tr></tr>
                            <tr></tr>
                            <tr></tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
            @if ($results_dsq->isEmpty())
            @if (Route::is('competition.show') || Route::is('competition.select'))<a href="/competitions" class="btn btn-info">Vissza a versenyekhez</a>
                <div class = "placeholder"></div>@endif
            @endif
        </div>
    @endif

    @if (!$results_dsq->isEmpty())
        <div class="container col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2> Kizárt versenyzők</h2>
                </div>

                <div class="table-responsive">
                    <table id="results_dsq" class="table table-bordered table-text-center">
                        <thead>
                        <tr>
                            <th></th>
                            <th>Versenyző neve</th>
                            <th colspan="2">Nemzet</th>
                            <th>Klub</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($results_dsq as $key => $result)
                            <tr>
                                <td>{!! $key+1 !!}</td>
                                <td>{!! $result->competitor->full_name !!}</td>
                                <td>{!! $result->competitor->country->iso_alpha3 !!}</td>
                                <td><img src="/images/{!! $result->competitor->country->flag !!}"></td>
                                <td>{!! $result->competitor->club->name !!}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
            @if (Route::is('competition.show') || Route::is('competition.select'))<a href="/competitions" class="btn btn-info">Vissza a versenyekhez</a> @endif
            <div class ="placeholder"></div>
        </div>
    @endif

    <script>
        $(document).ready(function() {
            $('#results').DataTable( {
                "pageLength": 50,
                "language": {
                    "lengthMenu": "_MENU_ versenyző megjelenítése",
                    "zeroRecords": "Nincs megjeleníthető versenyző",
                    "info": "_PAGE_.oldal, összesen ennyiből: _PAGES_",
                    "infoEmpty": "Nincsenek adatok",
                    "infoFiltered": "(megjelenítve _MAX_ versenyzőből)",
                    "sSearch": "Keresés",
                    "oPaginate": {
                        "sFirst":    "Első",
                        "sLast":    "Utolsó",
                        "sNext":    "Következő",
                        "sPrevious": "Előző"
                    },
                },
                "aoColumnDefs" : [ {
                    "bSortable" : false,
                    "aTargets" : [ "no-sort" ]
                } ],
                "aoColumns": [null, null, null, null, null, {"sType": "natural"}, null, null, null, {"sType": "natural"}, null, null, {"sType": "natural"}, null, null, {"sType": "natural"}, null, null, null]
            } );

        } );

    </script>


@endsection