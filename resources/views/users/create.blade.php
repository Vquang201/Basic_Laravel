@extends('layouts.app')

@php
    $col='width:70%';
@endphp

@section('content')
    <h1 class="text-center m-3">Enter user information</h1>
    <form action="/user" method="post" style={{$col}} class="mx-auto"
      enctype="multipart/form-data">
        @csrf
        <input class="form-control mb-3" 
          type="text" name="name" 
          placeholder="Enter name">
        <input class="form-control mb-3" type="text" name="email" placeholder="Enter email">
        <input class="form-control mb-3" type="password" name="password" placeholder="Enter password">
        <button class="btn btn-primary mb-3" type="submit">
            Submit
        </button>
    </form>
    @if ($errors->any())
      <div>
        @foreach ($errors->all() as $error)
          <p class="text-danger">
            {{ $error }}
          </p>
        @endforeach
      </div>
    @endif
@endsection
