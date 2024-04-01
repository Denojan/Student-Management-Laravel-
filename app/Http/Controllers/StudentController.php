<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

use App\Models\Student;
use Illuminate\Support\Facades\Log;
use App\Facades\StudentFacade;
use Inertia\Inertia;
use Illuminate\Http\Request;
class StudentController extends Controller
{

    public function index()
    {
        $studentsData = [];
        $students = Student::all();
    
        foreach ($students as $student) {
            $studentsData[] = [
                'id'  => $student->id,
                'studentId' => $student->studentId,
                'name' => $student->name,
                'age' => $student->age,
                'status' => $student->status,
                'image' => $student->image,
            ];
        }
    Log::info($studentsData);
        return Inertia::render('Student/Index', [
            'students' => $studentsData,
        ]);
    }

    
   
    public function create(){
        return view('students.create');
    }

    public function store(Request $request){
        // Log specific data from the request
        Log::info('Request data:', $request->all());
    
        // Validate the request data
        $validatedData = $request->validate([
            'studentId' => 'required|unique:students',
            'name' => 'required',
            'age' => 'required|integer',
            'image' => 'nullable|image|max:2048', // Max size of 2MB for image uploads
            'status' => 'required',
        ]);
    
        // Handle the image upload if an image is provided
        if ($request->hasFile('image')) {
            // Get the uploaded file
            $image = $request->file('image');
    
            // Store the uploaded file in the 'public/images' directory
            // and generate a unique filename for it
            $imagePath = $image->store('public/images');
    
            // Extract the filename from the full path
            $filename = basename($imagePath);
    
            // Update the validated data with the image filename
            $validatedData['image'] = $filename;
        }
    
        // Create a new student record in the database
        $newStudent = StudentFacade::addStudent($validatedData);
    
        return redirect(route('student.index'));
    }
    

    public function edit(Student $student){
        return view('students.edit', ['student' => $student]);
    }
    // public function edit(Student $student)
    // {   
    //     return Inertia::render('Student/Edit', ['student' => $student]);
    // }

    public function update(Student $student, Request $request) {
        // Log the student
        Log::info($student);
    
        // Validate the request data
        $validatedData = $request->validate([
            'studentId' => 'required|unique:students,studentId,' . $student->studentId,
            'name' => 'required',
            'age' => 'required|integer',
            'image' => 'nullable|image|max:2048',
            'status' => 'required'
        ]);
    
        if ($request->hasFile('image')) {
            // Get the uploaded file
            $image = $request->file('image');
    
            // Store the uploaded file in the 'public/images' directory
            // and generate a unique filename for it
            $imagePath = $image->store('public/images');
    
            // Extract the filename from the full path
            $filename = basename($imagePath);
    
            // Update the validated data with the image filename
            $validatedData['image'] = $filename;
        }
    
        // Update the student using the StudentFacade
        StudentFacade::updateStudent($student, $validatedData);
    
        // Redirect back with success message
        return redirect(route('student.index'))->with('success', 'Student Updated Successfully');
    }
    

    public function destroy(Student $student){
       
       StudentFacade::deleteStudent($student);
        return view('students.index')->with('success', 'Student deleted Succesffully');
    }
}
