<?php

namespace App\Http\Controllers\Auth;

use Auth;
use Validator;
use Socialite;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Two\InvalidStateException;

use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

use App\Models\User;

class AuthController extends Controller
{
    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * @var string
     */
    protected $redirectTo = '/';

    /**
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

    /**
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        Auth::logout();

        return redirect('/');
    }

    /**
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
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
    
    /**
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function accessDeniedPage()
    {
        return view('errors.accessdenied');
    }
    
    /**
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function retryLogin()
    {
        return view('home.retry');
    }
    
    /**
     * @param  User $user
     * @return boolean
     */
    public function registerUserIfNotRegistered($user)
    {
        $eloquentUser = User::where('email', $user->getEmail())->first();

        if (!$eloquentUser) {
            $eloquentUser = User::create([
                'name' => $user->getName(),
                'email' => $user->getEmail(),
                'slug' => str_slug($user->getname()),
            ]);
        }

        Auth::login($eloquentUser);

        return $eloquentUser;
    }
}
