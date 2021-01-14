<!-- Name Field -->
<div class="row">
<div class="form-group col">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Assessment Session Name', 'id'=>'name']) !!}
</div>

<!-- Category Field -->
<div class="form-group col">
    {!! Form::label('category', 'Category:') !!}
    {!! Form::select('category',['development' => 'development', 'management' => 'management', 'project_manager' => 'project_manager'] ,null, ['class' => 'form-control', 'placeholder' => 'Select Category']) !!}
</div>
</div>

<!-- Status Field -->
<div class="row">
<div class="form-group col">
    {!! Form::label('status', 'Status:') !!}
    {!! Form::select('status',['open' => 'open', 'not_started' => 'not_started', 'finished' => 'finished']  ,null, ['class' => 'form-control', 'placeholder' => 'Select Status']) !!}
</div>

<!-- Expired Field -->
<div class="form-group col">
    {!! Form::label('expired', 'Expired:') !!}
    {!! Form::select('expired',['one_year' => 'one_year', 'six_month' => 'six_month', 'three_month' => 'three_month'] ,null, ['class' => 'form-control', 'placeholder' => 'Select Expired']) !!}
</div>
</div>

<div class="form-group"> 

    
<div class="row mb-3">
<!-- Start Date Field -->
<div class="col">
    {!! Form::label('start_date', 'Start Date:') !!}
    {!! Form::date('start_date', null, ['class' => 'form-control','id'=>'start_date']) !!}
</div>

<!-- End Date Field -->

<div class="col">
    {!! Form::label('end_date', 'End Date:') !!}
    {!! Form::date('end_date', null, ['class' => 'form-control','id'=>'end_date']) !!}
</div>
</div>
<!-- Company Id Field -->
<div class="row">
<div class="col">
<label for="company_id">Company</label>
                    <select class="form-control" id="company_id" name="company_id">
                        @foreach ($company as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
</div>
<div class="col">
   
</div>
</div>
</div>


