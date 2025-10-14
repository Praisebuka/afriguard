<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Throwable;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Handle user login
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $req)
    {
        // dd($req->all());
            
        try { 

            # Validate req
            $req->validate([
                'email' => 'required|email',
                'password' => 'required|string|min:6',
            ]);

            #Check if user exists and password is correct
            $user = User::where('email', $req->email)->first();
            if (!$user || !Hash::check($req->password, $user->password)) {
                return response()->json([ 'message' => 'Invalid credentials' ], 401);
            }

            #Check if email is verified
            if ($user->email_verified_at === null) {
                return response()->json([ 'message' => 'Please verify your email address' ], 403);
            }

            #Generate API token using Passport
            $token = $user->createToken('Personal Access Token')->accessToken;

            return response()->json([ 'message' => 'Login Successful', 'user' => $user, 'token' => $token ], 200);
            
        } catch (Throwable $th) {
            return response()->json(['status' => 500, 'message' => $th->getMessage()]);
        }
    }


    /**
     * Handle user registration
     *
     * @param Request $req
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $req)
    {
        try {

            # Validate req
            $req->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|min:8',
                'phone' => 'nullable|string|max:20',
            ]);

            # Create user
            $user = User::create([
                'name' => $req->name,
                'email' => $req->email,
                'password' => $req->password, # Automatically hashed by setPasswordAttribute
                'phone' => $req->phone,
            ]);

            #Trigger Registered event (for email verification
            event(new Registered($user));

            # Generate API token using Passport
            $token = $user->createToken('Personal Access Token')->accessToken;

            return response()->json([ 'message' => 'Registration Successful', 'user' => $user, 'token' => $token ], 201);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([ 'status' => 'error', 'message' => 'Validation failed.', 'errors' => $e->errors(), ], 422);
        } catch (\Throwable $th) {
            Log::error('Registration failed: ' . $th->getMessage());

            return response()->json([ 'status' => 'error', 'message' => $th->getMessage(), ], 500);
        }
    }

}
