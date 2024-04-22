@extends('admin.layouts.main')

@section('content')
<div>
    <form action="{{ route('post_uploads') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="image">
        <button>Upload</button>
    </form>
</div>
@endsection