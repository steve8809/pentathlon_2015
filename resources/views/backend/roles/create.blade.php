@extends('master')
@section('title', 'Új jogosultság készítése')

@section('content')
    <div class="container col-md-8 col-md-offset-2">
        <div class="well well bs-component">

            <form class="form-horizontal" method="post">

                @foreach ($errors->all() as $error)
                    <p class="alert alert-danger">{{ $error }}</p>
                @endforeach

                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}

                    </div>
                @endif

                <input type="hidden" name="_token" value="{!! csrf_token() !!}">

                <fieldset>
                    <legend>Új jogosultság készítése</legend>
                    <div class="form-group">
                        <label for="name" class="col-lg-2 control-label">Név</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" id="name" name="name">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="display_name" class="col-lg-2 control-label">Megjelenített név</label>
                        <div class="col-lg-10">
                            <input type="display_name" class="form-control" id="display_name" name="display_name">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="description" class="col-lg-2 control-label">Leírás</label>
                        <div class="col-lg-10">
                            <textarea class="form-control" rows="3" id="description" name="description"></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-lg-10 col-lg-offset-2">
                            <button type="reset" class="btn btn-default">Mégse</button>
                            <button type="submit" class="btn btn-primary">Küldés</button>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
@endsection