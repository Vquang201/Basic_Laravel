@extends('layouts.app')

@section('content')
@php
    $btn = 'pading:100% ; color: white; text-decoration: none;';
    $col = 'width : 90%'
@endphp
<div style="{{$col}}" class="mx-auto">
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
  <h1 class="mb-3">This is Foods Page</h1>  
  <a href="food" class="btn btn-primary mb-4" role="button">Back</a>
 
  <table class="table">
    <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Description</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($foods as $food)
      <tr>
        <td>{{$food->id}}</td>
        <td>{{ $food->name }}</></td>
        <td>{{ $food->description}}</td>
        <td>
          <form action="food-trash/{{ $food->id }}" method="post" style="display: inline;">
            @csrf
            <button type="submit" class="btn btn-dark">Restore</button>
          </form>
          <form action="food-trash/{{ $food->id }}" method="post" style="display: inline;">
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-danger">Delete Force</button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>      
</div>
@endsection