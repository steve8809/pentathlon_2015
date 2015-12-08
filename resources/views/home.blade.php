@extends('master_main')
@section('title', 'Eredmények')
@section('content')

    @if($competition === null)
        <div class="container col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h1>Aktuális verseny</h1>
                </div>
                <p> Még nincsen egyetlen verseny sem az adatbázisban.</p>
            </div>
        </div>
    @else
        <div class="container col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    @if ($competitiongroups->isEmpty())
                        <h2> {!! $competition->name !!}</h2>
                        <p> Még nincsen csoport felvéve a versenyhez</p>
                    @else
                        @if (!Route::is('competition.show') && !Route::is('competition.select'))<h1>Aktuális verseny</h1> @endif
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
                            <table cellpadding="0" id="results" class="table table-bordered table-text-center table-hover">
                                <thead>
                                <tr>
                                    <th colspan="5"></th>
                                    <th colspan="4">Vívás</th>
                                    <th colspan="3">Úszás</th>
                                    <th colspan="4">Lovaglás</th>
                                    <th colspan="3">Kombinált</th>
                                    <th></th>
                                </tr>
                                <tr>
                                    <th class="sort"></th>
                                    <th class="no-sort">Versenyző</th>
                                    <th colspan="2">Nemzet</th>
                                    <th class="no-sort">Klub</th>
                                    <th class="sort">H</th>
                                    <th class="no-sort">Gy</th>
                                    <th class="no-sort">V</th>
                                    <th class="no-sort">P</th>
                                    <th class="sort">H</th>
                                    <th class="no-sort">Idő</th>
                                    <th class="no-sort">P</th>
                                    <th class="sort">H</th>
                                    <th class="no-sort">Idő</th>
                                    <th class="no-sort">Ló</th>
                                    <th class="no-sort">P</th>
                                    <th class="sort">H</th>
                                    <th class="no-sort">Idő</th>
                                    <th class="no-sort">P</th>
                                    <th class="no-sort">Össz</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($results as $key => $result)
                                    <tr>
                                        <td>{!! $key+1 !!}</td>
                                        <td>{!! $result->competitor->full_name !!}</td>
                                        <td>{!! $result->competitor->country->iso_alpha3 !!}</td>
                                        <td><img src="/images/{!! $result->competitor->country->flag !!}" alt="{!! $result->competitor->country->name !!} zászlaja"></td>
                                        <td>{!! $result->competitor->club->name !!}</td>
                                        <td>@if ($result->fencing_order != 0){!! $result->fencing_order !!} @else - @endif</td>
                                        @if($result->fencing_status == "")
                                            <td>@if (!is_null($result->fencing_win)){!! $result->fencing_win !!} @else - @endif</td>
                                            <td>@if (!is_null($result->fencing_lose)){!! $result->fencing_lose !!} @else - @endif</td>
                                        @else
                                            <td>{!! $result->fencing_status !!}</td>
                                            <td>-</td>
                                        @endif
                                        @if($result->penalty_points_fencing == null || $result->penalty_points_fencing == 0)
                                            <td>{!! $result->fencing_points !!}</td>
                                        @else
                                            <td>{!! $result->fencing_points !!} (-{!! $result->penalty_points_fencing !!})</td>
                                        @endif
                                        <td>@if ($result->swimming_order != 0){!! $result->swimming_order !!} @else - @endif</td>
                                        @if($result->swimming_status == "")
                                            <td>@if ($result->swimming_time != ""){!! $result->swimming_time !!} @else - @endif</td>
                                        @else
                                            <td>{!! $result->swimming_status !!}</td>
                                        @endif
                                        @if($result->penalty_points_swimming == null || $result->penalty_points_swimming == 0)
                                            <td>{!! $result->swimming_points !!}</td>
                                        @else
                                            <td>{!! $result->swimming_points !!} (-{!! $result->penalty_points_swimming !!})</td>
                                        @endif
                                        <td>@if ($result->riding_order != 0){!! $result->riding_order !!} @else - @endif</td>
                                        @if($result->riding_status == "")
                                            <td>@if ($result->riding_time != ""){!! $result->riding_time !!} @else - @endif</td>
                                        @else
                                            <td>{!! $result->riding_status !!}</td>
                                        @endif
                                        <td>@if ($result->horse != null && $result->riding_status == "") {!! $result->horse->name !!} @else - @endif</td>
                                        <td>{!! $result->riding_points !!}</td>
                                        <td>@if ($result->ce_order != 0){!! $result->ce_order !!} @else - @endif</td>
                                        @if($result->ce_status == "")
                                            <td>@if ($result->ce_time != ""){!! $result->ce_time !!} @else - @endif</td>
                                        @else
                                            <td>{!! $result->ce_status !!}</td>
                                        @endif
                                        @if($result->penalty_points_ce == null || $result->penalty_points_ce == 0)
                                            <td>{!! $result->ce_points !!}</td>
                                        @else
                                            <td>{!! $result->ce_points !!} (-{!! $result->penalty_points_ce !!})</td>
                                        @endif
                                        @if($result->total_penalty_points == null || $result->total_penalty_points == 0)
                                            <td>{!! $result->total_points !!}</td>
                                        @else
                                            <td>{!! $result->total_points !!} (-{!! $result->total_penalty_points !!})</td>
                                        @endif
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                @endif
            </div>

            @if ($results_dsq->isEmpty() && $teams->isEmpty())
            @if (Route::is('competition.show') || Route::is('competition.select'))<a href="/competitions" class="btn btn-info">Vissza a versenyekhez</a>@endif
                <div class = "placeholder"></div>
            @endif
        </div>

        @if (!$teams->isEmpty())
            <div class="container col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h2> Csapatverseny eredménye</h2>
                    </div>

                    <div class="table-responsive">
                        <table id="results_teams" class="table table-bordered table-text-center table-hover">
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
                                    <td rowspan="4">@if ($team->fencing_order != 0){!! $team->fencing_order !!} @else - @endif</td>
                                    <td rowspan="4">{!! $team->fencing_points !!}</td>
                                    <td rowspan="4">@if ($team->swimming_order != 0){!! $team->swimming_order !!} @else - @endif</td>
                                    <td rowspan="4">{!! $team->swimming_points !!}</td>
                                    <td rowspan="4">@if ($team->riding_order != 0){!! $team->riding_order !!} @else - @endif</td>
                                    <td rowspan="4">{!! $team->riding_points !!}</td>
                                    <td rowspan="4">@if ($team->ce_order != 0){!! $team->ce_order !!} @else - @endif</td>
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
                @if (Route::is('competition.show') || Route::is('competition.select'))<a href="/competitions" class="btn btn-info">Vissza a versenyekhez</a>@endif
                    <div class = "placeholder"></div>
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
                        <table id="results_dsq" class="table table-bordered table-text-center table-hover">
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
                                    <td><img src="/images/{!! $result->competitor->country->flag !!}" alt="{!! $result->competitor->country->name !!} zászlaja"></td>
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
                "aoColumns": [null, null, null, null, null, {"sType": "natural"}, null, null, null, {"sType": "natural"}, null, null, {"sType": "natural"}, null, null, null, {"sType": "natural"}, null, null, null]
            } );

        } );

    </script>


@endsection