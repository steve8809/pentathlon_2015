@extends('master')
@section('title', 'Regisztráció')

@section('content')
    <div class="container col-md-6 col-md-offset-3">
        <div class="well well bs-component">

            <form class="form-horizontal" method="post">

                @foreach ($errors->all() as $error)
                    <p class="alert alert-danger">{{ $error }}</p>
                @endforeach

                {!! csrf_field() !!}

                <fieldset>
                    <legend>Felhasználó regisztrálása</legend>
                    <div class="form-group">
                        <label for="name" class="col-lg-2 control-label">Név</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" id="name" placeholder="Név" name="name" value="{{ old('name') }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email" class="col-lg-2 control-label">E-mail</label>
                        <div class="col-lg-10">
                            <input type="email" class="form-control" id="email" placeholder="E-mail" name="email" value="{{ old('email') }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password" class="col-lg-2 control-label">Jelszó</label>
                        <div class="col-lg-10">
                            <input type="password" class="form-control"  name="password" placeholder="Jelszó">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password" class="col-lg-2 control-label">Jelszó ismét</label>
                        <div class="col-lg-10">
                            <input type="password" class="form-control"  name="password_confirmation" placeholder="Jelszó ismét">
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