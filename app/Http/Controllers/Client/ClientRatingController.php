<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Audit\AuditController;
use App\Models\Client;
use Carbon\Carbon;
use App\Models\GuestHouseBooking;
use App\Models\StaffHouseBooking;
use App\Models\DftcBooking;
class ClientRatingController extends Controller
{
    public function setRatingGuestHouse(Request $request){
        $validator = Validator::make($request->all(), [
            'rating' => 'required|integer|min:1|max:5',
            'feedback' => 'nullable|string|max:500',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()
            ]);
        }
        $date = Carbon::now('Asia/Manila')->format('F j, Y');
        $update = GuestHouseBooking::where('id', $request->booking_id)->update([
            'ratings' => $request->rating,
            'feedbacks' => ucwords($request->feedback),
            'comment_date' => $date,
            'anonymous' => $request->anonymous
        ]);

        if ($update) {
            return response()->json([
                'message' => 'Your feedback submitted successfully. Thank you!',
                'status' => 200,
            ], 200);
        }
        return response()->json([
            'message' => 'Failed to update rating',
            'status' => 500,
        ], 500);
    }
    public function setRatingStaffHouse(Request $request){
        $validator = Validator::make($request->all(), [
            'rating' => 'required|integer|min:1|max:5',
            'feedback' => 'nullable|string|max:500',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()
            ]);
        }
        $date = Carbon::now('Asia/Manila')->format('F j, Y');
        $update = StaffHouseBooking::where('id', $request->booking_id)->update([
            'ratings' => $request->rating,
            'feedbacks' => ucwords($request->feedback),
            'comment_date' => $date,
            'anonymous' => $request->anonymous
        ]);

        if ($update) {
            return response()->json([
                'message' => 'Your feedback submitted successfully. Thank you!',
                'status' => 200,
            ], 200);
        }
        return response()->json([
            'message' => 'Failed to update rating',
            'status' => 500,
        ], 500);
    }
    public function setRatingDftc(Request $request){
        $validator = Validator::make($request->all(), [
            'rating' => 'required|integer|min:1|max:5',
            'feedback' => 'nullable|string|max:500',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()
            ]);
        }
        $date = Carbon::now('Asia/Manila')->format('F j, Y');
        $update = DftcBooking::where('id', $request->booking_id)->update([
            'ratings' => $request->rating,
            'feedbacks' => ucwords($request->feedback),
            'comment_date' => $date,
            'anonymous' => $request->anonymous
        ]);

        if ($update) {
            return response()->json([
                'message' => 'Your feedback submitted successfully. Thank you!',
                'status' => 200,
            ], 200);
        }
        return response()->json([
            'message' => 'Failed to update rating',
            'status' => 500,
        ], 500);
    }
}
