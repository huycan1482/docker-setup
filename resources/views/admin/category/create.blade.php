@extends('admin.layouts.main')

@section('title', __('Category'))

@push('styles')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('bower_components/select2/dist/css/select2.min.css') }}">
@endpush

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
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Quick Example</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form role="form">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Nhập tên">
                        </div>
                        
                        <div class="form-group">
                            <label>Category</label>
                            <select class="form-control select2" style="width: 100%;" name="parent_id">
                                <option selected disabled value="0">-- Chọn --</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="image">Image</label>
                            <input type="file" id="image" name="image">
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="active"> Active
                            </label>
                        </div>
                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                        {{-- <button type="submit" class="btn btn-primary">Submit</button> --}}
                        <div class="btn btn-primary" data-click="submitForm">Submit</div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<!-- Select2 -->
<script src="{{ asset('bower_components/select2/dist/js/select2.full.min.js') }}"></script>
<script>
    $('.select2').select2()
</script>

<script src="{{ mix('asset/js/admin/main.js') }}"></script>
<script src="{{ mix('asset/js/admin/category.js') }}"></script>

@endpush