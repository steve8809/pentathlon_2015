<fieldset>
    <legend>{!! $legend !!}</legend>

    <div class="form-group">
        {!! Form::label('last_name', 'Vezetéknév', array('class' => 'col-lg-2 control-label')) !!}
        <div class="col-lg-10">
            {!! Form::text('last_name', null , array('class' => 'form-control', 'placeholder' => 'Vezetéknév')) !!}
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('first_name', 'Keresztnév', array('class' => 'col-lg-2 control-label')) !!}
        <div class="col-lg-10">
            {!! Form::text('first_name', null , array('class' => 'form-control', 'placeholder' => 'Keresztnév')) !!}
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('sex', 'Neme', array('class' => 'col-lg-2 control-label')) !!}
        <div class="col-lg-10">
            {!! Form::select('sex', array('' => 'Válassz nemet', 'Férfi' => 'Férfi', 'Nő' => 'Nő'), null, array('class' => 'form-control')) !!}
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('birthday', 'Születési idő', array('class' => 'col-lg-2 control-label')) !!}
        <div class="col-lg-10">
            {!! Form::input('date','birthday', null, array('class' => 'form-control')) !!}
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('country_id', 'Ország', array('class' => 'col-lg-2 control-label')) !!}
        <div class="col-lg-10">
            {!! Form::select('country_id', array('' => 'Válassz országot') + $countries, null, array('class' => 'form-control')) !!}
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('club', 'Klub', array('class' => 'col-lg-2 control-label')) !!}
        <div class="col-lg-10">
            {!! Form::select('club', array('' => 'Válassz klubot') + $clubs, null, array('class' => 'form-control')) !!}
        </div>
    </div>

    <div class="form-group">
        <div class="col-lg-10 col-lg-offset-2">
            {!! Form::submit($submitButtonText, array('class' => 'btn btn-primary')) !!}
        </div>
    </div>

</fieldset>