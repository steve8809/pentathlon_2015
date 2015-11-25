@extends('master_main')
@section('title', 'Statisztikák')
@section('content')

    <div class="container col-md-10 col-md-offset-1">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2> Statisztikák - Nők </h2>
            </div>

            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Megnevezés</th>
                            <th>Pontszám/Idő</th>
                            <th>Versenyző</th>
                            <th>Verseny</th>
                            <th>Dátum</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Legjobb össz pontszám</td>
                            <td>@if ($best_total_female){!! $best_total_female->total_points !!} @else - @endif</td>
                            <td>@if ($best_total_female){!! $best_total_female->competitor->full_name !!}@else - @endif</td>
                            <td>@if ($best_total_female){!! $best_total_female->competitiongroup->competition->name !!}@else - @endif</td>
                            <td>@if ($best_total_female){!! $best_total_female->competitiongroup->date !!}@else - @endif</td>
                        </tr>
                        <tr>
                            <td>Legjobb vívás pontszám</td>
                            <td>@if ($best_fencing_female){!! $best_fencing_female->fencing_points !!} @else - @endif</td>
                            <td>@if ($best_fencing_female){!! $best_fencing_female->competitor->full_name !!}@else - @endif</td>
                            <td>@if ($best_fencing_female){!! $best_fencing_female->competitiongroup->competition->name !!}@else - @endif</td>
                            <td>@if ($best_fencing_female){!! $best_fencing_female->competitiongroup->date !!}@else - @endif</td>
                        </tr>
                        <tr>
                            <td>Legjobb úszóidő - 200 m</td>
                            <td>@if ($best_swimming_200_female){!! $best_swimming_200_female->swimming_time !!} @else - @endif</td>
                            <td>@if ($best_swimming_200_female){!! $best_swimming_200_female->competitor->full_name !!}@else - @endif</td>
                            <td>@if ($best_swimming_200_female){!! $best_swimming_200_female->competitiongroup->competition->name !!}@else - @endif</td>
                            <td>@if ($best_swimming_200_female){!! $best_swimming_200_female->competitiongroup->date !!}@else - @endif</td>
                        </tr>
                        <tr>
                            <td>Legjobb úszóidő - 100 m</td>
                            <td>@if ($best_swimming_100_female){!! $best_swimming_100_female->swimming_time !!} @else - @endif</td>
                            <td>@if ($best_swimming_100_female){!! $best_swimming_100_female->competitor->full_name !!}@else - @endif</td>
                            <td>@if ($best_swimming_100_female){!! $best_swimming_100_female->competitiongroup->competition->name !!}@else - @endif</td>
                            <td>@if ($best_swimming_100_female){!! $best_swimming_100_female->competitiongroup->date !!}@else - @endif</td>
                        </tr>
                        <tr>
                            <td>Legjobb úszóidő - 50 m</td>
                            <td>@if ($best_swimming_50_female){!! $best_swimming_50_female->swimming_time !!} @else - @endif</td>
                            <td>@if ($best_swimming_50_female){!! $best_swimming_50_female->competitor->full_name !!}@else - @endif</td>
                            <td>@if ($best_swimming_50_female){!! $best_swimming_50_female->competitiongroup->competition->name !!}@else - @endif</td>
                            <td>@if ($best_swimming_50_female){!! $best_swimming_50_female->competitiongroup->date !!}@else - @endif</td>
                        </tr>
                        <tr>
                            <td>Legjobb kombinált idő - 3200 m</td>
                            <td>@if ($best_ce_3200_female){!! $best_ce_3200_female->ce_time !!} @else - @endif</td>
                            <td>@if ($best_ce_3200_female){!! $best_ce_3200_female->competitor->full_name !!}@else - @endif</td>
                            <td>@if ($best_ce_3200_female){!! $best_ce_3200_female->competitiongroup->competition->name !!}@else - @endif</td>
                            <td>@if ($best_ce_3200_female){!! $best_ce_3200_female->competitiongroup->date !!}@else - @endif</td>
                        </tr>
                        <tr>
                            <td>Legjobb kombinált idő - 2400 m</td>
                            <td>@if ($best_ce_2400_female){!! $best_ce_2400_female->ce_time !!} @else - @endif</td>
                            <td>@if ($best_ce_2400_female){!! $best_ce_2400_female->competitor->full_name !!}@else - @endif</td>
                            <td>@if ($best_ce_2400_female){!! $best_ce_2400_female->competitiongroup->competition->name !!}@else - @endif</td>
                            <td>@if ($best_ce_2400_female){!! $best_ce_2400_female->competitiongroup->date !!}@else - @endif</td>
                        </tr>
                        <tr>
                            <td>Legjobb kombinált idő - 1600 m</td>
                            <td>@if ($best_ce_1600_female){!! $best_ce_1600_female->ce_time !!} @else - @endif</td>
                            <td>@if ($best_ce_1600_female){!! $best_ce_1600_female->competitor->full_name !!}@else - @endif</td>
                            <td>@if ($best_ce_1600_female){!! $best_ce_1600_female->competitiongroup->competition->name !!}@else - @endif</td>
                            <td>@if ($best_ce_1600_female){!! $best_ce_1600_female->competitiongroup->date !!}@else - @endif</td>
                        </tr>
                        <tr>
                            <td>Legjobb kombinált idő - 800 m</td>
                            <td>@if ($best_ce_800_female){!! $best_ce_800_female->ce_time !!} @else - @endif</td>
                            <td>@if ($best_ce_800_female){!! $best_ce_800_female->competitor->full_name !!}@else - @endif</td>
                            <td>@if ($best_ce_800_female){!! $best_ce_800_female->competitiongroup->competition->name !!}@else - @endif</td>
                            <td>@if ($best_ce_800_female){!! $best_ce_800_female->competitiongroup->date !!}@else - @endif</td>
                        </tr>
                        <tr>
                            <td>Legjobb kombinált idő - 400 m</td>
                            <td>@if ($best_ce_400_female){!! $best_ce_400_female->ce_time !!} @else - @endif</td>
                            <td>@if ($best_ce_400_female){!! $best_ce_400_female->competitor->full_name !!}@else - @endif</td>
                            <td>@if ($best_ce_400_female){!! $best_ce_400_female->competitiongroup->competition->name !!}@else - @endif</td>
                            <td>@if ($best_ce_400_female){!! $best_ce_400_female->competitiongroup->date !!}@else - @endif</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="container col-md-10 col-md-offset-1">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2> Statisztikák - Férfiak </h2>
            </div>

            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Megnevezés</th>
                        <th>Pontszám/Idő</th>
                        <th>Versenyző</th>
                        <th>Verseny</th>
                        <th>Dátum</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Legjobb össz pontszám</td>
                            <td>@if ($best_total_male){!! $best_total_male->total_points !!} @else - @endif</td>
                            <td>@if ($best_total_male){!! $best_total_male->competitor->full_name !!}@else - @endif</td>
                            <td>@if ($best_total_male){!! $best_total_male->competitiongroup->competition->name !!}@else - @endif</td>
                            <td>@if ($best_total_male){!! $best_total_male->competitiongroup->date !!}@else - @endif</td>
                        </tr>
                        <tr>
                            <td>Legjobb vívás pontszám</td>
                            <td>@if ($best_fencing_male){!! $best_fencing_male->fencing_points !!} @else - @endif</td>
                            <td>@if ($best_fencing_male){!! $best_fencing_male->competitor->full_name !!}@else - @endif</td>
                            <td>@if ($best_fencing_male){!! $best_fencing_male->competitiongroup->competition->name !!}@else - @endif</td>
                            <td>@if ($best_fencing_male){!! $best_fencing_male->competitiongroup->date !!}@else - @endif</td>
                        </tr>
                        <tr>
                            <td>Legjobb úszóidő - 200 m</td>
                            <td>@if ($best_swimming_200_male){!! $best_swimming_200_male->swimming_time !!} @else - @endif</td>
                            <td>@if ($best_swimming_200_male){!! $best_swimming_200_male->competitor->full_name !!}@else - @endif</td>
                            <td>@if ($best_swimming_200_male){!! $best_swimming_200_male->competitiongroup->competition->name !!}@else - @endif</td>
                            <td>@if ($best_swimming_200_male){!! $best_swimming_200_male->competitiongroup->date !!}@else - @endif</td>
                        </tr>
                        <tr>
                            <td>Legjobb úszóidő - 100 m</td>
                            <td>@if ($best_swimming_100_male){!! $best_swimming_100_male->swimming_time !!} @else - @endif</td>
                            <td>@if ($best_swimming_100_male){!! $best_swimming_100_male->competitor->full_name !!}@else - @endif</td>
                            <td>@if ($best_swimming_100_male){!! $best_swimming_100_male->competitiongroup->competition->name !!}@else - @endif</td>
                            <td>@if ($best_swimming_100_male){!! $best_swimming_100_male->competitiongroup->date !!}@else - @endif</td>
                        </tr>
                        <tr>
                            <td>Legjobb úszóidő - 50 m</td>
                            <td>@if ($best_swimming_50_male){!! $best_swimming_50_male->swimming_time !!} @else - @endif</td>
                            <td>@if ($best_swimming_50_male){!! $best_swimming_50_male->competitor->full_name !!}@else - @endif</td>
                            <td>@if ($best_swimming_50_male){!! $best_swimming_50_male->competitiongroup->competition->name !!}@else - @endif</td>
                            <td>@if ($best_swimming_50_male){!! $best_swimming_50_male->competitiongroup->date !!}@else - @endif</td>
                        </tr>
                        <tr>
                            <td>Legjobb kombinált idő - 3200 m</td>
                            <td>@if ($best_ce_3200_male){!! $best_ce_3200_male->ce_time !!} @else - @endif</td>
                            <td>@if ($best_ce_3200_male){!! $best_ce_3200_male->competitor->full_name !!}@else - @endif</td>
                            <td>@if ($best_ce_3200_male){!! $best_ce_3200_male->competitiongroup->competition->name !!}@else - @endif</td>
                            <td>@if ($best_ce_3200_male){!! $best_ce_3200_male->competitiongroup->date !!}@else - @endif</td>
                        </tr>
                        <tr>
                            <td>Legjobb kombinált idő - 2400 m</td>
                            <td>@if ($best_ce_2400_male){!! $best_ce_2400_male->ce_time !!} @else - @endif</td>
                            <td>@if ($best_ce_2400_male){!! $best_ce_2400_male->competitor->full_name !!}@else - @endif</td>
                            <td>@if ($best_ce_2400_male){!! $best_ce_2400_male->competitiongroup->competition->name !!}@else - @endif</td>
                            <td>@if ($best_ce_2400_male){!! $best_ce_2400_male->competitiongroup->date !!}@else - @endif</td>
                        </tr>
                        <tr>
                            <td>Legjobb kombinált idő - 1600 m</td>
                            <td>@if ($best_ce_1600_male){!! $best_ce_1600_male->ce_time !!} @else - @endif</td>
                            <td>@if ($best_ce_1600_male){!! $best_ce_1600_male->competitor->full_name !!}@else - @endif</td>
                            <td>@if ($best_ce_1600_male){!! $best_ce_1600_male->competitiongroup->competition->name !!}@else - @endif</td>
                            <td>@if ($best_ce_1600_male){!! $best_ce_1600_male->competitiongroup->date !!}@else - @endif</td>
                        </tr>
                        <tr>
                            <td>Legjobb kombinált idő - 800 m</td>
                            <td>@if ($best_ce_800_male){!! $best_ce_800_male->ce_time !!} @else - @endif</td>
                            <td>@if ($best_ce_800_male){!! $best_ce_800_male->competitor->full_name !!}@else - @endif</td>
                            <td>@if ($best_ce_800_male){!! $best_ce_800_male->competitiongroup->competition->name !!}@else - @endif</td>
                            <td>@if ($best_ce_800_male){!! $best_ce_800_male->competitiongroup->date !!}@else - @endif</td>
                        </tr>
                        <tr>
                            <td>Legjobb kombinált idő - 400 m</td>
                            <td>@if ($best_ce_400_male){!! $best_ce_400_male->ce_time !!} @else - @endif</td>
                            <td>@if ($best_ce_400_male){!! $best_ce_400_male->competitor->full_name !!}@else - @endif</td>
                            <td>@if ($best_ce_400_male){!! $best_ce_400_male->competitiongroup->competition->name !!}@else - @endif</td>
                            <td>@if ($best_ce_400_male){!! $best_ce_400_male->competitiongroup->date !!}@else - @endif</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="placeholder"></div>
    </div>


@endsection