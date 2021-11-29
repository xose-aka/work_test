@extends('admin.layout')
@section('content')
    @include('include.message')
    <h1 class="h3 mb-2 text-gray-800">Users</h1>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a class="btn btn-success" href="{{ route('admin.user.create') }}"><i class="fa fa-plus"></i> Add User</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                    <div class="row">
                        <div class="col-sm-12">
                            <table class="table table-bordered" role="grid" aria-describedby="dataTable_info" style="width: 100%;">
                                <thead>
                                <tr role="row">
                                    <th>#</th>
                                    <th>Username</th>
                                    <th>Created</th>
                                    <th>Action</th>
                                </thead>
                                <tbody>
                                @forelse($users as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->username }}</td>
                                        <td>{{ $user->created_at }}</td>
                                        <td>
                                            <a href="{{ route('admin.user.show', $user->id) }}">
                                                <span class="red">
                                                    <i class="fas fa-eye"></i>
                                                </span>
                                            </a>
                                            <a href="{{ route('admin.user.edit', $user->id) }}"><i class="fas fa-pen"></i></a>
                                            <a href="{{ route('admin.user.destroy', $user->id) }}"><i class="fas fa-trash"></i></a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="3">None</td></tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
