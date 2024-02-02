@extends('layouts.app')

@php
    $col='width:70%';
@endphp

@section('content')
    <h1 class="text-center m-3">Enter food information</h1>
    <form action="/food" method="post" style={{$col}} class="mx-auto"
      enctype="multipart/form-data">
        @csrf
        {{-- the key is generated at every session start --}}
        {{-- only apply to non-read routes --}}
        {{-- If some hacker access to this site from hist/her site --}}
        <input class="form-control mb-3" 
          type="file" name="image" 
        >
        <input class="form-control mb-3" 
          type="text" name="name" 
          placeholder="Enter food's name">

        <div class="form-floating">
          <textarea class="form-control mb-3" placeholder="Leave a comment here" name="description" id="floatingTextarea2" style="height: 100px"></textarea>
          <label for="floatingTextarea2">Description</label>
        </div>
        {{-- <input class="form-control mb-3" type="text" name="count" placeholder="Enter food's count"> --}}
        <div class="mb-3">
            <label>Choose a categories:</label>
            <select name="category_id">
              @foreach ($categories as $category)
                <option value="{{ $category->id }}">
                  {{ $category->name }}
                </option>    
              @endforeach                                
            </select>
        </div>
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
