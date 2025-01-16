<?php

namespace App\Http\Controllers\Register;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Email\EmailController;
use App\Http\Controllers\Audit\AuditController;
use App\Models\Client;
class RegisterController extends Controller
{
    public function registerClient(Request $request){
        $validator = Validator::make($request->all(), [
            'fullname' => 'required|min:6|max:100',
            'position' => 'required',
            'agency' => 'required',
            'contact' => 'required|min:10|max:10',
            'address' => 'required|min:6|max:100',
            'email' => [
                'required',
                'email',
                'max:100',
                'unique:clients,email',
                'regex:/^[a-zA-Z0-9._%+-]+@gmail\.com$/',
            ],
            'username' => 'required|min:6|max:30|unique:clients,username',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()
            ]);
        } else {
            $userCount = Client::count();
            $role = $userCount == 0 ? "SuperAdmin" : "Customer";
            $generatedPassword = $this->generatePassword(10);
            $client = new Client();
            $client->fullname = ucwords($request->get('fullname'));
            $client->position = $request->get('position');
            $client->agency = ucwords($request->get('agency'));
            $client->contact = $request->get('country_code') . $request->get('contact');
            $client->address = ucwords($request->get('address'));
            $client->email = $request->get('email');
            $client->username = $request->get('username');
            $client->password = Hash::make($generatedPassword);
            $client->status = "Active";
            $client->role = $role;
            $client->save();
            $activity = "Registered in the system";
            (new AuditController)->createAuditTrail($client->fullname , $client->id, $activity , $client->role);
            (new EmailController)->sendEmailPassword($client->email, $generatedPassword, $client->fullname);
            return !is_null($client) ? 1 : 0;
        }
    }
    private function generatePassword($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    public function forgotPassword(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => [
                'required',
                'email',
                'regex:/^[a-zA-Z0-9._%+-]+@gmail\.com$/',
            ],
        ]);
        if ($validator->fails()) {
            return response()->json([
               'message' => $validator->errors(),
            ]);
        } else {
            $client = Client::where('email', $request->get('email'))->first();
            if($client){
                $generatedPassword = $this->generatePassword(10);
                $client->password = Hash::make($generatedPassword);
                $client->save();
                (new EmailController)->forgotPassword($client->email, $client->fullname, $generatedPassword);

                if ($client){
                    return 200;
                }
                return 500;
            }else{
                return 404;
            }

        }
    }
}
