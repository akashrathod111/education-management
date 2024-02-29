@extends('admin.index')
@section('content')

    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Edit Teacher</h4>

                        <form id="addteacherForm" action="{{ route('teacher.update',$teacher->id) }}" method="POST" onsubmit="return validateForm()">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="exampleInputUsername1">Name</label>
                                <input type="text" class="form-control" name="name" placeholder="Name" value="{{ $teacher->user->name }}">
                                <span id="nameError" style="color: red;"></span>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email</label>
                                <input type="email" class="form-control" name="email" placeholder="Email" value="{{ $teacher->user->email }}">
                                <span id="emailError" style="color: red;"></span>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Password</label>
                                <input type="password" class="form-control" name="password" placeholder="Password">
                                <span id="passwordError" style="color: red;"></span>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Conform Password</label>
                                <input type="password" class="form-control" name="conform-password" placeholder="Conform Password">
                                <span id="conformPasswordError" style="color: red;"></span>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Standerds</label>
                                <select name="standerd_id" class="form-control" >
                                    <option value="">Select Standerd</option>
                                    @foreach ($standers as $key => $value)
                                    <option value="{{ $key }}" @if($key == $teacher->standerd_id) selected @endif>{{ $value }}</option>
                                    @endforeach
                                </select>
                                <span id="standerdError" style="color: red;"></span>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Subject</label>
                                <select name="subject_id" class="form-control" >
                                    <option value="">Select Subject</option>
                                    @foreach ($subjects as $key => $value)
                                    <option value="{{ $key }}" @if($key == $teacher->subject_id) selected @endif>{{ $value }}</option>
                                    @endforeach
                                </select>
                                <span id="subjectError" style="color: red;"></span>
                            </div>
                            <button type="button" onclick="validateForm()" class="btn btn-primary mr-2">Submit</button>
                            <a class="btn btn-light" href="{{ route('standerd.index') }}">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 grid-margin stretch-card">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script>
        function validateForm() {
            var form = document.forms["addteacherForm"];
            var name = document.forms["addteacherForm"]["name"].value;
            var email = document.forms["addteacherForm"]["email"].value;
            var password = document.forms["addteacherForm"]["password"].value;
            var confirmPassword = document.forms["addteacherForm"]["conform-password"].value;
            var standerdId = document.forms["addteacherForm"]["standerd_id"].value;
            var subjectId = document.forms["addteacherForm"]["subject_id"].value;
    
            document.getElementById("nameError").innerHTML = "";
            document.getElementById("emailError").innerHTML = "";
            document.getElementById("passwordError").innerHTML = "";
            document.getElementById("conformPasswordError").innerHTML = "";
            document.getElementById("standerdError").innerHTML = "";
            document.getElementById("subjectError").innerHTML = "";
    
            if (name === "") {
                document.getElementById("nameError").innerHTML = "Name must be filled out";
                return false;
            }
    
            if (email === "") {
                document.getElementById("emailError").innerHTML = "Email must be filled out";
                return false;
            }
    
            if (password !== "") {
                if (confirmPassword === "" || confirmPassword !== password) {
                    document.getElementById("conformPasswordError").innerHTML = "Passwords do not match";
                    return false;
                }
            }
    
            if (standerdId === "") {
                document.getElementById("standerdError").innerHTML = "Please select a standard";
                return false;
            }
    
            if (subjectId === "") {
                document.getElementById("subjectError").innerHTML = "Please select a subject";
                return false;
            }
            
            if (password === null || password.trim() === "") {
                form["password"].remove();
                form["conform-password"].remove();
            }

            document.getElementById("addteacherForm").submit();
        }

    </script>

@endsection
