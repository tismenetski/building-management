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
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'type' => 'integer',
        ]);
        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422);
        }

        $check_first_user = User::all();
        if (count($check_first_user) < 1) {
            Log::info('No users in the database, Creating First User Who is Admin By Default');
            $admin = $this->adminRole($request);
            return response(['data' => $admin, 'message' => 'Admin Created'], 201);
        }
        $user = $this->userRole($request);
        return response(['data' => $user, 'message' => 'User Created'], 201);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6',
        ]);
        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422);
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
            $response = ["message" => 'User does not exist'];
            return response($response, 422);
        }
    }

    public function logout(Request $request)
    {
        $token = $request->user()->token();
        $token->revoke();
        $response = ['message' => 'You have been successfully logged out!'];
        return response($response, 200);
    }

    public function adminRole($request)
    {

        // Admin have permissions, therefore we need to create permissions array
        $permissions = [['edit-users', 'Edit Users'],
            ['edit-payments', 'Edit Payments'],
            ['edit-expenses', 'Edit Expenses'],
            ['edit-apartments', 'Edit Apartments'],
            ['edit-residents', 'Edit Residents'],
            ['edit-protocols', 'Edit Protocols']];

        $permission_query = [];
        foreach ($permissions as $permission) {
            Log::info('Permissions : ', [$permission]);
            $result = Permission::where('slug', $permission[0])->first();
            Log::info($result);
            $permission_query[] = $result;
        }

        // Admin role - We create a new role called admin, then we save it to database.afterwards, we
        $admin_role = new Role();
        $admin_role->slug = 'admin';
        $admin_role->name = 'Administrator';
        $admin_role->save();
        foreach ($permission_query as $item) {
            $admin_role->permissions()->attach($item);
        }

        // iterate through each permission and attach it to the role
        foreach ($permissions as $permission) {
            $this->permissions($admin_role, $permission);

        }

        // create new user, parse data from the request, then after saving the entity in the DB,we attach the user the role and the permissions
        $user = new User();
        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->password = Hash::make($request['password']);
        $user->remember_token = Str::random(10);
        $user->type = 1;
        $user->save();
        $user->roles()->attach($admin_role);


        $permission_query = [];
        foreach ($permissions as $permission) {
            Log::info('Permission For User: ', [$permission]);
            $result = Permission::where('slug', $permission[0])->first();
            Log::info($result);
            $permission_query[] = $result;
        }


        foreach ($permission_query as $item) {
            $user->permissions()->attach($item);
        }
        return $user;


    }

    public function userRole($request){
        // Users have permissions, therefore we need to create permissions array
//        $permissions = [
//            ['watch-payments', 'Watch Payments'],
//            ['watch-expenses', 'Watch Expenses'],
//            ['watch-apartments', 'Watch Apartments'],
//            ['watch-residents', 'Watch Residents'],
//            ['watch-protocols', 'Watch Protocols']];

        $permissions = [];
        $permission_query = [];
        foreach ($permissions as $permission) {
            Log::info('Permissions : ', [$permission]);
            $result = Permission::where('slug', $permission[0])->first();
            Log::info($result);
            $permission_query[] = $result;
        }

        // Admin role - We create a new role called admin, then we save it to database.afterwards, we
        $user_role = new Role();
        $user_role->slug = 'user';
        $user_role->name = 'User';
        $user_role->save();
        foreach ($permission_query as $item) {
            $user_role->permissions()->attach($item);
        }

        // iterate through each permission and attach it to the role
        foreach ($permissions as $permission) {
            $this->permissions($user_role, $permission);

        }

        // create new user, parse data from the request, then after saving the entity in the DB,we attach the user the role and the permissions
        $user = new User();
        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->password = Hash::make($request['password']);
        $user->remember_token = Str::random(10);
        $user->type = 0;
        $user->save();
        $user->roles()->attach($user_role);


        $permission_query = [];
        foreach ($permissions as $permission) {
            Log::info('Permission For User: ', [$permission]);
            $result = Permission::where('slug', $permission[0])->first();
            Log::info($result);
            $permission_query[] = $result;
        }


        foreach ($permission_query as $item) {
            $user->permissions()->attach($item);
        }
        return $user;

    }

    public function permissions($role, $permission)
    {
        Log::info('function permissions, printing incoming permssion: ',[$permission]);
        $new_permission = new Permission();
        $new_permission->slug = $permission[0];
        $new_permission->name = $permission[1];
        $new_permission->save();
        $new_permission->roles()->attach($role);
    }
}
