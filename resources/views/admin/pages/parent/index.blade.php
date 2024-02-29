@extends('admin.index')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success">
                                <p>{{ $message }}</p>
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-lg-10 grid-margin stretch-card">
                                <h4 class="card-title">Parent</h4>
                            </div>
                            <div class="col-lg-2 grid-margin stretch-card">
                                <a class="btn btn-info" href="{{ route('parent.create') }}"> Create Parent</a>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th width="280px">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($studentParent as $data)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>{{ $data->name }}</td>
                                            <td>{{ $data->email }}</td>
                                            <td>
                                                <form class="delete" action="{{ route('parent.destroy', $data->id) }}"
                                                    method="POST" onsubmit="return confirmDelete();">
                                                    <a class="btn btn-primary"
                                                        href="{{ route('parent.edit', $data->id) }}">Edit</a>

                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {!! $studentParent->links() !!}

    <!-- Add the following script for confirmation box -->
    <script>
        function confirmDelete() {
            return confirm('Are you sure you want to delete this item?');
        }
    </script>
@endsection
