@extends('admin.index')
@section('content')

    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Add Announcement</h4>

                        <form id="addannouncementForm" action="{{ route('announcement.store') }}" method="POST"
                            onsubmit="return validateForm()">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputUsername1">Name</label>
                                <input type="text" class="form-control" name="name" placeholder="Standard Name">
                                <span id="nameError" style="color: red;"></span>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Description</label>
                                <textarea name="description" class="form-control" placeholder="Description"></textarea>
                                <span id="descriptionError" style="color: red;"></span>
                            </div>
                            @php
                                $checkUserType = Auth::user()->user_type;
                            @endphp
                            @if ($checkUserType == 0)
                                <div class="form-group">
                                    <label for="teacher_id">Select Teacher:</label>
                                    @foreach ($teachers as $key => $value)
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="checkbox" name="teacher_id[]" value="{{ $key }}"
                                                    class="form-check-input">
                                                {{ $value }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                            @if ($checkUserType == 1)
                                <div class="form-group">
                                    <label for="student_id">Select Student:
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="checkbox" name="is_send_parent" class="form-check-input">Also
                                                send on parent email
                                            </label>
                                        </div>
                                    </label>

                                    @foreach ($student as $key => $value)
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="checkbox" name="student_id[]" value="{{ $key }}"
                                                    class="form-check-input">
                                                {{ $value }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            @endif

                            <button type="button" onclick="validateForm()" class="btn btn-primary mr-2">Submit</button>
                            <a class="btn btn-light" href="{{ route('announcement.index') }}">Cancel</a>
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
            var name = document.forms["addannouncementForm"]["name"].value;
            var description = document.forms["addannouncementForm"]["description"].value;

            document.getElementById("nameError").innerHTML = "";
            document.getElementById("descriptionError").innerHTML = "";

            if (name == "") {
                document.getElementById("nameError").innerHTML = "Name must be filled out";
                return false;
            }

            if (description == "") {
                document.getElementById("descriptionError").innerHTML = "Description must be filled out";
                return false;
            }

            document.getElementById("addannouncementForm").submit();
        }
    </script>

@endsection
