@extends('admin.index')
@section('content')

    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Edit Student</h4>

                        <form id="editStudentForm" action="{{ route('student.update',$student->id) }}" method="POST" onsubmit="return validateForm()">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="exampleInputUsername1">Name</label>
                                <input type="text" class="form-control" name="name" placeholder="Name" value="{{ $student->name }}">
                                <span id="nameError" style="color: red;"></span>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputUsername1">Email</label>
                                <input type="email" class="form-control" name="email" placeholder="Email" value="{{ $student->email }}">
                                <span id="emailError" style="color: red;"></span>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Standerds</label>
                                <select name="standerd_id" class="form-control" >
                                    <option value="">Select Standerd</option>
                                    @foreach ($standers as $key => $value)
                                    <option value="{{ $key }}" @if($key == $student->standerd_id) selected @endif>{{ $value }}</option>
                                    @endforeach
                                </select>
                                <span id="standerdError" style="color: red;"></span>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Parent</label>
                                <select name="parent_id" class="form-control" >
                                    <option value="">Select Parent</option>
                                    @foreach ($parent as $key => $value)
                                    <option value="{{ $key }}" @if($key == $student->parent_id) selected @endif>{{ $value }}</option>
                                    @endforeach
                                </select>
                                <span id="parentError" style="color: red;"></span>
                            </div>
                            <button type="button" onclick="validateForm()" class="btn btn-primary mr-2">Submit</button>
                            <a class="btn btn-light" href="{{ route('student.index') }}">Cancel</a>
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
            var name = document.forms["editStudentForm"]["name"].value;
            var email = document.forms["editStudentForm"]["email"].value;
            var standerd = document.forms["editStudentForm"]["standerd_id"].value;
            var parent = document.forms["editStudentForm"]["parent_id"].value;
            document.getElementById("nameError").innerHTML = "";
            document.getElementById("emailError").innerHTML = "";
            document.getElementById("standerdError").innerHTML = "";
            document.getElementById("parentError").innerHTML = "";

            if (name == "") {
                document.getElementById("nameError").innerHTML = "Name must be filled out";
                return false;
            }
            if (email == "") {
                document.getElementById("emailError").innerHTML = "Email must be filled out";
                return false;
            }
            if (standerd == "") {
                document.getElementById("standerdError").innerHTML = "Standerd must be filled out";
                return false;
            }
            if (parent == "") {
                document.getElementById("parentError").innerHTML = "Parent must be filled out";
                return false;
            }

            document.getElementById("editStudentForm").submit();
        }
    </script>

@endsection
