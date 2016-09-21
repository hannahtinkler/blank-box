<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;

use Validator;
use Socialite;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Laravel\Socialite\Two\InvalidStateException;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';
    protected $acceptedEmailDomain = '@mayden.co.uk';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
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
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    public function logout()
    {
        \Auth::logout();
        return redirect('/');
    }

    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from Google.
     *
     * @return Response
     */
    public function handleProviderCallback()
    {
        try {
            $user = Socialite::driver('google')->user();
            $success = $this->registerUserIfNotRegistered($user);
            if ($success) {
                return redirect('/');
            } else {
                return redirect('/accessdenied');
            }
        } catch (InvalidStateException $e) {
            return redirect('/login/retry');
        }
    }
    
    public function accessDeniedPage()
    {
        return view('errors.accessdenied');
    }
    
    public function retryLogin()
    {
        return view('home.retry');
    }
    
    public function registerUserIfNotRegistered($user)
    {
        $eloquentUser = User::where('email', $user->getEmail())->first();

        if (!is_object($eloquentUser)) {
            if (strpos($user->getEmail(), $this->acceptedEmailDomain)) {
                $eloquentUser = User::create([
                    'name' => $user->getName(),
                    'email' => $user->getEmail(),
                    'slug' => str_slug($user->getname()),
                ]);
            } else {
                return false;
            }
        }

        return  \Auth::login($eloquentUser);
    }
}
