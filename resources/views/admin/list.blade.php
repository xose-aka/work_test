@extends('admin.layout')
@section('content')
    <h1 class="h3 mb-2 text-gray-800">Products</h1>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Products list</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                    <div class="row mb-3">
                        <div class="col-sm-12 col-md-6">
                            <div class="dataTables_length" id="dataTable_length">
                                <a class="btn btn-success" href=""><i class="fa fa-plus"></i> Add product</a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <table class="table table-bordered" role="grid" aria-describedby="dataTable_info" style="width: 100%;">
                                <thead>
                                <tr role="row">
                                    <th>#</th>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
