<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;

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

    use RegistersUsers;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/admin/home';

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
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name'     => 'required|max:255',
            'email'    => 'required|email|max:255|unique:users',
            'phone'    => 'required|max:255',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return User
     */

    // public function register(Request $request){

    //     $validatedData = $request->validate([
    //         'name'     => 'required|string|max:255',
    //         'email'    => 'required|string|email|max:255|unique:users',
    //         'phone'    => 'required|max:255',
    //         'password' => 'required|string|min:6|confirmed',
    //     ]);

    //     try {
    //         $validatedData['password']        = bcrypt(array_get($validatedData, 'password'));
    //         $validatedData['approved']        =1;
    //         $user                             = User::create($validatedData);
    //         $user->role()->attach(config('app_service.default_role_id'));
    //     } catch (\Exception $exception) {
    //         logger()->error($exception);
    //         return redirect()->back()->with('message', 'Unable to create new user.');
    //     }
    //     return $user;
    //     return redirect()->back()->with('message', 'Successfully created a new account. Please check your email and activate your account.');

    //     // Validator::make($data, [
    //     //     'name'     => 'required|max:255',
    //     //     'email'    => 'required|email|max:255|unique:users',
    //     //     'phone'    => 'required|max:255',
    //     //     'password' => 'required|min:6|confirmed',
    //     // ]);
    //     // $user = User::create([
    //     //     'name'     => $data['name'],
    //     //     'email'    => $data['email'],
    //     //     'phone'    => $data['phone'],
    //     //     'password' => bcrypt($data['password']),
    //     // ]);

    //     // $user->role()->attach(config('app_service.default_role_id'));

    //     // return $user;
    // }
    protected function create(array $data)
    {
        $user = User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'phone'    => $data['phone'],
            'approved' => 1,
            'password' => bcrypt($data['password']),
        ]);

        $user->role()->attach(config('app_service.default_role_id'));

        return $user;
    }
}
