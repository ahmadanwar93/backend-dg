<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdatePermissionsRequest;
use App\Http\Resources\PermissionResource;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{
    /**
     * Handle the incoming request.
     */

    public function show($userId){
        $user = User::find($userId);
        if (!$user) {
            return response()->json(
                [
                    'message' => "The user id passed does not correspond to a user"
                ],
                404
            );
        }

        return response()->json(
            [
                'message' => "The user's permission to be displayed are",
                'data' => [
                    "user_id" => $userId,
                    "permissions" => PermissionResource::collection($user->getAllPermissions()) 
                ]
            ],
            200
        );

    }

    public function update(UpdatePermissionsRequest $request, $userId)
    {
        $user = User::find($userId);
        if (!$user) {
            return response()->json(
                [
                    'message' => "The user id passed does not correspond to a user"
                ],
                404
            );
        }

        // Only user with free role can update the permission
        if (!$user->hasRole('free-role')) {
            return response()->json(
                [
                    'message' => "The user is not allowed to update the resource"
                ],
                404
            );
        }

        // update permission for the free-role
        $role = Role::find(3);
        $role->syncPermissions($request->input('permissions'));

        return response()->json(
            [
                'message' => "The user's permission has been updated",
                'data' => [
                    "user_id" => $userId,
                    "permissions" => PermissionResource::collection($user->getAllPermissions()) 
                ]
            ],
            200
        );
        
    }
}
