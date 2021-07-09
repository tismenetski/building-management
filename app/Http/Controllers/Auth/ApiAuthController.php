<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ApiAuthController extends Controller
{
    public function register (Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'type' => 'integer',
        ]);
        if ($validator->fails())
        {
            return response(['errors'=>$validator->errors()->all()], 422);
        }

        $check_first_user = User::all();
        if (count($check_first_user)<1) {
            Log::info('No users in the database, Creating First User');
            $admin_permission = Permission::where('slug','edit-users')->first();

            $admin_role = new Role();
            $admin_role->slug= 'admin';
            $admin_role->name= 'Administrator';
            $admin_role->save();
            $admin_role->permissions()->attach($admin_permission);

            $editUsers = new Permission();
            $editUsers->slug = 'edit-users';
            $editUsers->name = 'Edit Users';
            $editUsers->save();
            $editUsers->roles()->attach($admin_role);

            $admin_role = Role::where('slug', 'admin')->first();
            $admin_perm = Permission::where('slug','edit-users')->first();


            $admin = new User();
            $admin->name = $request['name'];
            $admin->email = $request['email'];
            $admin->password = Hash::make($request['password']);
            $admin->remember_token = Str::random(10);
            $admin->type = $request['type']? $request['type']  : 0;
            $admin->save();
            $admin->roles()->attach($admin_role);
            $admin->permissions()->attach($admin_perm);

            return response(['data' => $admin , 'message' => 'User Created'],201);
        }





        $request['password']=Hash::make($request['password']);
        $request['remember_token'] = Str::random(10);
        $request['type'] = $request['type'] ? $request['type']  : 0;
        $user = User::create($request->toArray());
        $token = $user->createToken('Laravel Password Grant Client')->accessToken;
        $response = ['token' => $token];
        return response($response, 200);
    }

    public function login (Request $request) {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6',
        ]);
        if ($validator->fails())
        {
            return response(['errors'=>$validator->errors()->all()], 422);
        }
        $user = User::where('email', $request->email)->first();
        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                $token = $user->createToken('Laravel Password Grant Client')->accessToken;
                $response = ['token' => $token];
                return response($response, 200);
            } else {
                $response = ["message" => "Password mismatch"];
                return response($response, 422);
            }
        } else {
            $response = ["message" =>'User does not exist'];
            return response($response, 422);
        }
    }

    public function logout (Request $request) {
        $token = $request->user()->token();
        $token->revoke();
        $response = ['message' => 'You have been successfully logged out!'];
        return response($response, 200);
    }
}
