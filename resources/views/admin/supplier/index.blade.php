@extends('admin.layout')
@section('content')
    @include('include.message')
    <div class="card shadow">
        <div class="card-header">
            <div class="float-left">
                <h4 class="font-weight-bold text-primary">Suppliers</h4>
            </div>
            <div class="float-right">
                <a class="btn btn-success" href="{{ route('admin.supplier.create') }}"><i class="fa fa-plus"></i> Add Supplier</a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <div class="row">
                    <div class="col-sm-12">
                        <table class="table table-bordered" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Username</th>
                                    <th>Created</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @forelse($suppliers as $key => $supplier)
                                <tr>
                                    <td>{{ $suppliers->firstItem() + $key }}</td>
                                    <td>{{ $supplier->getTitle() }}</td>
                                    <td>{{ $supplier->created_at }}</td>
                                    <td class="d-flex flex-row justify-content-around">
                                        <a href="{{ route('admin.supplier.show', $supplier->getId()) }}"><i class="fas fa-eye" style="color: green;"></i></a>
                                        <a href="{{ route('admin.supplier.edit', $supplier->getId()) }}"><i class="fas fa-pen"></i></a>
                                        <a href="{{ route('admin.user.destroy', $supplier->getId()) }}"><i class="fas fa-trash" style="color: red;"></i></a>
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
        <div class="card-footer">
            <div class="float-left">
                <p>Shows {{ $suppliers->firstItem() }} to {{ $suppliers->lastItem() }} out of {{ $suppliers->total() }} entries</p>
            </div>
            <div class="d-flex float-right">
                {!! $suppliers->links() !!}
            </div>
        </div>
    </div>
@endsection
