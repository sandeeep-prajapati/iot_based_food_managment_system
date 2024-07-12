<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>your code to upload</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body style="background-color : #F2E1C1;" onload="getCurrentLocation()">
    <div class="row">
        <h3 class="text-danger p-4 text-center">
            all remaining food around yours are listed below
        </h3>
        @foreach ($data as $d)
        <div class="row">
            <hr>
            <br>
            <div class="col-md-4">
                <iframe width="100%" height="100%" src="https://google.com/maps?q={{$d->latitude}},{{$d->longitude}}&h1=es;z=14&output=embed">
                </iframe>
            </div>
            <div class="col-md-4">
                <h4>Type of food : {{$d->foodtype}}</h4>
                <p>Discription : {{$d->description}}</p>
                <p>Contact No : {{$d->contactNo}}</p>
            </div>
            <div class="col-md-4">
                <div id="carouselExampleRide" class="carousel slide" data-bs-ride="true">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="{{$d->image1}}" class="d-block w-100" alt="first image">
                        </div>
                        <div class="carousel-item">
                            <img src="{{$d->image2}}" class="d-block w-100" alt="second image">
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleRide" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleRide" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
            <br>
            <hr>
            <br>
        </div>
        @endforeach

    </div>
</body>

</html>