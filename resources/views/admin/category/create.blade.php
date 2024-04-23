@extends('admin.layouts.main')

@section('title', __('Category'))

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="d-flex align-items-end">
        <h1 class="m-0 me-2">Category</h1>
        <a href="{{ route('category.index') }}" class="label label-primary p-2" style="width: fit-content">List</a>
    </div>
    
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Category</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
            </div>
        </div>
    </div>
</section>
@endsection