<!DOCTYPE html>
<html>
<head>
      <title>Image Gallery Example</title>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <style type="text/css">
      .gallery{
            display: inline-block;
            margin-top: 20px;
      }

      .cross{
         border-radius: 50%;
            position: absolute;
            right: 5px;
            top: -10px;
            padding: 5px 8px;
      }

      .form-image-upload{
            background: #e8e8e8 none repeat scroll 0 0;
            padding: 15px;
      }
      
      </style>

</head>
<body>




      <form action="{{ url('admin') }}" class="form-image-upload" method="POST" enctype="multipart/form-data">
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
<!-- //////////////////////////////////////////////////////////// -->
<div class="container">
            <h3>Image Gallery</h3>
            <div class="row text-center">
                    <!-- <h3>Add New Category</h3> -->
                    <a href="/category" class="btn btn-lg btn-success">Add New Category</a>
            </div>
            <!-- <button type="button" class="btn btn-primary" id="#btn" data-toggle="modal" data-target="#exampleModal">
  Launch demo modal
</button> -->
            <!-- ////////////////////////////////////////////////////////////// -->
            <div class="row">
                  <div class="col-md-3">
                        <strong>Title 01:</strong>
                        <input type="text" name="title" class="form-control" placeholder="Title">
                  </div>
                  <div class="col-md-3">
                        <strong>Image 01:</strong>
                        <input type="file" name="image" class="form-control">
                  </div>
                  
                  <div class="col-md-3">
                        <strong>Title 02:</strong>
                        <input type="text" name="title1" class="form-control" placeholder="Title">
                  </div>
                  <div class="col-md-3">
                        <strong>Image 02:</strong>
                        <input type="file" name="image1" class="form-control">
                  </div>
                  <div class="col-md-3">
                  <label for="category">Choose a category:</label>
                  <select class="form-control" name="category" id="category">
                  <!-- <option value="games">Games</option> -->
                  </select> 
                  </div>
                  <div class="col-md-1">
                        <br/>
                        <button type="submit" class="btn btn-success">Upload</button>
                  </div>
            </div>
      </form> 
      <!-- Modal -->
<!-- <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div> -->


      <div class="row">
      <div class='list-group gallery'>
                  @if($images->count())
                        @foreach($images as $image)
                              <div class='col-sm-4 col-xs-6 col-md-3 col-lg-3'>
                                    <a class="imagediv thumbnail fancybox" rel="lightbox" href="/images/{{ $image->image }}">
                                          <img style="height: 250px;" class="img-responsive" alt="" src="/images/{{ $image->image }}" />
                                          <div class='text-center'>
                                                <small class='text-muted'>{{ $image->title }}</small>
                                          </div>
                                    </a>


                                    <form action="{{ url('admin',$image->id) }}" method="GET">
                                          <input type="hidden" name="_method" value="delete">
                                          {!! csrf_field() !!}
                                          <button type="submit" class="cross btn btn-danger"><i class="glyphicon glyphicon-remove"></i></button>
                                    </form>
                              </div>
                        @endforeach
                  @endif
            </div> 
      </div>
</div>


</body>


<script type="text/javascript">
      $(document).ready(function(){
//             $('#btnTest').click(function() {
//     $('#exampleModal').modal('show');
//   });
            getCategories();
            $(".fancybox").fancybox({
                  openEffect: "none",
                  closeEffect: "none"
            });
      });
      function getCategories(){
            var url = '{{ url('getCategories') }}';
            $.ajax({
                  url: url,
                  type: 'GET',
                  dataType: 'JSON',
                  success: function(jsonData) {
                        $.each(jsonData, function(key, value) {   
                        $('#category').append($("<option></option>").attr("value",value.id).text(value.category)); 
                        });
                  }
            });
      }
</script>

</html>