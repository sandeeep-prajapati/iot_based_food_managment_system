<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Myuser;

class UserController extends Controller
{
    public function food_search(Request $req)
    {
        // Implement search functionality here if needed
        $latitude = floatval($req->input('latitude'));
        $longitude = floatval($req->input('longitude'));


        $lower_latitude =  round($latitude, 4) - 0.0001;
        $lower_longitude = round($longitude, 4) - 0.0001;

        $upper_latitude =  round($latitude, 4) + 0.0001;
        $upper_longitude = round($longitude, 4) + 0.0001;

        $results = DB::select('SELECT * FROM myusers WHERE latitude > ? AND latitude < ? AND longitude > ? AND longitude < ? AND status =?', [$lower_latitude, $upper_latitude, $lower_longitude, $upper_longitude,1]);

        if ($results) {
            return view('leftOverFood',['data'=>$results]);
        } else {
            return ['lower_latitude'=>$lower_latitude, 'upper_latitude'=>$upper_latitude, 'lower_longitude'=>$lower_longitude, 'upper_longitude'=>$upper_longitude, 'latitude'=>$latitude, 'longitude'=>$longitude];
        }
    }

    public function setup(Request $req)
    {
        // Validate the incoming request data
        $validatedData = $req->validate([
            'foodtype' => 'required|string',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'description' => 'required|string',
            'ssid' => 'required|string',
            'wifiPassword' => 'required|string',
            'image1' => 'required|image',
            'image2' => 'required|image',
            'contactNo' => 'required|numeric|unique:myusers'
        ]);

        // Store the images
        $imageNameImage1 = time().'.'.$req->image1->extension();
        $req->image1->move(public_path('images'), $imageNameImage1);

        $imageNameImage2 = time().'.'.$req->image2->extension();
        $req->image2->move(public_path('images'), $imageNameImage2);
            


        // Create a new Myuser instance and set its properties
        $user = new Myuser();
        $user->foodtype = $validatedData['foodtype'];
        $user->latitude = $validatedData['latitude'];
        $user->longitude = $validatedData['longitude'];
        $user->description = $validatedData['description'];
        $user->ssid = $validatedData['ssid'];
        $user->wifiPassword = $validatedData['wifiPassword'];
        $user->contactNo = $validatedData['contactNo'];
        $user->image1 = 'images/'.$imageNameImage1;
        $user->image2 = 'images/'.$imageNameImage2;
        $user->status = 0;

        // Save the record
        if ($user->save()) {
            // Retrieve the saved record
            $show_data = Myuser::where('contactNo', $validatedData['contactNo'])->get();
            return view('source_code', ['record' => $show_data]);
        } else {
            return back()->withErrors(['error' => 'Failed to save record.']);
        }
    }
}
