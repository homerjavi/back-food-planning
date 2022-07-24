<?php

namespace App\Http\Controllers;

use App\Http\Requests\AccountStoreRequest;
use App\Http\Services\AuthService;
use App\Models\Account;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AccountController extends Controller
{
    public function __construct()
    {
        // $this->authorizeResource(Account::class, 'account', [ 'except' => ['index', 'store'] ]);
    }

    public function store ( AccountStoreRequest $request ) {
        try {
            DB::beginTransaction();
            
            $newAccount = Account::create( [ 'name' => $request->account ] );
        
            $newUser = User::create([
                'name'       => $request->name,
                'email'      => $request->email,
                'password'   => bcrypt($request->password),
                'account_id' => $newAccount->id,
            ]);

            DB::commit();
            
            $authService = new AuthService( $request->email, $request->password, false );
            $loginResponse = $authService->login();

            return response()->json( $loginResponse['data'], $loginResponse['status'] );
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json( $th->getMessage() );
        }        
    }
}
