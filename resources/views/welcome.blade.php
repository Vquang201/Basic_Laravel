@extends('layouts.app')

@php
//   $image = "width: 100%; height:auto";
@endphp
@section('content')
    <div class="container mb-5">
        <h3 class="mt-3 text-center">Top 3 user có nhiều bài post nhất</h3>
        <div class="row">
            @foreach ($post_users as $item)
                <div class="col-md-4 mt-4">
                    <div class="card">
                        {{-- <img src="https://phongreviews.com/wp-content/uploads/2022/11/avatar-facebook-mac-dinh-19.jpg" class="card-img-top" alt=""> --}}
                        <div class="card-body">
                            <h3 class="card-title">{{$item->name}}</h3>
                            <p class="card-text">Số lượng bài post: {{$item->post_count}}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <h3 class="text-center mt-5">Top 3 comment có nhiều lượt thích</h3>
        <div class="container mt-4">
            <div class="row">
                @foreach ($likes as $key => $item)
                    <div class="col-md-4">
                        <div class="card mb-4">
                            <div class="card-body">
                                <h5 class="card-title">Tên comment: {{$item->content}}</h5>
                                <p class="card-text">Người comment: {{$user_comment_of_like[$key]['user']->name}}</p>
                                <p class="card-text">Ngày comment: {{$user_comment_of_like[$key]['comment']->created_at}}</p>
                                <p class="card-text">Số lượng like: {{$item->comment_count}}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <h3 class="text-center mt-5">Top 3 comment có nhiều lượt dislike</h3>
        <div class="container mt-4">
            <div class="row">
                @foreach ($dislike as $key => $item)
                    <div class="col-md-4">
                        <div class="card mb-4">
                            <div class="card-body">
                                <h5 class="card-title">Tên comment: {{$item->content}}</h5>
                                <p class="card-text">Người comment: {{$user_comment_of_dislike[$key]['user']->name}}</p>
                                <p class="card-text">Ngày comment: {{$user_comment_of_dislike[$key]['comment']->created_at}}</p>
                                <p class="card-text">Số lượng dislike: {{$item->comment_count}}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    </div>
@endsection