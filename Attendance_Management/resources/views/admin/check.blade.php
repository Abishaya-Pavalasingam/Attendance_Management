@extends('layouts.master')

@section('css')
    <!-- Table css -->
    <link href="{{ URL::asset('plugins/RWD-Table-Patterns/dist/css/rwd-table.min.css') }}" rel="stylesheet"
        type="text/css" media="screen">
@endsection


@section('content')

    <div class="card">

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-responsive table-bordered table-sm">
                    <thead>
                        <tr>

                            <th>Student Name</th>
                            <th>Student Position</th>
                            <th>Student ID</th>
                            @php
                                $today = today();
                                $dates = [];
                                
                                for ($i = 1; $i < $today->daysInMonth + 1; ++$i) {
                                    $dates[] = \Carbon\Carbon::createFromDate($today->year, $today->month, $i)->format('Y-m-d');
                                }
                                
                            @endphp
                            @foreach ($dates as $date)
                                <th>
                                    {{ $date }}
                                </th>

                            @endforeach

                        </tr>
                    </thead>

                    <tbody>


                        <form action="{{ route('check_store') }}" method="post">
                           
                            <button type="submit" class="btn btn-success" style="display: flex; margin:10px">submit</button>
                            @csrf
                            @foreach ($Students as $student)

                                <input type="hidden" name="stu_id" value="{{ $student->id }}">

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

                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" id="check_box"
                                                    name="attd[{{ $date_picker }}][{{ $student->id }}]" type="checkbox"
                                                    @if (isset($check_attd))  checked @endif id="inlineCheckbox1" value="1">

                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" id="check_box"
                                                    name="leave[{{ $date_picker }}][{{ $student->id }}]]" type="checkbox"
                                                    @if (isset($check_leave))  checked @endif id="inlineCheckbox2" value="1">

                                            </div>

                                        </td>

                                    @endfor
                                </tr>
                            @endforeach

                        </form>


                    </tbody>


                </table>
            </div>
        </div>
    </div>
@endsection




