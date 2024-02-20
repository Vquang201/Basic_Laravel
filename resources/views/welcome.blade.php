@extends('layouts.app')

@php
// $image = "width: 100%; height:auto";
@endphp

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-6 offset-md-3">
      <h3 class="text-center mb-5">Top 3 người dùng có nhiều bài post nhất</h3>
      @foreach ($post_users as $item)
      <div class="card mb-4">
        {{-- <img src="{{asset('images/'.$item->avatar_img)}}" class="card-img-top" alt=""> --}}
        <div class="card-body">
          <h5 class="card-title">{{$item->name}}</h5>
          <p class="card-text">Số lượng bài post: {{$item->post_count}}</p>
        </div>
      </div>
      @endforeach
    </div>
  </div>

  <div class="row mt-5">
    <div class="col-md-6 offset-md-3">
      <h3 class="text-center mb-5">Top 3 comment có nhiều lượt thích nhất</h3>
      @foreach ($likes as $key => $item)
      <div class="card mb-4">
        <div class="card-body">
          <h5 class="card-title">Nội dung comment: {{$item->content}}</h5>
          <p class="card-text">Người comment: {{$user_comment_of_like[$key]['user']->name}}</p>
          <p class="card-text">Ngày comment: {{$user_comment_of_like[$key]['comment']->created_at}}</p>
          <p class="card-text">Số lượng like: {{$item->comment_count}}</p>
        </div>
      </div>
      @endforeach
    </div>
  </div>

  <div class="row mt-5">
    <div class="col-md-6 offset-md-3">
      <h3 class="text-center mb-5">Top 3 comment có nhiều lượt dislike nhất</h3>
      @foreach ($dislike as $key => $item)
      <div class="card mb-4">
        <div class="card-body">
          <h5 class="card-title">Nội dung comment: {{$item->content}}</h5>
          <p class="card-text">Người comment: {{$user_comment_of_dislike[$key]['user']->name}}</p>
          <p class="card-text">Ngày comment: {{$user_comment_of_dislike[$key]['comment']->created_at}}</p>
          <p class="card-text">Số lượng dislike: {{$item->comment_count}}</p>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</div>
@endsection