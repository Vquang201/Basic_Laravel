@extends('layouts.app')

@section('content')
@php
  $grid = "width:80%;"; 
  $image = "width:50% ;height : 500px";
@endphp
<div style="{{$grid}}" class="container">
  <h3 class="text-center mt-5">POST - {{ $food->name }}</h3>
  <div class="row mb-4">
    <div class="col">
      <h4 class="mb-0">Danh mục: {{ $food->category->name }}</h4>
    </div>
    <div class="col">
      <h4 class="mb-0">Viết bởi: {{$user->name}}</h4>
    </div>
  </div>
  <div class="text-center">
    <img src="{{ asset('images/' . $food->image_path) }}" style="{{$image}}" class="img-fluid" alt="">
  </div>
  <div class="mt-5">
    <h4>Mô tả:</h4>
    <p>{{ $food->description }}</p>
  </div>
</div>
@endsection