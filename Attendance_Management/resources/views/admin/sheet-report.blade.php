@extends('layouts.master')
@section('content')

    <div class="card">
        <div class="card-header bg-success text-white">
            Attendance View
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-sm" id="printTable">
                    <thead>
                        <tr >

                            <th>Students Name</th>
                            <th>Students Subject</th>
                            <th>Students ID</th>
                            @php
                                $today = today();
                                $dates = [];
                                
                                for ($i = 1; $i < $today->daysInMonth + 1; ++$i) {
                                    $dates[] = \Carbon\Carbon::createFromDate($today->year, $today->month, $i)->format('Y-m-d');
                                }
                                
                            @endphp
                            @foreach ($dates as $date)
                            <th style="">
                            
                                
                                    {{ $date }}
                            
                        </th>
                      

                            @endforeach

                        </tr>
                    </thead>

                    <tbody>





                        @foreach ($students as $student)

                            <input type="hidden" name="emp_id" value="{{ $student->id }}">

                            <tr>
                                <td>{{ $student->name }}</td>
                                <td>{{ $student->position }}</td>
                                <td>{{ $student->id }}</td>






                                @for ($i = 1; $i < $today->daysInMonth + 1; ++$i)


                                    @php
                                        
                                        $date_picker = \Carbon\Carbon::createFromDate($today->year, $today->month, $i)->format('Y-m-d');
                                        
                                        $check_attd = \App\Models\Attendance::query()
                                            ->where('stu_id', $student->id)
                                            ->where('attendance_date', $date_picker)
                                            ->first();
                                        
                                        $check_leave = \App\Models\Leave::query()
                                            ->where('stu_id', $student->id)
                                            ->where('leave_date', $date_picker)
                                            ->first();
                                        
                                    @endphp
                                    <td>

                                        <div class="form-check form-check-inline ">

                                            @if (isset($check_attd))
                                                 @if ($check_attd->status==1)
                                                 <i class="fa fa-check text-success"></i>
                                                 @else
                                                 <i class="fa fa-check text-danger"></i>
                                                 @endif
                                               
                                            @else
                                            <i class="fas fa-times text-danger"></i>
                                            @endif
                                        </div>
                                        <div class="form-check form-check-inline">
                                          
                                            @if (isset($check_leave))
                                            @if ($check_leave->status==1)
                                            <i class="fa fa-check text-success"></i>
                                            @else
                                            <i class="fa fa-check text-danger"></i>
                                            @endif
                                          
                                       @else
                                       <i class="fas fa-times text-danger"></i>
                                       @endif
                                        

                                        </div>

                                    </td>

                                @endfor
                            </tr>
                        @endforeach





                    </tbody>


                </table>
            </div>
        </div>
    </div>
@endsection
