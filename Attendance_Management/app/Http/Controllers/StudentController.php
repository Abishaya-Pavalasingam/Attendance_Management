<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\student;
use App\Models\Role;
use App\Models\Schedule;
use App\Http\Requests\studentRec;
use RealRashid\SweetAlert\Facades\Alert;

class StudentController extends Controller
{
   
    public function index()
    {
        
        return view('admin.student')->with(['students'=> Student::all(), 'schedules'=>Schedule::all()]);
    }

    public function store(StudentRec $request)
    {
        $request->validated();

        $student = new Student;
        $student->name = $request->name;
        $student->position = $request->position;
        $student->email = $request->email;
        $student->pin_code = bcrypt($request->pin_code);
        $student->save();

        if($request->schedule){

            $schedule = Schedule::whereSlug($request->schedule)->first();

            $student->schedules()->attach($schedule);
        }

        // $role = Role::whereSlug('emp')->first();

        // $student->roles()->attach($role);

        flash()->success('Success','Student Record has been created successfully !');

        return redirect()->route('students.index')->with('success');
    }

 
    public function update(StudentRec $request, Student $student)
    {
        $request->validated();

        $student->name = $request->name;
        $student->position = $request->position;
        $student->email = $request->email;
        $student->pin_code = bcrypt($request->pin_code);
        $student->save();

        if ($request->schedule) {

            $student->schedules()->detach();

            $schedule = Schedule::whereSlug($request->schedule)->first();

            $student->schedules()->attach($schedule);
        }

        flash()->success('Success','student Record has been Updated successfully !');

        return redirect()->route('students.index')->with('success');
    }


    public function destroy(Student $student)
    {
        $student->delete();
        flash()->success('Success','student Record has been Deleted successfully !');
        return redirect()->route('students.index')->with('success');
    }
}
