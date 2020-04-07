<!DOCTYPE html>
<html>
<head>
    <title>Image Gallery Example</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
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


<div class="container">
    <h3>Image Gallery</h3>

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
            <option value="flags">Flags</option>
            <option value="players">Players</option>
            <option value="cars">Cars</option>
            <option value="games">Games</option>
            </select> 
            </div>
            <div class="col-md-1">
                <br/>
                <button type="submit" class="btn btn-success">Upload</button>
            </div>
        </div>
    </form> 


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
        $(".fancybox").fancybox({
            openEffect: "none",
            closeEffect: "none"
        });
    });
</script>

</html>