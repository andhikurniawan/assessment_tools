<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', 'Name:') !!}
    <p>{{ $roles->name }}</p>
</div>

<!-- Is Admin Field -->
<div class="form-group">
    {!! Form::label('is_admin', 'Is Admin:') !!}
    <p>{{ $roles->is_admin }}</p>
</div>

<!-- Is Superadmin Field -->
<div class="form-group">
    {!! Form::label('is_superadmin', 'Is Superadmin:') !!}
    <p>{{ $roles->is_superadmin }}</p>
</div>

