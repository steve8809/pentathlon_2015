@extends('master')
@section('title', 'Felhasználó szerkesztése')

@section('content')
    <div class="container col-md-6 col-md-offset-3">
        <div class="well well bs-component">

            <form class="form-horizontal" method="post">

                @include('errors.list')

                @include('statuses.alert_success')

                {!! csrf_field() !!}

                <fieldset>
                    <legend>Felhasználó szerkesztése</legend>
                    <div class="form-group @if ($errors->has('name')) has-error @endif">
                        <label for="name" class="col-lg-2 control-label">Név</label>

                        <div class="col-lg-10">
                            <input type="text" class="form-control" id="name" placeholder="Név" name="name"
                                   value="{{ $user->name }}">
                        </div>
                    </div>

                    <div class="form-group @if ($errors->has('email')) has-error @endif">
                        <label for="email" class="col-lg-2 control-label">E-mail</label>

                        <div class="col-lg-10">
                            <input type="email" class="form-control" id="email" placeholder="E-mail" name="email"
                                   value="{{ $user->email }}">
                        </div>
                    </div>

                    <div class="form-group @if ($errors->has('role')) has-error @endif">
                        <label for="select" class="col-lg-2 control-label">Szerep</label>

                        <div class="col-lg-10">
                            <select class="form-control" id="role" name="role[]" multiple>
                                @foreach($roles as $role)
                                    <option value="{!! $role->id !!}"  @if(in_array($role->id, $selectedRoles))
                                    selected="selected" @endif >{!! $role->display_name !!}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group @if ($errors->has('password')) has-error @endif">
                        <label for="password" class="col-lg-2 control-label">Jelszó</label>

                        <div class="col-lg-10">
                            <input type="password" class="form-control" name="password">
                        </div>
                    </div>

                    <div class="form-group @if ($errors->has('password')) has-error @endif">
                        <label for="password" class="col-lg-2 control-label">Jelszó ismét</label>

                        <div class="col-lg-10">
                            <input type="password" class="form-control" name="password_confirmation">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-lg-10 col-lg-offset-2">
                            <button type="submit" class="btn btn-primary">Mentés</button>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
        <a href="/admin/users" class="btn btn-info">Vissza a felhasználókhoz</a>
        <div class="placeholder"></div>
    </div>
@endsection