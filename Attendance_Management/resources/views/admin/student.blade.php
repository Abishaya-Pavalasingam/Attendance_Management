@extends('layouts.master')

@section('css')
@endsection

@section('breadcrumb')
<div class="col-sm-6">
    <h4 class="page-title text-left">Students</h4>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0);">Home</a></li>
        <li class="breadcrumb-item"><a href="javascript:void(0);">Students</a></li>
        <li class="breadcrumb-item"><a href="javascript:void(0);">Students List</a></li>
  
    </ol>
</div>
@endsection
@section('button')
<a href="#addnew" data-toggle="modal" class="btn btn-success btn-sm btn-flat"><i class="mdi mdi-plus mr-2"></i>Add</a>
        

@endsection

@section('content')
@include('includes.flash')
<!--Show Validation Errors here-->
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<!--End showing Validation Errors here-->


                      <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                                <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        
                                                    <thead>
                                                    <tr>
                                                        <th data-priority="1">Students ID</th>
                                                        <th data-priority="2">Name</th>
                                                        <th data-priority="3">RegNo</th>
                                                        <th data-priority="4">Email</th>
                                                        <th data-priority="5">Course</th>
                                                        
                                                        <th data-priority="7">Actions</th>
                                                     
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach( $students as $student)

                                                        <tr>
                                                            <td>{{$student->id}}</td>
                                                            <td>{{$student->name}}</td>
                                                            <td>{{$student->position}}</td>
                                                            <td>{{$student->email}}</td>
                                                            <td>
                                                                @if(isset($student->schedules->first()->slug))
                                                                {{$student->schedules->first()->slug}}
                                                                @endif
                                                            </td>
                                                           
                                                            <td>
                        
                                                                <a href="#edit{{$student->name}}" data-toggle="modal" class="btn btn-success btn-sm edit btn-flat"><i class='fa fa-edit'></i> Edit</a>
                                                                <a href="#delete{{$student->name}}" data-toggle="modal" class="btn btn-danger btn-sm delete btn-flat"><i class='fa fa-trash'></i> Delete</a>
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                   
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div> <!-- end row -->    
                                    

@foreach( $students as $student)
@include('includes.edit_delete_student')
@endforeach

@include('includes.add_student')

@endsection


@section('script')
<!-- Responsive-table-->

@endsection