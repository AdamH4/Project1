@extends('master')

@section('body')
    <div class="container col-6">
        @if (session()->has('success'))
            <div class="alert alert-success">
            {{ session()->get('success') }}
            </div>
        @endif
        @include('shop.errors.error')
        <form action="{{ route('admin.store') }}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" name="name" id="name" class="form-control">
                <label for="category">Category:</label>
                <input type="text" name="category" id="category" class="form-control">
                <label for="description">Description:</label>
                <textarea name="description" id="description" rows="5" cols="30" class="form-control"></textarea>
                <label for="text">Text:</label>
                <textarea name="text" id="text" rows="5" cols="30" class="form-control"></textarea>
                <label for="price">Price:</label>
                <input type="number" name="price" id="price" step="any" class="form-control">
                <label>Select image to upload:</label>
                <input type="file" name="image" id="image" class="form-control">
                <br>
                <button type="submit" value="upload" name="submit" class="form-control btn btn-dark">Publish</button>
            </div>
        </form>
    </div>

@endsection