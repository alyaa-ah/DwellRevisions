<?php

namespace App\Http\Controllers\Login;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\Client;
use App\Http\Controllers\Audit\AuditController;
class LoginController extends Controller
{
    public function loginClient(Request $request){
        $validator = Validator::make($request->all(), [
            'username' =>'required|string|max:30',
            'password' => 'required|min:6|max:50',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'message' => $validator->getMessageBag()
                ]);
            }else{
                $username = $request->input('username');
                $client = Client::where('username', $username)->first();
                if(!$client){
                    return 404;
                }
                if($client->status == 'Inactive'){
                    return 402;
                }else{
                    if ($client) {
                        if(Hash::check($request->password, $client->password)){
                            if ($client->role === 'SuperAdmin') {
                                $request->session()->put('loggedInSuperAdmin', [
                                    'id' => $client->id,
                                    'fullname' => $client->fullname,
                                    'email' => $client->email,
                                    'username' => $client->username,
                                    'role' => $client->role,
                                    'agency' => $client->agency,
                                    'contact' => $client->contact,
                                    'address' => $client->address,
                                    'position' => $client->position
                                ]);
                                $client_id = session()->get('loggedInSuperAdmin')['id'];
                                $fullname = session()->get('loggedInSuperAdmin')['fullname'];
                                $role = session()->get('loggedInSuperAdmin')['role'];
                                $activity = "Logged in into the system.";
                                (new AuditController)->createAuditTrail($fullname ,$client_id, $activity , $role);
                                return 1;
                            }else if($client->role === 'AdminGH') {
                                $request->session()->put('loggedInAdminGH', [
                                    'id' => $client->id,
                                    'fullname' => $client->fullname,
                                    'email' => $client->email,
                                    'username' => $client->username,
                                    'role' => $client->role,
                                    'agency' => $client->agency,
                                    'contact' => $client->contact,
                                    'address' => $client->address,
                                    'position' => $client->position
                                ]);
                                $client_id = session()->get('loggedInAdminGH')['id'];
                                $fullname = session()->get('loggedInAdminGH')['fullname'];
                                $role = session()->get('loggedInAdminGH')['role'];
                                $activity = "Logged in into the system.";
                                (new AuditController)->createAuditTrail($fullname ,$client_id, $activity , $role);
                                return 2;
                            }else if($client->role === 'AdminSH') {
                                $request->session()->put('loggedInAdminSH', [
                                    'id' => $client->id,
                                    'fullname' => $client->fullname,
                                    'email' => $client->email,
                                    'username' => $client->username,
                                    'role' => $client->role,
                                    'agency' => $client->agency,
                                    'contact' => $client->contact,
                                    'address' => $client->address,
                                    'position' => $client->position
                                ]);
                                $client_id = session()->get('loggedInAdminSH')['id'];
                                $fullname = session()->get('loggedInAdminSH')['fullname'];
                                $role = session()->get('loggedInAdminSH')['role'];
                                $activity = "Logged in into the system.";
                                (new AuditController)->createAuditTrail($fullname ,$client_id, $activity , $role);
                                return 4;
                            }else if($client->role === 'AdminDFTC') {
                                $request->session()->put('loggedInAdminDftc', [
                                    'id' => $client->id,
                                    'fullname' => $client->fullname,
                                    'email' => $client->email,
                                    'username' => $client->username,
                                    'role' => $client->role,
                                    'agency' => $client->agency,
                                    'contact' => $client->contact,
                                    'address' => $client->address,
                                    'position' => $client->position
                                ]);
                                $client_id = session()->get('loggedInAdminDftc')['id'];
                                $fullname = session()->get('loggedInAdminDftc')['fullname'];
                                $role = session()->get('loggedInAdminDftc')['role'];
                                $activity = "Logged in into the system.";
                                (new AuditController)->createAuditTrail($fullname ,$client_id, $activity , $role);
                                return 5;
                            }else{
                                $request->session()->put('loggedInCustomer', [
                                    'id' => $client->id,
                                    'fullname' => $client->fullname,
                                    'email' => $client->email,
                                    'username' => $client->username,
                                    'role' => $client->role,
                                    'agency' => $client->agency,
                                    'contact' => $client->contact,
                                    'address' => $client->address,
                                    'position' => $client->position
                                ]);
                                $client_id = session()->get('loggedInCustomer')['id'];
                                $fullname = session()->get('loggedInCustomer')['fullname'];
                                $role = session()->get('loggedInCustomer')['role'];
                                $activity = "Logged in into the system.";
                                (new AuditController)->createAuditTrail($fullname ,$client_id, $activity , $role);
                                return 3;
                            }

                        }else{
                            return 401;
                        }
                    }else{
                        return 404;
                    }
                }
            }
    }
}
