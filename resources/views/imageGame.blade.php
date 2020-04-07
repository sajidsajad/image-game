<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <title>Image Game</title>
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <style>
         .maindiv{
            border: solid 2px grey; 
            height: 600px; 
            width: 90%;
            margin: 30px auto;
            background-image: url("https://iammagnus.com/wp-content/uploads/2016/05/website-design-background-1.jpg");

        }
        .col-1 {width: 8.33%;}
        .col-2 {width: 16.66%;}
        .col-3 {width: 25%;}
        .col-4 {width: 33.33%;}
        .col-5 {width: 41.66%;}
        .col-6 {width: 50%;}
        .col-7 {width: 58.33%;}
        .col-8 {width: 66.66%;}
        .col-9 {width: 75%;}
        .col-10 {width: 83.33%;}
        .col-11 {width: 91.66%;}
        .col-12 {width: 100%;}
        @media only screen and (max-width: 550px) {
            /* For mobile phones: */
            [class*="col-"] {
                width: 100%;
            }
        }
        </style>
    </head>
    <body>
        
        <div class="maindiv container">
            <h2 align="center">Choose your best option:</h2>
            <div class="row" style="margin: 25px auto;">
                <div class="col-sm-6 col-xs-6" style="text-align:center;margin-bottom: 5px;">
                    <img style="display: block;margin: auto;height: 200px;width: 200px;border-radius: 200px;" id="img1" data-id="" class="img-responsive img-fluid"  src="" alt="map">
                    <h4 id="title01"></h4>
                </div>
                <div class="col-sm-6 col-xs-6" style="text-align:center;">
                    <img style="display: block;margin: auto;height: 200px;width: 200px;border-radius: 200px;" id="img2" data-id="" class="img-responsive img-fluid"  src=""  alt="map">
                    <h4 id="title02"></h4>
                </div>
                
            </div>
        </div>
    </body>
    <script>
    var catList = [];
    var APP_URL = {!! json_encode(url('/')) !!}
    $(document).ready(function() {
        getImages();
    });

    $("#img1").click(function(){
        nextCat($(this).attr('data-id'));
    });

    $("#img2").click(function(){
        nextCat($(this).attr('data-id'));
    });

    function getImages(){
        var url = '{{ url('getimages') }}';
        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'JSON',
            success: function(jsonData) {
                console.log(jsonData[0]);
                console.log(jsonData[1]);
                $('#img1').attr('src',APP_URL +'/images/'+ jsonData[0].image);
                $('#title01').append(jsonData[0].title);
                $('#img1').attr('data-id',jsonData[0].category);
                $('#img2').attr('src',APP_URL +'/images/'+ jsonData[1].image);
                $('#title02').append(jsonData[1].title);
                $('#img2').attr('data-id',jsonData[0].category);
            }
        });
    }

    function nextCat(cat){
        // console.log(catList.length);
        catList.push(cat);
        var url = '{{ url('nextcat') }}';
        $.ajax({
            url: url,
            type: 'POST',
            dataType: 'JSON',
            data:{ catList:catList,
                    "_token": "{{ csrf_token() }}"
                },
            success: function(jsonData) {
                if(catList.length >= jsonData.count){
                    catList = [];
                }
                $('#img1').attr('src',APP_URL +'/images/'+ jsonData.data[0].image);
                $('#img2').attr('src',APP_URL +'/images/'+ jsonData.data[1].image);
                $('#img1').attr('data-id',jsonData.data[0].category);
                $('#img2').attr('data-id',jsonData.data[0].category);
            }
        });
    }
    </script>
</html>
