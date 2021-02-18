<!-- Run Counter Field -->
<div class="form-group col-sm-6">
    {!! Form::label('run_counter', 'Run Counter:') !!}
    {!! Form::number('run_counter', null, ['class' => 'form-control']) !!}
</div>

<!-- Run Date Field -->
<div class="form-group col-sm-6">
    {!! Form::label('run_date', 'Run Date:') !!}
    {!! Form::date('run_date', null, ['class' => 'form-control','id'=>'run_date']) !!}
</div>

@section('scripts')
    <script type="text/javascript">
        $('#run_date').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: false
        })
    </script>
@endsection

<!-- Is Effective Field -->
<div class="form-group col-sm-12">
    {!! Form::label('is_effective', 'Is Effective:') !!}
    <label class="radio-inline">
        {!! Form::radio('is_effective', "1", null) !!} Yes
    </label>

    <label class="radio-inline">
        {!! Form::radio('is_effective', "0", null) !!} No
    </label>

</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('assignmentHeaders.index') !!}" class="btn btn-default">Cancel</a>
</div>
