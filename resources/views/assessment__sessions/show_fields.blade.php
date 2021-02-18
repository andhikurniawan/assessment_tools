 <!-- Assessment Session  -->
  <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Assessment Session</h6>
        </div>
        <div class="card-body">    
            <table class="table">
                <tbody>
                    <tr>
                        <td style="font-weight: bold;">Name</td>
                        <td>{{ $session->name }}</td>
                    <tr>
                    <tr>
                        <td style="font-weight: bold;">Category</td>
                        <td>{{ $session->category }}</td>
                    <tr>
                    <tr>
                        <td style="font-weight: bold;">Status</td>
                        <td>{{ $session->status }}</td>
                    <tr>
                    <tr>
                        <td style="font-weight: bold;">Start Date</td>
                        <td>{{ $session->start_date }}</td>
                    <tr>
                    <tr>
                        <td style="font-weight: bold;">End Date</td>
                        <td>{{ $session->end_date }}</td>
                    <tr>
                    <tr>
                        <td style="font-weight: bold;">Expired</td>
                        <td>{{ $session->expired }}</td>
                    <tr>
                </tbody>
            </table>
       
            </div>
         </div>

    <!-- Competency Model  -->
        <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Competency Models</h6>
        </div>
        <div class="card-body">    
            <table class="table text-center" id="tableModel">
                <thead>
                    <tr>    
                        <th>#</th>
                        <th>NAME</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($models as $key => $model)
                        <tr class="models">
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $model->name }}</td>
                        </tr>   
                    @endforeach
                </tbody>
            </table>
            </div>
         </div>

<!-- Mapping Participant  -->
        <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Mapping Participants</h6>
        </div>
        <div class="card-body">    
     
       <table class="table text-center" id="tableParticipant">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Assesor</th>     
                    <th>&nbsp;</th>                      
                </tr>
            </thead>
            <tbody id="tbody">
                @foreach($participants as $key => $participant)
                    <tr id="rowAssesse{{ $key }}" class="rowAssesse row_tbody">
                        <td>{{ $participant->name }}</td>
                        <td>{{ $participant->email }}</td>
                        <td><span class='badge' style="background-color: #4fd6a2; color:#ffffff">{{ count($participant->assessor) }}</span></td>                        <td><a data-toggle="collapse" href="#collapse{{ $key }}"><i class="fa fa-angle-double-down" style="font-size: 20px;"></i></a></td>
                    </tr>
                    <tr class="row_tbody">
                        <td colspan="3" style="padding: 0;">
                        <div id="collapse{{ $key }}" class="panel-collapse collapse">
                            <table class="table" style="margin-bottom: 10px;">
                                    <thead>
                                        <tr>
                                            <th>Nama</th>
                                            <th>Email</th>
                                            <th>Relationship</th>
                                            <th>Status</th>                        
                                        </tr>
                                    </thead>
                                    <tbody id="rowAssessor{{ $key }}">
                                        @foreach($participant->assessor as $assessor)
                                            <tr class="colAssessor">
                                                <td>{{ $assessor->name }}</td>
                                                <td>{{ $assessor->email }}</td>
                                                <td>{{ $assessor->relation }}</td>
                                                <td>{{ $assessor->status }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                            </table>
                        </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        </div>
    </div>

        <!-- Competency Model  -->
        <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Minimum-Gap Assignment</h6>
        </div>
        <div class="card-body">  
            <div class="block-options">
                <a class="nav-link" href="{!! route('assessmentSession.doAssignment', ['id' => $session->id]) !!}">
                    <i class="fa fa-fw fa-upload mr-5"></i> Run Optimization Assignment
                </a>
            </div>  
            <table class="table text-center">
            <thead>
                    <tr>
                        <th>#</th>
                        <th>Run Date</th>
                        <th>Is Effective</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($assignment as $key => $assignment)
                        <tr class="assignment">
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $assignment->run_date }}</td>
                            <td>{{ $assignment->is_effective }}</td>
                            <td>
                                {!! Form::open(['route' => ['assignmentHeaders.destroy', $assignment->id], 'method' => 'delete']) !!}
                                <div class='btn-group'>
                                    <a href="{{ route('assignmentHeaders.show', [$assignment->id]) }}" class='btn btn-primary'><span class="iconify" data-icon="bi:eye-fill" data-inline="false"></span></a>
                                    <a href="{{ route('assignmentHeaders.edit', [$assignment->id]) }}" class='btn btn-warning'><span class="iconify" data-icon="bx:bx-edit" data-inline="false"></span></a>
                                    {!! Form::button('<span class="iconify" data-icon="bi:trash" data-inline="false"></span>', ['type' => 'submit', 'class' => 'btn btn-danger', 'onclick' => "return confirm('Are you sure?')"]) !!}
                                </div>
                                {!! Form::close() !!}
                            </td>
                        </tr>   
                    @endforeach
                </tbody>
            </table>
            </div>
         </div>

    