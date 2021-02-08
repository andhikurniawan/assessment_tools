@extends('main')

@section('title', 'Optimization Team')

@section('AssignmentHeader', 'active')

@section('content')
    <section class="content-header">
        <h1>
            Assignment
        </h1>
    </section>

    <div class="block">
        <div class="block-content">
            <table class="table table-striped">
                <tr>
                    <td>#{!! $assignmentHeader->id !!}  {!! (empty($assignmentHeader->assessmentSession)?'-':$assignmentHeader->assessmentSession->name) !!}</td>
                </tr>
                <tr>
                    <th>Run Counter</th>
                    <td>{!! $assignmentHeader->run_counter !!}</td>
                </tr>
                <tr>
                    <th>Run Date</th>
                    <td>{!! $assignmentHeader->run_date !!} </td>
                </tr>
                <tr>
                    <th>Is Effective</th>
                    <td>{!! $assignmentHeader->is_effective !!} </td>
                </tr>
            </table>

            <div class="clearfix"></div>

            @include('flash::message')

            <div class="clearfix"></div>
            
            @include('assignment_results.table')
            <div class="text-center">
            
            </div>
        </div>
    </div>

@endsection
