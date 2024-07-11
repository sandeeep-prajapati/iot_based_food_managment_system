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
        $image1Path = $req->file('image1')->store('public/images');
        $image2Path = $req->file('image2')->store('public/images');

        // Create a new Myuser instance and set its properties
        $user = new Myuser();
        $user->foodtype = $validatedData['foodtype'];
        $user->latitude = $validatedData['latitude'];
        $user->longitude = $validatedData['longitude'];
        $user->description = $validatedData['description'];
        $user->ssid = $validatedData['ssid'];
        $user->wifiPassword = $validatedData['wifiPassword'];
        $user->contactNo = $validatedData['contactNo'];
        $user->image1 = $image1Path;
        $user->image2 = $image2Path;
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
