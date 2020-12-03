<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', 'Name:') !!}
    <p>{{ $assessmentSession->name }}</p>
</div>

<!-- Category Field -->
<div class="form-group">
    {!! Form::label('category', 'Category:') !!}
    <p>{{ $assessmentSession->category }}</p>
</div>

<!-- Status Field -->
<div class="form-group">
    {!! Form::label('status', 'Status:') !!}
    <p>{{ $assessmentSession->status }}</p>
</div>

<!-- Expired Field -->
<div class="form-group">
    {!! Form::label('expired', 'Expired:') !!}
    <p>{{ $assessmentSession->expired }}</p>
</div>

<!-- Start Date Field -->
<div class="form-group">
    {!! Form::label('start_date', 'Start Date:') !!}
    <p>{{ $assessmentSession->start_date }}</p>
</div>

<!-- End Date Field -->
<div class="form-group">
    {!! Form::label('end_date', 'End Date:') !!}
    <p>{{ $assessmentSession->end_date }}</p>
</div>

<!-- Company Id Field -->
<div class="form-group">
    {!! Form::label('company_id', 'Company Id:') !!}
    <p>{{ $assessmentSession->company_id }}</p>
</div>

<!-- Competencygroup Id Field -->
<div class="form-group">
    {!! Form::label('competencygroup_id', 'Competencygroup Id:') !!}
    <p>{{ $assessmentSession->competencygroup_id }}</p>
</div>

