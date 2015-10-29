@extends('master')
@section('title', 'Új ló felvétele')

@section('content')
    <div class="container col-md-8 col-md-offset-2">
        <div class="well well bs-component">

            {!! Form::open(array('url' => 'admin/horses/create', 'class' => 'form-horizontal')) !!}

                @foreach ($errors->all() as $error)
                    <p class="alert alert-danger">{{ $error }}</p>
                @endforeach

                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}

                    </div>
                @endif
            <fieldset>
                <legend>Ló szerkesztése</legend>

                <div class="form-group">
                    {!! Form::label('name', 'Név', array('class' => 'col-lg-2 control-label')) !!}
                    <div class="col-lg-10">
                        {!! Form::text('name', Input::old('name'), array('class' => 'form-control', 'placeholder' => 'Név')) !!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('sex', 'Neme') !!}
                    {!! Form::select('sex', array('' => 'Válassz nemet', 'Mén' => 'Mén', 'Kanca' => 'Kanca', 'Herélt' => 'Herélt'), Input::old('sex')) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('colour', 'Szín') !!}
                    {!! Form::select('colour', array('' => 'Válassz színt', 'Szürke' => 'Szürke', 'Fakó' => 'Fakó', 'Pej' => 'Pej', 'Fekete' => 'Fekete', 'Sárga' => 'Sárga'), Input::old('colour')) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('age', 'Kor') !!}
                    {!! Form::selectRange('age', 1, 50), Input::old('age') !!}
                </div>
                <div class="form-group">
                    {!! Form::submit('Ló létrehozása', array('class' => 'button_submit')) !!}
                </div>
            </fieldset>

            {!! Form::close() !!}



        </div>
    </div>
@endsection