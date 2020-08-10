<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Invitation;
use App\Providers\RouteServiceProvider;
use App\User;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

trait RegisterUsersWithInvitation{
    use RegistersUsers;

    public function showRegistrationForm(Request $request)
    {
        $token = $request->get('token');
        $invitation = Invitation::where('token', $token)->where('registered_at', null)->firstOrFail();
        $email = $invitation->email;

        return view('auth.register', ['email' => $email, 'token' => $token]);
    }

    public function register(Request $request)
    {
        $invitation = Invitation::where('token', $request->get('token'))
            ->where('registered_at', null)
            ->where('email', $request->get('email'))
            ->firstOrFail();

        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        $this->guard()->login($user);

        if ($response = $this->registered($request, $user, $invitation)) {
            return $response;
        }

        return $request->wantsJson()
            ? new Response('', 201)
            : redirect($this->redirectPath());
    }

    protected function registered(Request $request, $user, Invitation $invitation)
    {
        $invitation->registered_at = Carbon::now()->toDateTimeString();
        $invitation->save();
    }
}

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegisterUsersWithInvitation;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed']
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
