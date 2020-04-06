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
        </style>
    </head>
    <body>
    
        <div class="maindiv container">
            <h2> Select best one </h2>
            <div class="row" style="margin: 25px auto;">
                <div class="col-sm-6 col-xs-12" style="margin-bottom: 5px;">
                <!-- "{{asset('distweb/img/images/shop/payment.png')}}" -->
                    <img style="height: 250px; width:400px;" id="img1" data-id="" class="img-responsive img-fluid"  src="" alt="map">
                </div>
                <div class="col-sm-6 col-xs-12">
                    <img style="height: 250px; width:400px;" id="img2" data-id="" class="img-responsive img-fluid"  src=""  alt="map">
                </div>
                
            </div>
        </div>
    </body>
    <script>
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
                console.log(jsonData);
                $('#img1').attr('src',APP_URL +'/images/'+ jsonData[0].image);
                $('#img1').attr('data-id',jsonData[0].category);
                $('#img2').attr('src',APP_URL +'/images/'+ jsonData[1].image);
                $('#img2').attr('data-id',jsonData[0].category);
            }
        });
    }

    function nextCat(cat){
        var url = '{{ url('nextcat') }}';
        $.ajax({
            url: url,
            type: 'POST',
            dataType: 'JSON',
            data:{ cat:cat,
                    "_token": "{{ csrf_token() }}"
                },
            success: function(jsonData) {
                $('#img1').attr('src',APP_URL +'/images/'+ jsonData[0].image);
                $('#img2').attr('src',APP_URL +'/images/'+ jsonData[1].image);
                $('#img1').attr('data-id',jsonData[0].category);
                $('#img2').attr('data-id',jsonData[0].category);
                // $("#img1").attr("onclick",`nextCat("${jsonData[0].category}")`);
                // $("#img2").attr("onclick",`nextCat("${jsonData[0].category}")`);
            }
        });
    }
    </script>
</html>
