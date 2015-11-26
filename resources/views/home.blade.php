@extends('master_main')
@section('title', 'Aktuális verseny')
@section('content')

    <div class="container col-md-10 col-md-offset-1">
        <div class="panel panel-default">
            <div class="panel-heading">
                @if ($competitiongroups->isEmpty())
                    <h2> {!! $competition->name !!}</h2>
                    <p> Még nincsen csoport felvéve a versenyhez</p>
                @else
                    <h2> {!! $competition->name.' - '. $competitiongroup->name.' - '.$competitiongroup->type.' - '.$competitiongroup->date !!} </h2>
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
                    <p> Még nem kezdődött el a verseny.</p>
                @else
                    <div class="table-responsive">
                        <table id="example" class="table">
                            <thead>
                            <tr>
                                <th colspan="5"></th>
                                <th colspan="4">Vívás</th>
                                <th colspan="3">Úszás</th>
                                <th colspan="3">Lovaglás</th>
                                <th colspan="4">Kombinált</th>
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
                                    <td>{!! $result->fencing_order !!}</td>
                                    @if($result->fencing_status == "")
                                        <td>{!! $result->fencing_win !!} </td>
                                        <td>{!! $result->fencing_lose !!}</td>
                                    @else
                                        <td colspan="2">{!! $result->fencing_status !!}</td>
                                    @endif
                                    <td>{!! $result->fencing_points !!}</td>
                                    <td>{!! $result->swimming_order !!}</td>
                                    @if($result->swimming_status == "")
                                        <td>{!! $result->swimming_time !!}</td>
                                    @else
                                        <td>{!! $result->swimming_status !!}</td>
                                    @endif
                                    <td>{!! $result->swimming_points !!}</td>
                                    <td>{!! $result->riding_order !!}</td>
                                    <td>@if ($result->horse != null && $result->riding_status == "") {!! $result->horse->name !!} @endif</td>
                                    @if($result->riding_status == "")
                                        <td>{!! $result->riding_points !!}</td>
                                    @else
                                        <td>{!! $result->riding_status !!}</td>
                                    @endif
                                    <td>{!! $result->ce_order !!}</td>
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

        @if (Route::is('competition.show') || Route::is('competition.select'))<a href="/competitions" class="btn btn-info">Vissza a versenyekhez</a> @endif
        <div class = "placeholder"></div>
    </div>
    <script>
        $(document).ready(function() {
            $('#example').DataTable( {
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
                } ]
            } );
        } );
    </script>


@endsection