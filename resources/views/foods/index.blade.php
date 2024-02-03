@extends('layouts.app')

@section('content')
@php
    $btn = 'pading:100% ; color: white; text-decoration: none;';
    $col = 'width : 90%'
@endphp
<div style="{{$col}}" class="mx-auto">
  <h1 class="mb-3">This is Foods Page</h1>  
  <div class="d-flex justify-content-between">
    <a href="food/create" class="btn btn-primary mb-4" role="button">Create a new Food</a>
    <a href="food-trash" class="btn btn-primary mb-4" role="button">Trash</a>
  </div>



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
        <td><a href="/food/{{ $food->id }}">{{ $food->name }}</a></td>
        <td>{{ $food->description}}</td>
        <td>
          <a class="btn btn-dark" href="food/{{ $food->id }}/edit">Edit</a>
          <form action="/food/{{ $food->id }}" method="post" style="display: inline;">
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