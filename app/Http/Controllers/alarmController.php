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
}
