<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Student</h1>
    <div>
        @if(session()->has('success'))
            <div>
                {{ session('success') }}
            </div>
        @endif
    </div>
    <div>
        <div>
            <a href="{{ route('student.create') }}">Create a student</a>
        </div>
        <table border="1">
            <tr>
                <th>ID</th>
                <th>Student ID</th>
                <th>Name</th>
                <th>Age</th>
                <th>Image</th>
                <th>Status</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            @foreach($students as $student)
                <tr>
                    <td>{{ $student->id }}</td>
                    <td>{{ $student->studentId }}</td>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->age }}</td>
                    <!-- Display the image using an <img> tag -->
                    <td>
                        @if($student->image)
                            <img src="{{ asset('storage/images/' . $student->image) }}" alt="Student Image" width="100">
                        @else
                            No Image
                        @endif
                    </td>
                    <td>{{ $student->status }}</td>
                    <td>
                        <a href="{{ route('student.edit', ['student' => $student]) }}">Edit</a>
                    </td>
                    <td>
                        <form method="post" action="{{ route('student.destroy', ['student' => $student]) }}">
                            @csrf 
                            @method('delete')
                            <input type="submit" value="Delete" />
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
</body>
</html>
