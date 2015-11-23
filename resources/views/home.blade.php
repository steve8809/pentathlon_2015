@extends('master_main')
@section('title', 'Aktuális verseny')
@section('content')

    <div class="container col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2> {!! $competitiongroup->name !!} </h2>
            </div>

            @if ($results->isEmpty())
                <p> Még nem kezdődött el a verseny.</p>
            @else
                <div class="table-responsive">
                    <table id="example" class="table">
                        <thead>
                        <tr>
                            <th colspan="4"></th>
                            <th colspan="4">Vívás</th>
                            <th colspan="3">Úszás</th>
                            <th colspan="3">Lovaglás</th>
                            <th colspan="4">Kombinált</th>
                        </tr>
                        <tr>
                            <th></th>
                            <th>Versenyző</th>
                            <th colspan="2">Nemzet</th>
                            <th>H</th>
                            <th>Gy</th>
                            <th>V</th>
                            <th>P</th>
                            <th>H</th>
                            <th>Idő</th>
                            <th>P</th>
                            <th>H</th>
                            <th>Ló</th>
                            <th>P</th>
                            <th>H</th>
                            <th>Idő</th>
                            <th>P</th>
                            <th>Össz</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($results as $key => $result)
                            <tr>
                                <td>{!! $key+1 !!}</td>
                                <td>{!! $result->competitor->full_name !!}</td>
                                <td>{!! $result->competitor->country->iso_alpha3 !!}</td>
                                <td><img src="images/{!! $result->competitor->country->flag !!}"></td>

                                <td>{!! $result->fencing_order !!}</td>
                                <td>{!! $result->fencing_win !!} </td>
                                <td>{!! $result->fencing_lose !!}</td>
                                <td>{!! $result->fencing_points !!}</td>
                                <td>{!! $result->swimming_order !!}</td>
                                <td>{!! $result->swimming_time !!}</td>
                                <td>{!! $result->swimming_points !!}</td>
                                <td>{!! $result->riding_order !!}</td>
                                <td>{!! $result->riding_horse !!}</td>
                                <td>{!! $result->riding_points !!}</td>
                                <td>{!! $result->ce_order !!}</td>
                                <td>{!! $result->ce_time !!}</td>
                                <td>{!! $result->ce_points !!}</td>
                                <td>{!! $result->total_points !!}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
            @endif

        </div>
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
            }
        } );
    } );
</script>


@endsection