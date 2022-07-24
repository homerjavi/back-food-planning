<?php 

namespace App\Http\Services;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class AuthService
{
    protected $user;
    protected string $email;
    protected string $password;
    protected bool $rememberMe;

    function __construct( string $email, string $password, bool $rememberMe = false )
    {
        $this->email      = $email;    
        $this->password    = $password;    
        $this->rememberMe = $rememberMe;    
    }

    public function getUser () {
        return User::whereEmail( $this->email )->first();
    }

    public function login () {

        $this->user = $this->getUser();

        if ( !$this->user ) {
            return [ 'status' => 401, 'data' => [ 'error' => 'Usuario no encontrado' ] ];
        }

        if ( !Auth::attempt( [ 'email' => $this->email, 'password' => $this->password ] ) ) {
            return [ 'status' => 401, 'data' => ['error' => 'Contraseña invalida' ] ];
        }

        $token = $this->getNewToken();

        return [ 'status' => 200, 'data' => [ 'username' => $this->user->name , 'token' => $token ] ];
    }

    public function getNewToken ( User $user = null, $rememberMe = false ) {
        $this->user = $user ?: $this->user;
        $this->rememberMe = $rememberMe ?: $this->rememberMe;
        $tokenResult = $this->user->createToken('Personal Access Token');

        $token = $tokenResult->token;
        if ( $rememberMe )
            $token->expires_at = Carbon::now()->addWeeks(1);

        $token->save();

        return $tokenResult->accessToken;
    }
}
