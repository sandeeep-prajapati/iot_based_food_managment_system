<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Myuser;

class alarmController extends Controller
{
    public function zero_status(Request $request, $id)
    {
        $user = Myuser::find($id);
        if ($user) {
            $user->status = 0;
            $result = $user->save();
            if ($result) {
                return response()->json(['success' => 'Status changed successfully']);
            } else {
                return response()->json(['fail' => 'Status change failed']);
            }
        } else {
            return response()->json(['error' => 'User not found']);
        }
    }
    public function on_led_light(Request $req)
    {
        $latitude = floatval($req->input('latitude'));
        $longitude = floatval($req->input('longitude'));


        $lower_latitude =  round($latitude, 4) - 0.0001;
        $lower_longitude = round($longitude, 4) - 0.0001;

        $upper_latitude =  round($latitude, 4) + 0.0001;
        $upper_longitude = round($longitude, 4) + 0.0001;

        $results = DB::select('SELECT * FROM myusers WHERE latitude > ? AND latitude < ? AND longitude > ? AND longitude < ? AND status=?', [$lower_latitude, $upper_latitude, $lower_longitude, $upper_longitude,1]);

        if ($results) {
            return 1;
        } else {
            return 0;
        }
    }
}






// http://127.0.0.1:8000/on_led_light?latitude=27.1304175&longitude=83.5389898
