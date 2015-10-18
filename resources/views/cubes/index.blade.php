@extends('layout')

@section('content')
<div class="row">
  <div class="col-md-12">
    @if(isset($msg_create))
      <div class="alert alert-success" role="alert">
        <h2>{{ $msg_create }}</h2>
      </div>
    @else
      <h2>This is an application just to show how the Cube Summation</h2>
    @endif
  </div>
</div>
@endsection 