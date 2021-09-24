<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;

class UserController extends Controller
{

    public function signUp(Request $request)
    {
        if (is_null($request->header('name'))) {
            $res = [
                'status' => false,
                'message' => "name can't be null "
            ];

            return response()->json($res);
        }
        if (is_null($request->header('email'))) {
            $res = [
                'status' => false,
                'message' => "email can't be null "
            ];

            return response()->json($res);
        }
        if (is_null($request->header('password'))) {
            $res = [
                'status' => false,
                'message' => "password can't be null "
            ];

            return response()->json($res);
        }
        $data = [
            'name' => $request->header('name'),
            'email' => $request->header('email'),
            'password' => $request->header('password'),
            'userId' => $request->header('name') . "_" . time()
        ];
        $oldUser = User::where('email', $request->header('email'))->first();
        if ($oldUser == null) {
            $newUser = User::create($data);
            $newUser->save();
            $res = [
                'status' => true,
                'message' => 'user was added',
                'data' => [

                    'user_id' => $newUser->userId
                ]
            ];
            return response()->json($res);
        }
        $res = [
            'status' => false,
            'message' => 'email is exists'
        ];

        return response()->json($res);
    }

    ////////////////////

    public function signIn(Request $request)
    {
        if (is_null($request->header('email'))) {
            $res = [
                'status' => false,
                'message' => "email can't be null "
            ];

            return response()->json($res);
        }
        if (is_null($request->header('password'))) {
            $res = [
                'status' => false,
                'message' => "password can't be null "
            ];

            return response()->json($res);
        }
        $data = [
            'email' => $request->header('email'),
            'password' => $request->header('password'),
        ];
        $user = User::where('email', $data['email'])->first();
        if (!is_null($user)) {
            if ($user['password'] == $data['password']) {
                $res = [
                    'status' => true,
                    'message' => 'user was found',
                    'data' => [
                        'user_id' => $user['userId']
                    ]
                ];
                return response()->json($res);
            }
            $res = [
                'status' => false,
                'message' => 'password is incorrect'

            ];
            return response()->json($res);
        }

        $res = [
            'status' => false,
            'message' => 'user Not Found'
        ];

        return response()->json($res);
    }

    ////////////////////

    public function editEmail(Request $request)
    {
        if (is_null($request->header('email'))) {
            $res = [
                'status' => false,
                'message' => "email can't be null "
            ];

            return response()->json($res);
        }
        if (is_null($request->header('userId'))) {
            $res = [
                'status' => false,
                'message' => "userId can't be null "
            ];

            return response()->json($res);
        }
        $data = [
            'email' => $request->header('email'),
            'userId' => $request->header('userId'),
        ];
        $oldUser = User::where('userId', $data['userId'])->first();
        if (!is_null($oldUser)) {
            $exists = User::where('email', $data['email'])->first();
            if (!is_null($exists)) {

                $res = [
                    'status' => true,
                    'message' => 'This Email Cannot be used , Choose another Email',
                ];

                return response()->json($res);
            }
            User::where('userId', $data['userId'])
                ->update(['email' => $data['email']]);

            $res = [
                'status' => true,
                'message' => 'email has changed'

            ];
            return response()->json($res);
        }

        $res = [
            'status' => false,
            'message' => 'userId Not Found'
        ];

        return response()->json($res);
    }

    ////////////////////

    public function editPassword(Request $request)
    {
        if (is_null($request->header('password'))) {
            $res = [
                'status' => false,
                'message' => "password can't be null "
            ];

            return response()->json($res);
        }
        if (is_null($request->header('userId'))) {
            $res = [
                'status' => false,
                'message' => "userId can't be null "
            ];

            return response()->json($res);
        }
        $data = [
            'password' => $request->header('password'),
            'userId' => $request->header('userId'),
        ];
        $oldUser = User::where('userId', $data['userId'])->first();
        if (!is_null($oldUser)) {
            User::where('userId', $data['userId'])
                ->update(['password' => $data['password']]);

            $res = [
                'status' => true,
                'message' => 'password has changed'

            ];
            return response()->json($res);
        }

        $res = [
            'status' => false,
            'message' => 'userId Not Found'
        ];

        return response()->json($res);
    }

    ////////////////////

    public function editName(Request $request)
    {
        if (is_null($request->header('name'))) {
            $res = [
                'status' => false,
                'message' => "name can't be null "
            ];

            return response()->json($res);
        }
        if (is_null($request->header('userId'))) {
            $res = [
                'status' => false,
                'message' => "userId can't be null "
            ];

            return response()->json($res);
        }
        $data = [
            'name' => $request->header('name'),
            'userId' => $request->header('userId'),
        ];
        $oldUser = User::where('userId', $data['userId'])->first();
        if (!is_null($oldUser)) {
            User::where('userId', $data['userId'])
                ->update(['name' => $data['name']]);

            $res = [
                'status' => true,
                'message' => 'name has changed'

            ];
            return response()->json($res);
        }

        $res = [
            'status' => false,
            'message' => 'userId Not Found'
        ];

        return response()->json($res);
    }
    
}
