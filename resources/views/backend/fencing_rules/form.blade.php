<fieldset>
    <legend>{!! $legend !!}</legend>
    
    <div class="form-group @if ($errors->has('bouts_250')) has-error @endif">
        {!! Form::label('bouts_250', '250 ponthoz szükséges tusok száma', array('class' => 'col-lg-2 control-label')) !!}
        <div class="col-lg-10">
            {!! Form::number('bouts_250', null , array('class' => 'form-control')) !!}
        </div>
    </div>

    <div class="form-group @if ($errors->has('victory_points')) has-error @endif">
        {!! Form::label('victory_points', 'Győzelem pontszáma', array('class' => 'col-lg-2 control-label')) !!}
        <div class="col-lg-10">
            {!! Form::number('victory_points', null , array('class' => 'form-control')) !!}
        </div>
    </div>

    <div class="form-group">
        <div class="col-lg-10 col-lg-offset-2">
            {!! Form::submit($submitButtonText, array('class' => 'btn btn-primary')) !!}
        </div>
    </div>

</fieldset>