@extends('master')
@section('title', 'Nevezés versenyre')

@section('content')
    <div class="container col-md-8 col-md-offset-2">
        <div class="well well bs-component">

            @include('statuses.alert_success')

            {!! Form::model($competitiongroup, array('class' => 'form-horizontal')) !!}

            <fieldset>
                <legend>Nevezés a következő versenyre: {!! $competitiongroup->competition->name.' - '.$competitiongroup->name !!}</legend>

                <div class="form-group">
                    {!! Form::label('competitors', 'Versenyző', array('class' => 'col-lg-2 control-label')) !!}
                    <div class="col-lg-10">
                        {!! Form::select('competitors[]', $competitors, null, array('id' => 'competitors', 'class' => 'form-control', 'multiple')) !!}
                    </div>
                </div>



                <div class="form-group">
                    <div class="col-lg-10 col-lg-offset-2">
                        {!! Form::submit('Nevezés versenyre', array('class' => 'btn btn-primary')) !!}
                    </div>
                </div>

            </fieldset>

            {!! Form::close() !!}
        </div>
    </div>
    <div class="container col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2> Nevezett versenyzők</h2>
            </div>
            @if (empty($competitor_in))
                <p> Nincs egy nevezett versenyző sem.</p>
            @else
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Versenyző neve</th>
                            <th>Műveletek</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($competitor_in as $key => $competitor)
                            <tr>
                                <td>{!! $competitor !!}</td>
                                <td>
                                    {!! Form::open(['method' => 'DELETE', 'route'=>['admin.destroy_entry', $key]]) !!}
                                    <button class='btn btn-danger' type='button' data-toggle="modal" data-target="#confirmDelete"
                                            data-title="Versenyző nevezésének törlése" data-message='Biztos, hogy törlöd a következő versenyző nevezését?: {!! $competitor !!}?'>
                                        <span class='glyphicon glyphicon-trash'></span> Nevezés törlése
                                    </button>
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
        <a href="/admin/competitiongroups" class="btn btn-info">Vissza a csoportokhoz</a>
    </div>

    @include('modals.confirm_delete')

@endsection