@extends('layouts.app')

@section('content')
@php
    $btn = 'pading:100% ; color: white; text-decoration: none;';
    $col = 'width : 90%'
@endphp
<div style="{{$col}}" class="mx-auto">
  <h1 class="mb-3">This is all user</h1>  
  <a href="/user/create" 
    class="btn btn-primary mb-4"
    role="button">
      Create a new user
  </a> 
  <table class="table">
    <thead>
      <tr>
        <th>ID</th>
        <th>Email</th>
        <th>Role</th>
        <th>Name</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($users as $user)
      <tr>
        <td>{{$user->id}}</td>
        <td><a href="/user/{{ $user->id }}">{{ $user->email }}</a></td>
        <td>
          @if($user->role_id == '2')
            admin
          @else
            user
          @endif
        </td>
        <td>{{ $user->name }}</td>
        <td>
          <a class="btn btn-dark" href="user/{{ $user->id }}/edit">Edit</a>
          <form action="/user/{{ $user->id }}" method="post" style="display: inline;">
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-danger">Delete</button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>      
</div>
@endsection