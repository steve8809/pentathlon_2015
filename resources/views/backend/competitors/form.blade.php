<fieldset>
    <legend>{!! $legend !!}</legend>

    <div class="form-group @if ($errors->has('last_name')) has-error @endif">
        {!! Form::label('last_name', 'Vezetéknév', array('class' => 'col-lg-2 control-label')) !!}
        <div class="col-lg-10">
            {!! Form::text('last_name', null , array('class' => 'form-control', 'placeholder' => 'Vezetéknév')) !!}
        </div>
    </div>

    <div class="form-group @if ($errors->has('first_name')) has-error @endif">
        {!! Form::label('first_name', 'Keresztnév', array('class' => 'col-lg-2 control-label')) !!}
        <div class="col-lg-10">
            {!! Form::text('first_name', null , array('class' => 'form-control', 'placeholder' => 'Keresztnév')) !!}
        </div>
    </div>

    <div class="form-group @if ($errors->has('sex')) has-error @endif">
        {!! Form::label('sex', 'Nem', array('class' => 'col-lg-2 control-label')) !!}
        <div class="col-lg-10">
            {!! Form::select('sex', array('' => 'Válassz nemet', 'Férfi' => 'Férfi', 'Nő' => 'Nő'), null, array('class' => 'form-control')) !!}
        </div>
    </div>

    <div class="form-group @if ($errors->has('birthday')) has-error @endif">
        {!! Form::label('birthday', 'Születési idő', array('class' => 'col-lg-2 control-label')) !!}
        <div class="col-lg-10">
            {!! Form::input('date','birthday', null, array('class' => 'form-control')) !!}
        </div>
    </div>

    <div class="form-group @if ($errors->has('country_id')) has-error @endif">
        {!! Form::label('country_id', 'Ország', array('class' => 'col-lg-2 control-label')) !!}
        <div class="col-lg-10">
            {!! Form::select('country_id', array('' => 'Válassz országot') + $countries, null, array('class' => 'form-control')) !!}
        </div>
    </div>

    <div class="form-group @if ($errors->has('club')) has-error @endif">
        {!! Form::label('club_id', 'Klub', array('class' => 'col-lg-2 control-label')) !!}
        <div class="col-lg-10">
            {!! Form::select('club_id', array('' => 'Válassz klubot') + $clubs, null, array('class' => 'form-control')) !!}
        </div>
    </div>

    <div class="form-group">
        <div class="col-lg-10 col-lg-offset-2">
            {!! Form::submit($submitButtonText, array('class' => 'btn btn-primary')) !!}
        </div>
    </div>

</fieldset>