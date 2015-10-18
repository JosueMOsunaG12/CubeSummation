<html lang="en"><head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="Cube Summation">
    <meta name="author" content="Josué Miguel Osuna">

    <title>Cube Summation</title>

    <!-- Bootstrap core CSS -->
    {!! Html::style('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css') !!}
    {!! Html::style('assets/css/main.css') !!}

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron text-center">
      <div class="container">
        <h1>Cube Summation</h1>
        <div class="row"> 
          @if (count($cubes) > 0)
          <div class="col-md-2 col-md-offset-4">
            <div class="dropdown">
              <button class="btn btn-info btn-lg dropdown-toggle" type="button" id="dropdownCube" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                {{ $cube_act->name or 'Choose a Cube' }}
                <span class="caret"></span>
              </button>
              <ul class="dropdown-menu" aria-labelledby="dropdownCube">
                @foreach($cubes as $cube)
                <li><a href="/cube/{{ $cube->id }}">{{ $cube->name }}</a></li>
                @endforeach
              </ul>
            </div>
          </div>
          <div class="col-md-2">
          @else
          <div class="col-md-2 col-md-offset-5">
          @endif
          <!-- Button trigger modal -->
            <button type="button" class="btn btn-success btn-lg" id="addCube" data-toggle="modal" data-target="#modalAddCube">
              Add a Cube
            </button>
          </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="modalAddCube" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Add a Cube</h4>
              </div>
              {!! Form::open() !!}
              <div class="modal-body">
                <div class="form-group">
                  {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Name']) !!}
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                {!! Form::submit('Add', ['class' => 'btn btn-success'] ) !!}
              </div>
              {!! Form::close() !!}
            </div>
          </div>
        </div>


        @if(isset($cube_act))
          <!-- Button trigger modal -->
          <button type="button" class="btn btn-primary" id="updateCube" data-toggle="modal" data-target="#modalUpdateCube">
            Update Cube
          </button>

          <!-- Modal -->
          <div class="modal fade" id="modalUpdateCube" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title" id="myModalLabel">Update a Cube</h4>
                </div>
                {!! Form::open(array('url' => 'cube/' . $cube_act->id, 'method' => 'put')) !!}
                <div class="modal-body">
                  <div class="form-group">
                    {!! Form::text('x', null, ['class' => 'form-control', 'placeholder' => 'X']) !!}
                    <br>{!! Form::text('y', null, ['class' => 'form-control', 'placeholder' => 'Y']) !!}
                    <br>{!! Form::text('z', null, ['class' => 'form-control', 'placeholder' => 'Z']) !!}
                    <br>{!! Form::text('value', null, ['class' => 'form-control', 'placeholder' => 'Value']) !!}
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  {!! Form::submit('Update', ['class' => 'btn btn-primary'] ) !!}
                </div>
                {!! Form::close() !!}
              </div>
            </div>
          </div>

          <!-- Button trigger modal -->
          <button type="button" class="btn btn-primary" id="queryCube" data-toggle="modal" data-target="#modalQueryCube">
            Query Cube
          </button>

          <!-- Button trigger modal -->
          <button type="button" class="btn" id="loadFileCube" data-toggle="modal" data-target="#modalLoadFileCube">
            Load Cube File
          </button>
        @endif
      </div>
    </div>

    <div class="container text-center">
      <!-- Example row of columns -->
      @yield('content')

      <hr>

      <footer>
        <p>© Josue Miguel Osuna 2015</p>
      </footer>
    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    {!! Html::script('https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js') !!}
    {!! Html::script('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js') !!}

</body></html>