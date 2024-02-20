@extends('layouts.app')

@section('content')
@php
  $grid = "width:80%;"; 
  $like = "display:flex ; justify-content ; margin:8px";
  $image = "width:50% ;height : 500px";
  $commentContainerStyle = "display: flex; justify-content; align-items: center; margin-bottom: 10px; background-color: #f5f5f5; padding: 10px; border-radius: 5px;";
  $commentAvatarStyle = "width: 50px; height: 50px; border-radius: 50%;";
  $commentUsernameStyle = "font-weight: bold; margin-left: 10px; color: #333;";
  $commentTextStyle = "margin-left: 10px; font-size: 14px; color: #333;";
  $commentDelete = "margin-left: auto";
  $containContent = "display:flex"
  
@endphp

@if(session('error_role'))
<div class="text-center alert alert-warning alert-dismissible fade show" role="alert">
  <strong>{{session('error_role')}}</strong>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@elseif(session('success'))
<div class="text-center alert alert-success alert-dismissible fade show" role="alert">
  <strong>{{session('success')}}</strong>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

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
    
        @foreach($comments as $key => $comment)
          @can('delete', $comment)
            <div style="{{ $commentContainerStyle }}">
              <div class="ms-3" style="{{$containContent}}">
                <img style="{{ $commentAvatarStyle }}" src="{{asset('images/'.$comments[$key]->user->avatar_img)}}" alt="Avatar">
                <div class="ms-3">
                  <p style="{{ $commentUsernameStyle }}">{{$comment->user->name}}</p>
                  <p style="{{ $commentTextStyle }}">{{$comment->content}}</p>
                </div>
              </div>
              <div style="{{$commentDelete}}">
                <div style="{{$like}}">
                  <form action="/food-like/{{$comment->id}}" method="post">
                    @csrf
                    @method('post')                                      
                    <button type="submit" class="btn">
                      <span class="text-primary">{{$likes[$key]['like']}}</span>
                       <i class="fa fa-hand-o-up" aria-hidden="true"></i>
                      </button>
                  </form>
                  <form action="/food-dislike/{{$comment->id}}" method="post">
                    @csrf
                    @method('post') 
                    <button type="submit" class="btn">
                      <span class="text-primary">{{$likes[$key]['dislike']}}</span>
                       <i class="fa fa-hand-o-down" aria-hidden="true"></i>
                      </button>
                  </form>
                </div>
                <form action="/food-comment/{{$comment->id}}" method="post">
                  @csrf
                  @method('delete')
                  <button type="submit" class="btn btn-danger">Delete <i class="fa fa-trash-o" aria-hidden="true"></i></button>
                </form>
              </div>
            </div>
          @else
          <div style="{{ $commentContainerStyle }}">
            <div class="ms-3" style="{{$containContent}}">
              <img style="{{ $commentAvatarStyle }}" src="{{asset('images/'.$comments[$key]->user->avatar_img)}}" alt="Avatar">
              <div class="ms-3">
                <p style="{{ $commentUsernameStyle }}">{{$comment->user->name}}</p>
                <p style="{{ $commentTextStyle }}">{{$comment->content}}</p>
              </div>
            </div>
                <form action="/food-like/{{$comment->id}}" method="post">
                  @csrf
            <div style="{{$commentDelete}}">
              <div style="{{$like}}">
                  @method('post')                                      
                  <button type="submit" class="btn">
                    <span class="text-primary">{{$likes[$key]['like']}}</span>
                     <i class="fa fa-hand-o-up" aria-hidden="true"></i>
                    </button>
                </form>
                <form action="/food-dislike/{{$comment->id}}" method="post">
                  @csrf
                  @method('post') 
                  <button type="submit" class="btn">
                    <span class="text-primary">{{$likes[$key]['dislike']}}</span>
                     <i class="fa fa-hand-o-down" aria-hidden="true"></i>
                    </button>
                </form>
              </div>
            </div>
          </div>
          @endcan
        @endforeach
      </div>
    </div>
  </div>
</div>
@endsection
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

