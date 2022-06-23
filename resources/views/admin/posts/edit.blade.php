@extends('layouts.admin')

@section('content')
<form action="{{route('admin.posts.update', $post->id)}}" method="POST" class="container">
  @csrf
  @method('PUT')
  <div class="mb-3">
    <label for="title" class="form-label">Title</label>
    <input type="text" class="form-control" id="title" name="title" value="{{old('title', $post->title)}}">
  </div>
  <div class="mb-3">
    <label for="content" class="form-label">Content</label>
    <textarea name="content" id="content" cols="30" rows="10" >{{old('content', $post->content)}}</textarea>
  </div>
  <div class="mb-3">
    <label for="category" class="form-label">Category</label>
    <select class="form-control @error('category_id') is-invalid @enderror" id="category" name="category_id">
      <option value="">Select Category</option>
      @foreach ($categories as $category)            
        <option value="{{$category->id}}" {{$category->id == old('category_id', $post->category_id) ? 'selected' : ''}}>{{$category->name}}</option>
      @endforeach
    </select>
    @error('category_id')
        <div class="alert alert-danger">{{$message}}</div>
    @enderror
  </div>
  <div class="mb-3 form-check">
    <input type="checkbox" class="form-check-input" {{old('published', $post->published) ? 'checked' : ''}} id="published" name="published">
    <label class="form-check-label" for="published">Published</label>
  </div>

  <button type="submit" class="btn btn-primary">Salva</button>
</form>
@endsection