<fieldset>
    <legend>{!! $legend !!}</legend>

    <div class="form-group">
        {!! Form::label('name', 'Verseny neve', array('class' => 'col-lg-2 control-label')) !!}
        <div class="col-lg-10">
            {!! Form::text('name', null , array('class' => 'form-control', 'placeholder' => 'Verseny neve')) !!}
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('country_id', 'Ország', array('class' => 'col-lg-2 control-label')) !!}
        <div class="col-lg-10">
            {!! Form::select('country_id', array('' => 'Válassz országot') + $countries, null, array('class' => 'form-control')) !!}
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('town', 'Város', array('class' => 'col-lg-2 control-label')) !!}
        <div class="col-lg-10">
            {!! Form::text('town', null , array('class' => 'form-control', 'placeholder' => 'Város')) !!}
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('host', 'Rendező', array('class' => 'col-lg-2 control-label')) !!}
        <div class="col-lg-10">
            {!! Form::text('host', null , array('class' => 'form-control', 'placeholder' => 'Rendező')) !!}
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('start_date', 'Verseny kezdete', array('class' => 'col-lg-2 control-label')) !!}
        <div class="col-lg-10">
            {!! Form::input('date','start_date', date('Y-m-d'), array('class' => 'form-control')) !!}
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('end_date', 'Verseny vége', array('class' => 'col-lg-2 control-label')) !!}
        <div class="col-lg-10">
            {!! Form::input('date','end_date', date('Y-m-d'), array('class' => 'form-control')) !!}
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('category', 'Kategória', array('class' => 'col-lg-2 control-label')) !!}
        <div class="col-lg-10">
            {!! Form::select('category', array('' => 'Válassz kategóriát') + $categories , null, array('class' => 'form-control')) !!}
        </div>
    </div>

    <div class="form-group">
        <div class="col-lg-10 col-lg-offset-2">
            {!! Form::submit($submitButtonText, array('class' => 'btn btn-primary')) !!}
        </div>
    </div>

</fieldset>