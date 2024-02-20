@extends('layouts.app')

@php
    $col = 'width:70%';
    $img = 'width:120px'
@endphp

@section('content')
@if(session('fail'))
<div class="text-center alert alert-warning alert-dismissible fade show" role="alert">
  <strong>{{session('fail')}}</strong>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@elseif(session('success'))
<div class="text-center alert alert-success alert-dismissible fade show" role="alert">
  <strong>{{session('success')}}</strong>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<h1 class="text-center m-3">Profile</h1>
<form action="/user/profile/{{$user->id}}" method="post" style="{{ $col }}" class="mx-auto" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    
    <div class="form-group mb-3">
        <img style="{{$img}}" src="{{asset('images/'.$user->avatar_img)}}" alt="">
        <label for="avatar">Thay đổi avatar:</label>
        <input id="avatar" value="{{$user->avatar_img}}" class="form-control-file mb-3" name="image" type="file">
    </div>

    <div class="form-group">
        <label for="name">Name:</label>
        <input id="name" class="form-control mb-3" value="{{$user->name}}" type="text" name="name" placeholder="Enter name">
    </div>

    <div class="form-group">
        <label for="name">Email:</label>
        <input id="name" class="form-control mb-3" value="{{$user->email}}" disabled type="text" name="email" placeholder="Enter name">
    </div>

    <div class="form-group">
        <label for="name">Role:</label>
        <input id="name" class="form-control mb-3" value="{{ $user->role_id == 2 ? 'admin' : 'user' }}" disabled type="text">
    </div>

    <div class="form-group">
        <label for="old-password">Old Password:</label>
        <input id="old-password" class="form-control mb-3" type="password" name="oldPassword" placeholder="Enter old password">
    </div>

    <div class="form-group">
        <label for="password">New Password:</label>
        <input id="password" class="form-control mb-3" type="password" name="newPassword" placeholder="Enter new password">
    </div>

    <button class="btn btn-primary mb-3" type="submit">
        Submit
    </button>
</form>
@endsection