<?php
use App\Models\Supplier;
/** @var Supplier $suppleir */
?>
@extends('admin.layout')
@section('content')
    <div class="card shadow">
        <div class="card-header">
            <h4 class="font-weight-bold text-primary">Supplier: {{ $supplier->getTitle() }}</h4>
        </div>
        <div class="card-body">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="title" class="required">Title</label>
                    <input type="text" class="form-control" value="{{ $supplier->getTitle() }}" id="title" disabled>
                </div>
                <div class="form-group col-md-6">
                    <label for="slug" class="required">Slug</label>
                    <input type="text" class="form-control" id="slug" value="{{ $supplier->getSlug() }}" disabled>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <div class="d-flex">
                <a class="btn btn-success" href="{{ route('admin.supplier.edit', $supplier->getId()) }}">Edit</a>
            </div>
        </div>
    </div>
@endsection
