<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Student</title>
</head>
<body>
    <h1>Edit a Student</h1>
    <div>
        @if($errors->any())
        <ul>
            @foreach($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
        @endif
    </div>
    <form method="post" action="{{route('student.update', ['student' => $student])}}" enctype="multipart/form-data">
        @csrf 
        @method('put')
        <div>
            <label>Student ID</label>
            <input type="text" name="studentId" placeholder="Student ID" value="{{$student->studentId}}" />
        </div>
        <div>
            <label>Name</label>
            <input type="text" name="name" placeholder="Name" value="{{$student->name}}" />
        </div>
        <div>
            <label>Age</label>
            <input type="text" name="age" placeholder="Age" value="{{$student->age}}" />
        </div>
        <div>
            <label>Current Image</label><br>
            @if($student->image)
                <img src="{{ asset('storage/images/'.$student->image) }}" alt="Student Image">
                <br>
                <span>Current Image: {{ $student->image }}</span>
            @else
                <span>No image uploaded</span>
            @endif
        </div>
        <div>
            <label>New Image</label>
            <input type="file" name="image" accept="image/*" />
        </div>
        <div>
            <label>Status</label>
            <input type="text" name="status" placeholder="Status" value="{{$student->status}}" />
        </div>
        <div>
            <input type="submit" value="Update" />
        </div>
    </form>
</body>
</html>
