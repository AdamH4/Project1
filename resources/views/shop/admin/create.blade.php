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
            <label for="name">Name:</label>
            <input type="text" name="name" id="name">
            <label for="type">Type:</label>
            <input type="text" name="type" id="type">
            <label for="description">Description:</label>
            <textarea name="description" id="description" rows="10" cols="30"></textarea>
            <label for="text">Text:</label>
            <textarea name="text" id="text" rows="10" cols="30"></textarea>
            <label for="price">Price:</label>
            <input type="number" name="price" id="price" step="any">
            <br>
            <label>Select image to upload:</label>
            <input type="file" name="image" id="image">
            <button type="submit" value="upload" name="submit">Publish</button>
        </form>
    </div>

@endsection