<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Repository\UserRepositoryInterface;
use App\Http\Requests\AddTeamRequest;
use App\Http\Requests\FollowUserRequest;

class UserController extends Controller
{

    protected $userRepository;
    function __construct(UserRepositoryInterface $userRepository) {
        $this->userRepository = $userRepository;
    }


    public function followUser(FollowUserRequest $request){
        return $this->userRepository->followUser($request);
    }

    public function toggleFollowUser(Request $request) {
        try {
          $followers =  $this->userRepository->toggleFollowUser($request);
          return response()->json($followers);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage() ,'status' => 500]);
        }
    }

    public function getAllUsers(Request $request) {
       try {
          $users =  $this->userRepository->getAllUsers($request);
          return response()->json($users);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage() ,'status' => 500]);
        }
    }

    public function addTeam(AddTeamRequest $request) {
        try {
          $team =  $this->userRepository->addTeam($request);
          return response()->json($team);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage() ,'status' => 500]);
        }
    }

    public function setRole(Request $request) {
        try {
          $role =  $this->userRepository->setRole($request);
          return response()->json($role);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage() ,'status' => 500]);
        }
    }

    public function getMyRoles(Request $request) {
       try {
          $roles =  $this->userRepository->getMyRoles($request);
          return response()->json($roles);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage() ,'status' => 500]);
        } 
    }

    public function SwitchBetweenRoles(Request $request) {
       try {
          $account =  $this->userRepository->SwitchBetweenRoles($request);
          return response()->json($account);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage() ,'status' => 500]);
        } 
    }

    public function getUserProfile($id) {
       try {
          $profile =  $this->userRepository->getUserProfile($id);
          return response()->json($profile);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage() ,'status' => 500]);
        }  
    }
}