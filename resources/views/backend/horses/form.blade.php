<fieldset>
    <legend>{!! $legend !!}</legend>

    <div class="form-group">
        {!! Form::label('name', 'Név', array('class' => 'col-lg-2 control-label')) !!}
        <div class="col-lg-10">
            {!! Form::text('name', null , array('class' => 'form-control', 'placeholder' => 'Név')) !!}
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('sex', 'Neme', array('class' => 'col-lg-2 control-label')) !!}
        <div class="col-lg-10">
            {!! Form::select('sex', array('' => 'Válassz nemet', 'Mén' => 'Mén', 'Kanca' => 'Kanca', 'Herélt' => 'Herélt'), null, array('class' => 'form-control')) !!}
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('colour', 'Szín', array('class' => 'col-lg-2 control-label')) !!}
        <div class="col-lg-10">
            {!! Form::select('colour', array('' => 'Válassz színt', 'Szürke' => 'Szürke', 'Fakó' => 'Fakó', 'Pej' => 'Pej', 'Fekete' => 'Fekete', 'Sárga' => 'Sárga'), null, array('class' => 'form-control')) !!}
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('age', 'Kor', array('class' => 'col-lg-2 control-label')) !!}
        <div class="col-lg-10">
            {!! Form::selectRange('age', 1, 50, null, array('class' => 'form-control')) !!}
        </div>
    </div>

    <div class="form-group">
        <div class="col-lg-10 col-lg-offset-2">
            {!! Form::submit($submitButtonText, array('class' => 'btn btn-primary')) !!}
        </div>
    </div>

</fieldset>