@extends('layouts.app')
@section('content')

    <div class="container">
        <div class="h3 mt-3 mb-3">Add New form</div>

        @if ($errors->any())
            <div class="alert alert-warning">
                <ol>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ol>
            </div>
        @endif

        <form method="post" enctype="multipart/form-data">
            @csrf


            <div class="mb-3">
                <label>Title</label>
                <input type="text" name="title" class="form-control">
            </div>

            <div class="mb-3">
                <label>Body</label>
                <textarea name="body" class="form-control"></textarea>
            </div>


            <div class="mb-3">
                <label>Category</label>
                <select class="form-select" name="category_id">
                    <option value="">Select Category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>


            <div class=" form-group mb-4">
                <label for="exampleInputFile">Image</label>

                <div class="custom-file">
                    <input type="file" class="form-control " name="image" placeholder="choose image" id="customFile">
                </div>
            </div>

            <input type="submit" value="Add Article" class="btn btn-primary">
            <a href="/articles" class="btn btn-secondary">Back</a>
        </form>
    </div>
    <br>
    <hr>
@endsection
