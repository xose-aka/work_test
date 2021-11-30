@extends('admin.layout')
@section('content')
    @include('include.message')
    <form action="{{ route('admin.supplier.store') }}" method="POST">
        @csrf
        <div class="card shadow">
            <div class="card-header">
                <h4 class="font-weight-bold text-primary">Add Supplier</h4>
            </div>
            <div class="card-body">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="title" class="required">Title</label>
                        <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" placeholder="Title">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="slug" class="required">Slug</label>
                        <input type="text" class="form-control" id="slug" name="slug" value="{{ old('slug') }}" placeholder="Ex: supplier-manager">
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="d-flex">
                    <button type="submit" class="btn btn-success">
                        Save
                    </button>
                    <a class="btn btn-danger ml-2" href="#" data-toggle="modal" data-target="#cancelModal">
                        Cancel
                    </a>
                </div>
            </div>
        </div>
    </form>
    <!-- Logout Modal-->
    <div class="modal fade" id="cancelModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Cancel?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Do you want to cancel ?</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="{{ route('admin.supplier.index') }}">Ok</a>
                </div>
            </div>
        </div>
    </div>
@endsection
