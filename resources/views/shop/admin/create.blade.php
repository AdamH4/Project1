@extends('master')

@section('body')
    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif

    @include('shop.errors.error')

    <div class="container">
        <form action="{{ route('admin.store') }}" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
            <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" class="form-control">
            <label for="category">Category:</label>
            <input type="text" name="category" id="category" class="form-control">
            <label for="description">Description:</label>
            <textarea name="description" id="description" rows="10" cols="30" class="form-control"></textarea>
            <label for="text">Text:</label>
            <textarea name="text" id="text" rows="10" cols="30" class="form-control"></textarea>
            <label for="price">Price:</label>
            <input type="number" name="price" id="price" step="any" class="form-control">
            <br>
            <label>Select image to upload:</label>
            <input type="file" name="image" id="image" class="form-control">
            <button type="submit" value="upload" name="submit" class="form-control">Publish</button>
            </div>
        </form>
    </div>

@endsection