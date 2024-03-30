<?php
namespace App\Services;

use App\Models\Student;

class StudentService
{
    public function addStudent(array $data)
    {
        return Student::create($data);
    }

    public function updateStudent(Student $student, array $data)
    {
        $student->update($data);
    }

    public function deleteStudent(Student $student)
    {
        $student->delete();
    }
}
