@extends('layouts.app')

@section('content')
@php
    $col='width:70%';
@endphp

<h1 class="text-center mb-4">Update user</h1> 
<form action="/user/{{ $user-> id }}" method="post" class="mx-auto" style={{$col}}>    
    @csrf
    @method('PUT')        
    <input 
      class="form-control mb-3"
      type="text" 
      name="name"
      value="{{$user->name}}" 
      placeholder="Enter user's name">
    <input 
      class="form-control mb-3"
      type="text"
      name="email"
      value="{{$user->email}}" 
      placeholder="Enter user's email">
    <input 
      class="form-control mb-3"
      type="password" 
      name="password" 
      value="{{$user->password}}" 
      placeholder="Enter user's password">
    <div class="mb-3">
      <label>Role : </label>
      <select name="role_id">
        <option value="1" {{ $user->role_id == '1' ? 'selected' : '' }}>USER</option>
        <option value="2" {{ $user->role_id == '2' ? 'selected' : '' }}>ADMIN</option>
      </select>
    </div>
    <button 
      class="btn btn-primary mb-3"
      type="submit">
      Save
    </button>
</form>
@endsection  