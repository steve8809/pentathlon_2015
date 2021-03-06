<fieldset>
    <legend>{!! $legend !!}</legend>
    <ul class="list-group">
        <li class="list-group-item">Időeredmény megadása a következő formátumban: mm:ss.uu, pl.: 02:30.00 </li>
        <li class="list-group-item">Úszás hossza, kombinált hossza megadása méterben: pl. 200 m, 3200 m </li>

    </ul>
    <div class="form-group @if ($errors->has('swimming_time')) has-error @endif">
        {!! Form::label('swimming_time', 'Úszóidő 250 ponthoz', array('class' => 'col-lg-2 control-label')) !!}
        <div class="col-lg-10">
            {!! Form::text('swimming_time', null , array('class' => 'form-control masked_input')) !!}
        </div>
    </div>

    <div class="form-group @if ($errors->has('swimming_dist')) has-error @endif">
        {!! Form::label('swimming_dist', 'Úszás hossza', array('class' => 'col-lg-2 control-label')) !!}
        <div class="col-lg-10">
            {!! Form::text('swimming_dist', null, array('class' => 'form-control')) !!}
        </div>
    </div>

    <div class="form-group @if ($errors->has('ce_time')) has-error @endif">
        {!! Form::label('ce_time', 'Kombinált idő 500 ponthoz', array('class' => 'col-lg-2 control-label')) !!}
        <div class="col-lg-10">
            {!! Form::text('ce_time', null , array('class' => 'form-control masked_input')) !!}
        </div>
    </div>

    <div class="form-group @if ($errors->has('ce_dist')) has-error @endif">
        {!! Form::label('ce_dist', 'Kombinált hossza', array('class' => 'col-lg-2 control-label')) !!}
        <div class="col-lg-10">
            {!! Form::text('ce_dist', null, array('class' => 'form-control')) !!}
        </div>
    </div>

    <div class="form-group">
        <div class="col-lg-10 col-lg-offset-2">
            {!! Form::submit($submitButtonText, array('class' => 'btn btn-primary')) !!}
        </div>
    </div>

</fieldset>