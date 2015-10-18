@extends('cubes.layout')

@section('content')
<div class="row">
  <div class="col-md-12">
    @if(isset($message))
      <div class="alert alert-success" role="alert">
        <h4>{{ $message }}</h4>
      </div>
    @endif
    <h2>Blocks for the cube {{ $cube_act->name }}</h2>
    @if($blocks)
    <div class="col-md-4 col-md-offset-4">
      <table class="table table-hover">
        <thead>
          <tr>
            <th>X</th>
            <th>Y</th>
            <th>Z</th>
            <th>Value</th>
          </tr>
        </thead>
        @foreach($blocks as $block)
          <tr>
            <td>{{ $block->x }}</td>
            <td>{{ $block->y }}</td>
            <td>{{ $block->z }}</td>
            <td>{{ $block->value }}</td>
          </tr>
        @endforeach
      </table>
    </div>
    @endif
  </div>
</div>
@endsection 