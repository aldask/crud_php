<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        return view('students', ['students' => Student::all()]);
    }

    public function show($id)
    {
        return view('student', ['student' => Student::find($id)]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'fname' => 'required|max:32'
        ]);

        $newEmp = new Student();
        $newEmp->name = $request['fname'];
        $newEmp->project_id = $request['assign_proj'];
        if ($newEmp->name === NULL) {
            return redirect('/students')->with('status_error', 'Student addition failed.');
        }
        return ($newEmp->save() == 1)
            ? redirect('/students')->with('status_success', 'Student added successfully!')
            : redirect('/students')->with('status_error', 'Student addition failed.');
    }

    public function destroy($id)
    {
        Student::destroy($id);
        return redirect('/students')->with('status_success', 'Student deleted!');
    }

    public function update($id, Request $request)
    {
        $this->validate($request, [
            'fname' => 'required|max:32',
        ]);
        $up_emp = Student::find($id);
        $up_emp->name = $request['fname'];
        $up_emp->project_id = $request['assign_proj'];
        if ($up_emp->name === NULL) {
            return redirect('/students')->with('status_error', 'Student addition failed.');
        }
        return ($up_emp->save() == 1) ?
            redirect('/students')->with('status_success', 'Student info updated!') :
            redirect('/students')->with('status_error', 'Student info update failed.');
    }
}
