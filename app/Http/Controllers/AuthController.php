<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\SignUpRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Resources\UserResource;
use App\Http\Services\AuthService;
use App\Models\Account;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    /**
     * Registro de usuario
     */
    /* public function signUp(SignUpRequest $request)
    {
        User::create( $request->validated() );
        // User::create([
        //     'name' => $request->name,
        //     'email' => $request->email,
        //     'password' => bcrypt($request->password)
        // ]);

        return response()->json([
            'message' => 'Successfully created user!'
        ], 201);
    } */

    public function login( LoginRequest $request )
    {
        $authService = new AuthService( $request->email, $request->password, false );
        $loginResponse = $authService->login();

        return response()->json( $loginResponse['data'], $loginResponse['status'] );
    }

    /**
     * Cierre de sesión (anular el token)
     */
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();

        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }

    /**
     * Obtener el objeto User como json
     */
    public function user( Request $request )
    {
        return response()->json( new UserResource( $request->user() ) );
    }

    public function update( UserUpdateRequest $request ) {
        $this->authorize( 'update', User::find( $request->id ) );

        try {
            DB::beginTransaction();

            $user = User::find( $request->id );
            $user->name  = $request->name;
            $user->email = $request->email;
            
            if ( $request->has( 'password' ) ) {
                $user->password = bcrypt( $request->password );
            }

            $user->save();

            Account::find( $request->account_id )->update( [ 'name' => $request->account_name ] );

            DB::commit();

            return response()->json( new UserResource( $user ) );
        } catch (\Throwable $th) {
            return response()->json( $th->getMessage() );
            DB::rollback();
        }
    }

    public function uploadAvatar ( Request $request ) {
        $user = User::find( $request->user_id );
        if($request->file()) {
            $file_name = time().'_'.$request->file->getClientOriginalName();
            $file_path = $request->file('file')->storeAs('uploads/avatars', $file_name, 'public');
            $user->avatar_path = '/storage/' . $file_path;
            $user->save();

            return response()->json( asset( $user->avatar_path ) );
        }

        return response()->json( 'No hay archivo' );
    }
}
