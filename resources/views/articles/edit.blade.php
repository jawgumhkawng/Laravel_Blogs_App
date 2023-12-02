@extends('layouts.app')
@section('content')

<div class="container">

    @if($errors->any())
        <div class="alert alert-warning">
            <ol>
                @foreach($errors->all() as $error)
                 <li>{{ $error }}</li>
                @endforeach
            </ol>
        </div>
    @endif

    <form method="post" enctype="multipart/form-data">
     @csrf

    
    <div class="mb-3">
        <label>Title</label>
        <input type="text" name="title" class="form-control" value="{{ old('$article->title',$articles->title) }}">
    </div>

   
    <div class="mb-3">
        <label>Body</label>
        <textarea name="body" class="form-control">{{ old('$article->body',$articles->body) }}</textarea>
    </div>

   
    <div class="mb-3">
      <label>Category</label>
        <select class="form-select" name="category_id">
        @foreach($categories as $category)
            <option value="{{ $category->id }}"
                {{ $articles->category_id == $category->id ? 'selected' : '' }}>
            {{ $category->name }}
            </option>
        @endforeach
        </select>
    </div>


     <div class=" form-group mb-4">
        <label for="exampleInputFile">Image</label><br>

        <img src="{{ url('./images/'.$articles->image) }}" width="300px" height="270px" style="border-radius: 10px; border:1px solid gray" alt=""><br><br>
           
        <div class="custom-file">
            <input type="file" class="form-control " name="image" placeholder="choose image" value="{{ old('$article->image',$articles->image) }}" id="customFile"{{ $articles->image ? $articles->image : 'required' }}>
        </div>
    </div>   

    <input type="submit" value="Add Article" 
    class="btn btn-primary">
    <a href="/articles" class="btn btn-warning">Back</a>
    </form>
 </div>
@endsection