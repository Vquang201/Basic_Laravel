@extends('layouts.app')

@section('content')
@php
    $col='width:70%';
@endphp

<h1 class="text-center mb-4">Update a food</h1> 
<form action="/food/{{ $food-> id }}" method="post" class="mx-auto" style={{$col}}>    
    @csrf
    @method('PUT')        
    <input 
      class="form-control mb-3"
      type="text" 
      name="name"
      value="{{$food->name}}" 
      placeholder="Enter food's name">
    <input 
      class="form-control mb-3"
      type="text"
      name="description"
      value="{{$food->description}}" 
      placeholder="Enter food's description">
    <input 
      class="form-control mb-3"
      type="text" 
      name="count" 
      value="{{$food->count}}" 
      placeholder="Enter food's count">
    <button 
      class="btn btn-primary mb-3"
      type="submit">
      Save
    </button>
</form>
@endsection  