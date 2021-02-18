<div class="row">
        <div class="col">
            <div>
            <br>
                <!-- Code Field -->
                <div class="form-group col-sm-12">
                {!! Form::label('code', 'Kode:') !!}
                {!! Form::text('code', null, ['class' => 'form-control']) !!}
                </div>

    <!-- Name Field -->
<div class="form-group col-sm-12">
    {!! Form::label('name', 'Nama Kompetensi:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-12">
    {!! Form::label('description', 'Deskripsi:') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
</div>

                <!-- Status  Field -->
<div class="form-group col-sm-12">
    {!! Form::label('status', 'Status:') !!}
    {!! Form::select('status', array('public' => 'Public', 'private' => 'Private'), null, ['class' => 'form-control']) !!}
</div>


            </div>
        </div>
        <div class="col-sm-auto">
            <div>
            <br>




               
<!-- Type Field -->
<div class="form-group col-sm-12">
    {!! Form::label('type', 'Tipe Kompetensi:') !!}
    {!! Form::select('type', array('soft_skill  ' => 'Soft Skill', 'hard_skill' => 'Hard Skill'), null, ['class' => 'form-control']) !!}
</div>


<!-- Perusahaan Field -->
<div class="form-group col-sm-12">
{!! Form::label('competency_group_id', 'Grup Kompetensi:') !!}  
{!! Form::select('competency_group_id',$competencyGroup,'', ['class' => 'form-control']) !!}
</div>



<!-- Question Field -->
<div class="form-group col-sm-12">
    {!! Form::label('question', 'Pertanyaan:') !!}
    {!! Form::textarea('question', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-12">
    {!! Form::label('jenis', 'Jenis:') !!}
    {!! Form::select('jenis', array('core' => 'Kompetensi Utama', 'secondary' => 'Kompetensi Pendukung'), null, ['class' => 'form-control']) !!}
</div>

                
            </div>
        </div>
    </div>


<div class="row">
<div class="col">
            <div>
            <br>
               <!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-success']) !!}
    <a href="{{ route('competencies.index') }}" class="btn btn-danger">Cancel</a>
</div> 
                </div>
        </div>
      
    </div>




