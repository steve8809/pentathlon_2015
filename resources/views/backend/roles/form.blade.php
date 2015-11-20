<fieldset>
    <legend>{!! $legend !!}</legend>
    <div class="form-group @if ($errors->has('name')) has-error @endif">
        {!! Form::label('name', 'Név', array('class' => 'col-lg-2 control-label')) !!}
        <div class="col-lg-10">
            {!! Form::text('name', null , array('class' => 'form-control', 'placeholder' => 'Név')) !!}
        </div>
    </div>

    <div class="form-group @if ($errors->has('display_name')) has-error @endif">
        {!! Form::label('display_name', 'Megjelenített név', array('class' => 'col-lg-2 control-label')) !!}
        <div class="col-lg-10">
            {!! Form::text('display_name', null, array('class' => 'form-control', 'placeholder' => 'Megjenített név')) !!}
        </div>
    </div>

    <div class="form-group @if ($errors->has('description')) has-error @endif">
        {!! Form::label('description', 'Leírás', array('class' => 'col-lg-2 control-label')) !!}
        <div class="col-lg-10">
            {!! Form::textarea('description', null, array('class' => 'form-control', 'placeholder' => 'Leírás')) !!}
        </div>
    </div>

    <div class="form-group">
        <div class="col-lg-10 col-lg-offset-2">
            {!! Form::submit($submitButtonText, array('class' => 'btn btn-primary')) !!}
        </div>
    </div>

</fieldset>