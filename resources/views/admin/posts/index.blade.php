@extends('layouts.admin')
@section('content')

<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteModalLabel">Confirm post delete</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Sei sicuro di voler eliminare il post con id: @{{postid}} ?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" @@click="submitForm()">Save changes</button>
      </div>
    </div>
  </div>
</div>
<section class="container">
  <a href="{{route('admin.posts.create')}}" class="btn btn-primary">Crea nuovo post</a>
  @if (session()->has('message'))
      <div class="alert alert-success">
        {{session()->get('message')}}
      </div>
  @endif
  <table class="table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Title</th>
          <th scope="col">Creation date</th>
        </tr>
      </thead>
      <tbody>
          @foreach ($posts as $post)    
          <tr>
            <td><a href="{{route('admin.posts.show', $post->id)}}">{{$post->id}}</a></td>
            <td><a href="{{route('admin.posts.show', $post->id)}}">{{$post->title}}</a></td>
            <td>{{$post->created_at}}</td>
            <td><a href="{{route('admin.posts.edit', $post->id)}}" class="btn btn-primary">Edit</a></td>
            <td>
              <form action="{{route('admin.posts.destroy', $post->id)}}" method="post">
                @csrf
                @method('DELETE')
                <button type="button" @@click="openModal($event, {{$post->id}})" class="btn btn-warning">Delete</button>
              </form>
            </td>
          </tr>
          @endforeach
      </tbody>
    </table>
</section>
@endsection