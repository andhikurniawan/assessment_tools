<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', 'Name:') !!}
    <p>{{ $company->name }}</p>
</div>

<!-- Address Field -->
<div class="form-group">
    {!! Form::label('address', 'Address:') !!}
    <p>{{ $company->address }}</p>
</div>

<!-- Telp Field -->
<div class="form-group">
    {!! Form::label('telp', 'Telp:') !!}
    <p>{{ $company->telp }}</p>
</div>

<!-- Fax Field -->
<div class="form-group">
    {!! Form::label('fax', 'Fax:') !!}
    <p>{{ $company->fax }}</p>
</div>

<!-- Email Field -->
<div class="form-group">
    {!! Form::label('email', 'Email:') !!}
    <p>{{ $company->email }}</p>
</div>

<!-- Contact Person Field -->
<div class="form-group">
    {!! Form::label('contact_person', 'Contact Person:') !!}
    <p>{{ $company->contact_person }}</p>
</div>

<!-- Description Field -->
<div class="form-group">
    {!! Form::label('description', 'Description:') !!}
    <p>{{ $company->description }}</p>
</div>

