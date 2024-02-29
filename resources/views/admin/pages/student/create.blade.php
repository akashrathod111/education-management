@extends('admin.index')
@section('content')

    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Add Student</h4>

                        <form id="addStudentForm" action="{{ route('student.store') }}" method="POST" onsubmit="return validateForm()">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputUsername1">Name</label>
                                <input type="text" class="form-control" name="name" placeholder="Name">
                                <span id="nameError" style="color: red;"></span>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputUsername1">Email</label>
                                <input type="email" class="form-control" name="email" placeholder="Email">
                                <span id="emailError" style="color: red;"></span>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Standerds</label>
                                <select name="standerd_id" class="form-control" >
                                    <option value="">Select Standerd</option>
                                    @foreach ($standers as $key => $value)
                                    <option value="{{ $key }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                                <span id="standerdError" style="color: red;"></span>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Parent</label>
                                <select name="parent_id" class="form-control" >
                                    <option value="">Select Parent</option>
                                    @foreach ($parent as $key => $value)
                                    <option value="{{ $key }}">{{ $value }}</option>
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
            var name = document.forms["addStudentForm"]["name"].value;
            var email = document.forms["addStudentForm"]["email"].value;
            var standerd = document.forms["addStudentForm"]["standerd_id"].value;
            var parent = document.forms["addStudentForm"]["parent_id"].value;
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

            document.getElementById("addStudentForm").submit();
        }
    </script>

@endsection
