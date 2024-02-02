@extends('layouts.app')

@section('content')

@php
    $imageStyle = 'height:350px';
    $col = 'width:23%';
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

<h3 class="text-center m-2">
  Search Foods
</h3>
<div class="input-group mb-5 mx-auto" style={{$col}}>
  <input type="text" class="form-control" placeholder="Enter Foods" aria-label="Recipient's username" aria-describedby="button-addon2">
  <button class="btn btn-primary" type="button" id="button-addon2">Search</button>
</div>
 



<div class="container text-center">
  <div class="row row-cols-1">
  @foreach($foods as $food)
    <div class="card col m-2" style={{$col}} >
      <img src="{{asset('images/'.$food->image_path)}}" style={{$imageStyle}} class="card-img-top" alt="...">
      <div class="card-body">
        <h5 class="card-title">{{$food->name}}</h5>
        <p class="card-text">{{$food->description}}</p>
        <a href="/food/{{$food->id}}" class="btn btn-primary">View Detail</a>
      </div>
    </div>
    @endforeach
  </div>
</div>

@endsection