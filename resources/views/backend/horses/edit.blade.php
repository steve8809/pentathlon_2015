@extends('master')
@section('title', 'Ló szerkesztése')

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
                    <legend>Ló szerkesztése</legend>
                    <div class="form-group">
                        <label for="name" class="col-lg-2 control-label">Név</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" id="name" name="name"
                                   value="{{ $horse->name }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="sex" class="col-lg-2 control-label">Neme</label>
                        <div class="col-lg-10">
                            <select class="form-control" name="sex" id="sex">
                                <option value="">Válassz nemet</option>
                                <option value="Mén">Mén</option>
                                <option value="Kanca">Kanca</option>
                                <option value="Herélt">Herélt</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="colour" class="col-lg-2 control-label">Szín</label>
                        <div class="col-lg-10">
                            <select class="form-control" name="colour" id="colour">
                                <option value="">Válassz színt</option>
                                <option value="Szürke">Szürke</option>
                                <option value="Fakó">Fakó</option>
                                <option value="Pej">Pej</option>
                                <option value="Fekete">Fekete</option>
                                <option value="Sárga">Sárga</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="age" class="col-lg-2 control-label">Kor</label>
                        <div class="col-lg-10">
                            <input type="number" class="form-control" value="5" min="1" max="50" id="age" name="age">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-lg-10 col-lg-offset-2">
                            <button type="reset" class="btn btn-default">Mégse</button>
                            <button type="submit" class="btn btn-primary">Mentés</button>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
@endsection