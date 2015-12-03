<fieldset>
    <legend>{!! $legend !!}</legend>

    <div class="form-group @if ($errors->has('name')) has-error @endif">
        {!! Form::label('name', 'Név', array('class' => 'col-lg-2 control-label')) !!}
        <div class="col-lg-10">
            {!! Form::text('name', null , array('class' => 'form-control', 'placeholder' => 'Verseny neve')) !!}
        </div>
    </div>

    <div class="form-group @if ($errors->has('country_id')) has-error @endif">
        {!! Form::label('country_id', 'Ország', array('class' => 'col-lg-2 control-label')) !!}
        <div class="col-lg-10">
            {!! Form::select('country_id', array('' => 'Válassz országot') + $countries, null, array('class' => 'form-control')) !!}
        </div>
    </div>

    <div class="form-group @if ($errors->has('town')) has-error @endif">
        {!! Form::label('town', 'Város', array('class' => 'col-lg-2 control-label')) !!}
        <div class="col-lg-10">
            {!! Form::text('town', null , array('class' => 'form-control', 'placeholder' => 'Város')) !!}
        </div>
    </div>

    <div class="form-group @if ($errors->has('host')) has-error @endif">
        {!! Form::label('host', 'Rendező', array('class' => 'col-lg-2 control-label')) !!}
        <div class="col-lg-10">
            {!! Form::text('host', null , array('class' => 'form-control', 'placeholder' => 'Rendező')) !!}
        </div>
    </div>

    <div class="form-group @if ($errors->has('date')) has-error @endif">
        {!! Form::label('date', 'Dátum', array('class' => 'col-lg-2 control-label')) !!}
        <div class="col-lg-10">
            {!! Form::input('date','date', null, array('class' => 'form-control')) !!}
        </div>
    </div>

    <div class="form-group @if ($errors->has('category')) has-error @endif">
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