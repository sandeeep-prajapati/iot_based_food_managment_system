<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Searching for food?</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body style="background-color : #F2E1C1;" onload="getCurrentLocation()">
    <div class="container-fluid">
        <!-- first row -->
        <div class="row">
            <div class="col-md-6">
                <h1 class="text-center text-success pt-4">Food Waste with Our Innovative IoT Solution!</h1>
                <p class="text-danger text-center">Discover real-time leftover food records near you, powered by our cutting-edge IoT system.</p>
                <br><br>
                <p class="text-center">
                    <b>Introduction:</b><br>
                    Welcome to Chirghau Bharat, your go-to platform for finding leftover food in your area. Our revolutionary IoT-based system utilizes ESP8266, ultrasonic sensors, LED lights, and web technology to provide you with location-based, real-time data on food waste. Join us in reducing food waste and making a positive impact on our environment!
                </p>
                <form action="{{ url('food_search') }}" id="location_form" method="get">
                    <label for="latitude">Your Current Latitude</label>
                    <input type="text" class="form-control" id="latitude" name="latitude" placeholder="allow for location to autofill">
                    <br>
                    <label for="longitude">Your Current Longitude</label>
                    <input type="text" class="form-control" id="longitude" name="longitude" placeholder="allow for location to autofill">
                    <br>
                    <button type="submit" class="btn btn-info p-2 form-control">Search Leftover food around it...</button>
                </form>
                <br><br>
                <p class="text-danger text-center">Allow us for location to show you current leftover food. You can reload the page in case you missed the pop-up button.</p>
            </div>
            <div class="col-md-6 p-4">
                <img src="assets/main_images/image2.jpg" style="width: 100%; top:20px; height: auto;" alt="">
            </div>
        </div>
        <br><br><hr class="border"><br><br>

        <!-- second row -->
        <div class="row">
            <div class="col-md-6">
                <img src="assets/main_images/image3.jpeg" style="width: 100%; height: auto;" alt="">
            </div>
            <div class="col-md-6 pt-4">
                <h3><b>Key Features:</b></h3>
                <h5>
                    <ul>
                        <li><b>Real-time Data:</b> Get instant access to leftover food records in your vicinity. Stay up-to-date with the latest information on food waste near you.</li>
                        <li><b>Location-Based:</b> Find food waste near you, with precise location tracking. Our platform shows you exactly where to find leftover food, making it easy to reduce waste.</li>
                        <li><b>IoT-Powered:</b> Our system uses cutting-edge technology to ensure accuracy and efficiency. Our IoT-powered platform provides reliable data and insights to help you make a difference.</li>
                        <li><b>User-Friendly:</b> Easily navigate our platform to find food waste information. Our intuitive design makes it simple for anyone to use and find the information they need.</li>
                    </ul>
                </h5>
            </div>
        </div>
        <br><br><hr><br>
        <div class="row">
            <h2 class="text-warning text-center pt-4">Set-up your own donation box or public indicator</h2><br><br>
        </div>
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form action="{{ url('setup') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <label for="foodtype">Food type</label>
                    <select name="foodtype" class="form-control" id="foodtype">
                        <option value="vegetarian" class="text-success">Vegetarian</option>
                        <option value="non-vegetarian">Non-Vegetarian</option>
                    </select>
                    <br>
                    <label for="contactNo">Contact No</label>
                    <input type="number" class="form-control" id="contactNo" name="contactNo" placeholder="Unique Contact No">
                    <br>
                    <label for="latitude2">Latitude of your Donation box</label>
                    <input type="number" step="0.00000001" class="form-control" id="latitude2" name="latitude" placeholder="allow for location to autofill">
                    <br>
                    <label for="longitude2">Longitude of your Donation box</label>
                    <input type="number" step="0.00000001" class="form-control" id="longitude2" name="longitude" placeholder="allow for location to autofill">
                    <br>
                    <label for="description">Tell us something about the box (Description)</label>
                    <textarea class="form-control" name="description" id="description"></textarea>
                    <br>
                    <label for="ssid">SSID (Hotspot name) to connect your box</label>
                    <input class="form-control" type="text" name="ssid" id="ssid">
                    <br>
                    <label for="wifiPassword">Wifi Password</label>
                    <input class="form-control" type="text" name="wifiPassword" id="wifiPassword">
                    <br>
                    <label for="image1">Upload image of your box with a proper landmark in the background</label>
                    <br><br>
                    First image of box: <input type="file" name="image1">
                    <br>
                    Second image of box: <input type="file" name="image2">
                    <br><br>
                    <input type="submit" class="text-dark btn btn-warning form-control">
                </form>
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        function getCurrentLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    const latitudeInput = document.getElementById('latitude');
                    const longitudeInput = document.getElementById('longitude');
                    const latitudeInput2 = document.getElementById('latitude2');
                    const longitudeInput2 = document.getElementById('longitude2');

                    // Fill in the input fields with the obtained location
                    latitudeInput.value = position.coords.latitude;
                    longitudeInput.value = position.coords.longitude;
                    latitudeInput2.value = position.coords.latitude;
                    longitudeInput2.value = position.coords.longitude;
                }, function(error) {
                    // Handle geolocation error
                    console.error('Geolocation error:', error);
                });
            } else {
                console.error('Geolocation is not supported by this browser.');
            }
        }
    </script>
</body>

</html>
