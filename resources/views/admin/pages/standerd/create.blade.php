@extends('admin.index')
@section('content')

    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Add Standard</h4>

                        <form id="addStandardForm" action="{{ route('standerd.store') }}" method="POST" onsubmit="return validateForm()">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputUsername1">Name</label>
                                <input type="text" class="form-control" name="name" placeholder="Standard Name">
                                <span id="nameError" style="color: red;"></span>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Class</label>
                                <input type="text" class="form-control" name="class" placeholder="Class">
                                <span id="classError" style="color: red;"></span>
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
            var name = document.forms["addStandardForm"]["name"].value;
            var standardClass = document.forms["addStandardForm"]["class"].value;

            document.getElementById("nameError").innerHTML = "";
            document.getElementById("classError").innerHTML = "";

            if (name == "") {
                document.getElementById("nameError").innerHTML = "Name must be filled out";
                return false;
            }

            if (standardClass == "") {
                document.getElementById("classError").innerHTML = "Class must be filled out";
                return false;
            }

            document.getElementById("addStandardForm").submit();
        }
    </script>

@endsection
