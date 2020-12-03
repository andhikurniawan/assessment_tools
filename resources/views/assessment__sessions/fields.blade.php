<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Assessment Session Name', 'id'=>'name']) !!}
</div>

<!-- Category Field -->
<div class="form-group col-sm-6">
    {!! Form::label('category', 'Category:') !!}
    {!! Form::select('category',['development' => 'development', 'management' => 'management', 'project_manager' => 'project_manager'] ,null, ['class' => 'form-control', 'placeholder' => 'Select Category']) !!}
</div>

<!-- Status Field -->
<div class="form-group col-sm-6">
    {!! Form::label('status', 'Status:') !!}
    {!! Form::select('status',['open' => 'open', 'not_started' => 'not_started', 'finished' => 'finished']  ,null, ['class' => 'form-control', 'placeholder' => 'Select Status']) !!}
</div>

<!-- Expired Field -->
<div class="form-group col-sm-6">
    {!! Form::label('expired', 'Expired:') !!}
    {!! Form::select('expired',['one_year' => 'one_year', 'six_month' => 'six_month', 'three_month' => 'three_month'] ,null, ['class' => 'form-control', 'placeholder' => 'Select Expired']) !!}
</div>

<div class="form-group"> 

    <!-- Company Id Field -->
<div class="col-sm-6">
    {!! Form::label('company_id', 'Company:') !!}
    {!! Form::select('company_id', $company ,null, ['class' => 'form-control', 'placeholder' => 'Select Company']) !!}
</div>

<!-- Start Date Field -->
<div class="col-sm-3">
    {!! Form::label('start_date', 'Start Date:') !!}
    {!! Form::date('start_date', null, ['class' => 'form-control','id'=>'start_date']) !!}
</div>

<!-- End Date Field -->
<div class="col-sm-3">
    {!! Form::label('end_date', 'End Date:') !!}
    {!! Form::date('end_date', null, ['class' => 'form-control','id'=>'end_date']) !!}
</div>
</div>


