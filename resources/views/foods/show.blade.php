@extends('layouts.app')


@section('content')
@php
  $grid = "width:80%;"; 
  $image = "width:50% ;height : 500px";
  $commentContainerStyle = "display: flex; justify-content; align-items: center; margin-bottom: 10px; background-color: #f5f5f5; padding: 10px; border-radius: 5px;";
  $commentAvatarStyle = "width: 50px; height: 50px; border-radius: 50%;";
  $commentUsernameStyle = "font-weight: bold; margin-left: 10px; color: #333;";
  $commentTextStyle = "margin-left: 10px; font-size: 14px; color: #333;";
  $commentDelete = "margin-left: auto"

@endphp
<div style="{{$grid}}" class="container">
  <h3 class="text-center mt-5">POST - {{ $food->name }}</h3>
  <div class="row mb-4">
    <div class="col">
      <h4 class="mb-0">Danh mục: {{ $food->category->name }}</h4>
    </div>
    <div class="col">
      <h4 class="mb-0">Viết bởi: {{$user->name}}</h4>
    </div>
  </div>
  <div class="text-center">
    <img src="{{ asset('images/' . $food->image_path) }}" style="{{$image}}" class="img-fluid" alt="">
  </div>
  <div class="mt-5 mb-5">
    <h4>Mô tả:</h4>
    <p>{{ $food->description }}</p>
  </div>
  <div class="mb-5">
    <div class="row">
      <div class="col">
        <form action="/food-comment/{{$food->id}}" method="post" class="d-flex">
          @csrf
          @method('post')
          <textarea type="text" name="comment" class="form-control" placeholder="Enter comment" aria-label="Recipient's username" aria-describedby="button-addon2"></textarea>
          <button class="btn btn-primary" type="submit" id="button-addon2">Comment</button>
        </form>
    
        @foreach($comments as $comment)
        @can('delete', $comment)
        <div style="{{ $commentContainerStyle }}">
          <div class="text-center">
            <img style="{{ $commentAvatarStyle }}" src="https://phongreviews.com/wp-content/uploads/2022/11/avatar-facebook-mac-dinh-19.jpg" alt="Avatar">
            <p style="{{ $commentUsernameStyle }}">{{$comment->user->name}}</p>
          </div>
          <p style="{{ $commentTextStyle }}">{{$comment->content}}</p>
          <div style="{{$commentDelete}}">
            <form action="/food-comment/{{$comment->id}}" method="post">
              @csrf
              @method('delete')
              <button type="submit" class="btn btn-danger">Delete Comment</button>
            </form>
          </div>
        </div>
        @else
        <div style="{{ $commentContainerStyle }}">
          <div class="text-center">
            <img style="{{ $commentAvatarStyle }}" src="https://phongreviews.com/wp-content/uploads/2022/11/avatar-facebook-mac-dinh-19.jpg" alt="Avatar">
            <p style="{{ $commentUsernameStyle }}">{{$comment->user->name}}</p>
          </div>
          <p style="{{ $commentTextStyle }}">{{$comment->content}}</p>
        </div>
        @endcan
        
        @endforeach
  
      </div>
    </div>
  </div>
</div>
@endsection