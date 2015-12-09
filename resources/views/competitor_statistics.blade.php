@extends('master_main')
@section('title', 'Versenyzők statisztikája')

@section('content')
    @if($competitors->isEmpty())
        <div class="container col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h1>Versenzyők statisztikája</h1>
                </div>
                <p> Még nincsen egyetlen versenyző sem az adatbázisban.</p>
            </div>
        </div>
    @else
        <div class="container col-md-10 col-md-offset-1">
            <div class="well well bs-component">
                {!! Form::open(['method' => 'get', 'class' => 'form-horizontal']) !!}
                <fieldset>
                    <div class="form-group">
                        {!! Form::label('competitor', 'Versenyző kiválasztása', array('class' => 'col-lg-3 control-label')) !!}
                        <div class="col-lg-3">
                            {!! Form::select('competitor', $competitor_in, $act_competitor , array('id' => 'competitors', 'class' => 'form-control')) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-lg-10 col-lg-offset-3">
                            {!! Form::submit('Listázás', array('class' => 'btn btn-primary')) !!}
                        </div>
                    </div>
                </fieldset>
                {!! Form::close() !!}
            </div>
        </div>

        <div class="container col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2> Statisztikák - {!! $competitor_in[$act_competitor] !!} </h2>
                </div>

                <div class="table-responsive">
                    <table class="table table-text-center table-hover">
                        <thead>
                            <tr>
                                <th>Megnevezés</th>
                                <th>Pontszám/Idő</th>
                                <th>Verseny</th>
                                <th>Csoport</th>
                                <th>Dátum</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Legjobb össz pontszám</td>
                                <td>@if ($best_total){!! $best_total->total_points !!} @else - @endif</td>
                                <td>@if ($best_total){!! $best_total->competitiongroup->competition->name !!}@else - @endif</td>
                                <td>@if ($best_total){!! $best_total->competitiongroup->name !!}@else - @endif</td>
                                <td>@if ($best_total){!! $best_total->competitiongroup->date !!}@else - @endif</td>
                            </tr>
                            <tr>
                                <td>Legjobb vívás pontszám</td>
                                <td>@if ($best_fencing){!! $best_fencing->fencing_points !!} @else - @endif</td>
                                <td>@if ($best_fencing){!! $best_fencing->competitiongroup->competition->name !!}@else - @endif</td>
                                <td>@if ($best_fencing){!! $best_fencing->competitiongroup->name !!}@else - @endif</td>
                                <td>@if ($best_fencing){!! $best_fencing->competitiongroup->date !!}@else - @endif</td>
                            </tr>
                            <tr>
                                <td>Legjobb lovaglás pontszám</td>
                                <td>@if ($best_riding){!! $best_riding->riding_points !!} @else - @endif</td>
                                <td>@if ($best_riding){!! $best_riding->competitiongroup->competition->name !!}@else - @endif</td>
                                <td>@if ($best_riding){!! $best_riding->competitiongroup->name !!}@else - @endif</td>
                                <td>@if ($best_riding){!! $best_riding->competitiongroup->date !!}@else - @endif</td>
                            </tr>
                            <tr>
                                <td>Legjobb úszóidő - 200 m</td>
                                <td>@if ($best_swimming_200){!! $best_swimming_200->swimming_time !!} @else - @endif</td>
                                <td>@if ($best_swimming_200){!! $best_swimming_200->competitiongroup->competition->name !!}@else - @endif</td>
                                <td>@if ($best_swimming_200){!! $best_swimming_200->competitiongroup->name !!}@else - @endif</td>
                                <td>@if ($best_swimming_200){!! $best_swimming_200->competitiongroup->date !!}@else - @endif</td>
                            </tr>
                            <tr>
                                <td>Legjobb úszóidő - 100 m</td>
                                <td>@if ($best_swimming_100){!! $best_swimming_100->swimming_time !!} @else - @endif</td>
                                <td>@if ($best_swimming_100){!! $best_swimming_100->competitiongroup->competition->name !!}@else - @endif</td>
                                <td>@if ($best_swimming_100){!! $best_swimming_100->competitiongroup->name !!}@else - @endif</td>
                                <td>@if ($best_swimming_100){!! $best_swimming_100->competitiongroup->date !!}@else - @endif</td>
                            </tr>
                            <tr>
                                <td>Legjobb úszóidő - 50 m</td>
                                <td>@if ($best_swimming_50){!! $best_swimming_50->swimming_time !!} @else - @endif</td>
                                <td>@if ($best_swimming_50){!! $best_swimming_50->competitiongroup->competition->name !!}@else - @endif</td>
                                <td>@if ($best_swimming_50){!! $best_swimming_50->competitiongroup->name !!}@else - @endif</td>
                                <td>@if ($best_swimming_50){!! $best_swimming_50->competitiongroup->date !!}@else - @endif</td>
                            </tr>
                            <tr>
                                <td>Legjobb kombinált idő - 3200 m</td>
                                <td>@if ($best_ce_3200){!! $best_ce_3200->ce_time !!} @else - @endif</td>
                                <td>@if ($best_ce_3200){!! $best_ce_3200->competitiongroup->competition->name !!}@else - @endif</td>
                                <td>@if ($best_ce_3200){!! $best_ce_3200->competitiongroup->name !!}@else - @endif</td>
                                <td>@if ($best_ce_3200){!! $best_ce_3200->competitiongroup->date !!}@else - @endif</td>
                            </tr>
                            <tr>
                                <td>Legjobb kombinált idő - 2400 m</td>
                                <td>@if ($best_ce_2400){!! $best_ce_2400->ce_time !!} @else - @endif</td>
                                <td>@if ($best_ce_2400){!! $best_ce_2400->competitiongroup->competition->name !!}@else - @endif</td>
                                <td>@if ($best_ce_2400){!! $best_ce_2400->competitiongroup->name !!}@else - @endif</td>
                                <td>@if ($best_ce_2400){!! $best_ce_2400->competitiongroup->date !!}@else - @endif</td>
                            </tr>
                            <tr>
                                <td>Legjobb kombinált idő - 1600 m</td>
                                <td>@if ($best_ce_1600){!! $best_ce_1600->ce_time !!} @else - @endif</td>
                                <td>@if ($best_ce_1600){!! $best_ce_1600->competitiongroup->competition->name !!}@else - @endif</td>
                                <td>@if ($best_ce_1600){!! $best_ce_1600->competitiongroup->name !!}@else - @endif</td>
                                <td>@if ($best_ce_1600){!! $best_ce_1600->competitiongroup->date !!}@else - @endif</td>
                            </tr>
                            <tr>
                                <td>Legjobb kombinált idő - 800 m</td>
                                <td>@if ($best_ce_800){!! $best_ce_800->ce_time !!} @else - @endif</td>
                                <td>@if ($best_ce_800){!! $best_ce_800->competitiongroup->competition->name !!}@else - @endif</td>
                                <td>@if ($best_ce_800){!! $best_ce_800->competitiongroup->name !!}@else - @endif</td>
                                <td>@if ($best_ce_800){!! $best_ce_800->competitiongroup->date !!}@else - @endif</td>
                            </tr>
                            <tr>
                                <td>Legjobb kombinált idő - 400 m</td>
                                <td>@if ($best_ce_400){!! $best_ce_400->ce_time !!} @else - @endif</td>
                                <td>@if ($best_ce_400){!! $best_ce_400->competitiongroup->competition->name !!}@else - @endif</td>
                                <td>@if ($best_ce_400){!! $best_ce_400->competitiongroup->name !!}@else - @endif</td>
                                <td>@if ($best_ce_400){!! $best_ce_400->competitiongroup->date !!}@else - @endif</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            @if ($all_result->isEmpty()) <div class="placeholder"></div> @endif
        </div>
        <div class="container col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2> Versenyző eredményei </h2>
                </div>
                @if ($all_result->isEmpty())
                    <p> Nincs egy eredménye sem.</p>
                @else
                    <div class="table-responsive">
                        <table cellpadding="0" id="results_stats" class="table table-hover table-bordered table-text-center">
                            <thead>
                            <tr>
                                <th colspan="3"></th>
                                <th colspan="4">Vívás</th>
                                <th colspan="3">Úszás</th>
                                <th colspan="4">Lovaglás</th>
                                <th colspan="3">Kombinált</th>
                                <th></th>
                            </tr>
                            <tr>
                                <th class="no-sort">Verseny</th>
                                <th class="no-sort">Csoport</th>
                                <th class="sort">Dátum</th>
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
                                <th class="sort">Össz</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($all_result as $result)
                                <tr>
                                    <td>{!! $result->competitiongroup->competition->name !!}</td>
                                    <td>{!! $result->competitiongroup->name !!}</td>
                                    <td>{!! $result->competitiongroup->date !!}</td>
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
            </div>
            <div class="placeholder"></div>
        </div>

    @endif
    <script>
        $(document).ready(function() {
            $('#results_stats').DataTable( {
                "pageLength": 50,
                "language": {
                    "lengthMenu": "_MENU_ eredmény megjelenítése",
                    "zeroRecords": "Nincs megjeleníthető eredmény",
                    "info": "_PAGE_.oldal, összesen ennyiből: _PAGES_",
                    "infoEmpty": "Nincsenek adatok",
                    "infoFiltered": "(megjelenítve _MAX_ eredményből)",
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
                "order": [[ 17, "desc" ]],
                "aoColumns": [null, null, null, {"sType": "natural"}, null, null, null, {"sType": "natural"}, null, null, {"sType": "natural"}, null, null, null, {"sType": "natural"}, null, null, null]
            } );

        } );

    </script>
@endsection