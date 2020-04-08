<!DOCTYPE html>
<html>
<head>
      <title>Image Gallery Example</title>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
            <style>
            .form-add-category{
            background: #e8e8e8 none repeat scroll 0 0;
            padding: 15px;
      }
      </style>
</head>
<body>
    <form action="{{ url('category') }}" class="form-add-category" method="POST" enctype="multipart/form-data">
            {!! csrf_field() !!}
            @if (count($errors) > 0)
                  <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                        <ul>
                              @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                              @endforeach
                        </ul>
                  </div>
            @endif

            @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block">
                  <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{{ $message }}</strong>
            </div>
            @endif
<div class="container">
            <a href="/admin" class="btn btn-primary" >Back</a>
            <h3>Add new category</h3>
            <div class="row">
                  <div class="col-md-5">
                        <input type="text" name="category" class="form-control" placeholder="add new category">
                  </div>
                  <div class="col-md-3">
                        <br/>
                        <button type="submit" class="btn btn-success">Add</button>
                  </div>
            </div>
      </form> 
</body>