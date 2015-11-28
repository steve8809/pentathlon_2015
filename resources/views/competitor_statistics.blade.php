@extends('master_main')
@section('title', 'Versenyzők statisztikája')

@section('content')
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
                <table class="table table-text-center">
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
    </div>

@endsection