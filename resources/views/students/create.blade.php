<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create a Student</title>
</head>
<body>
    <h1>Create a Student</h1>
    <div>
        @if($errors->any())
        <ul>
            @foreach($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
        @endif
    </div>
    <form method="post" action="{{route('student.store')}}" enctype="multipart/form-data">
        @csrf 
        <div>
            <label>Student ID</label>
            <input type="text" name="studentId" placeholder="ID" />
        </div>
        <div>
            <label>Name</label>
            <input type="text" name="name" placeholder="Name" />
        </div>
        <div>
            <label>Age</label>
            <input type="text" name="age" placeholder="Age" />
        </div>
        <div>
            <label>Image</label>
            <input type="file" name="image" accept="image/*" />
        </div>
        <div>
            <label>Status</label>
            <input type="text" name="status" placeholder="Status" />
        </div>
        <div>
            <input type="submit" value="Save a New Student" />
        </div>
    </form>
</body>
</html>
