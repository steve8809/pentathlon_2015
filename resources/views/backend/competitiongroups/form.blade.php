<fieldset>
    <legend>{!! $legend !!}</legend>

    <div class="form-group">
        {!! Form::label('name', 'Csoport neve', array('class' => 'col-lg-2 control-label')) !!}
        <div class="col-lg-10">
            {!! Form::text('name', null , array('class' => 'form-control', 'placeholder' => 'Verseny neve')) !!}
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('competition_id', 'Verseny', array('class' => 'col-lg-2 control-label')) !!}
        <div class="col-lg-10">
            {!! Form::select('competition_id', array('' => 'Válassz versenyt') + $competitions, null, array('class' => 'form-control')) !!}
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('date', 'Dátum', array('class' => 'col-lg-2 control-label')) !!}
        <div class="col-lg-10">
            {!! Form::input('date','date', date('Y-m-d'), array('class' => 'form-control')) !!}
        </div>
    </div>


    <div class="form-group">
        {!! Form::label('type', 'Típus', array('class' => 'col-lg-2 control-label')) !!}
        <div class="col-lg-10">
            {!! Form::select('type', array('' => 'Válassz típust', 'Selejtező' => 'Selejtező', 'Döntő' => 'Döntő'), null, array('class' => 'form-control')) !!}
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('age_group', 'Korosztály', array('class' => 'col-lg-2 control-label')) !!}
        <div class="col-lg-10">
            {!! Form::select('age_group', array('' => 'Válassz korosztályt') + $age_groups, null, array('class' => 'form-control')) !!}
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('sex', 'Nem', array('class' => 'col-lg-2 control-label')) !!}
        <div class="col-lg-10">
            {!! Form::select('sex', array('' => 'Válassz nemet', 'Férfi' => 'Férfi', 'Nő' => 'Nő'), null, array('class' => 'form-control')) !!}
        </div>
    </div>

    <div class="form-group">
        <div class="col-lg-10 col-lg-offset-2">
            {!! Form::submit($submitButtonText, array('class' => 'btn btn-primary')) !!}
        </div>
    </div>

</fieldset>