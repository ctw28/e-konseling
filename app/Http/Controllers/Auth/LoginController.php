<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\User;
use Illuminate\Support\Str;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function showLoginForm()
    {
        return view('user.login');
    }

    public function login(Request $request)
    {   
        $input = $request->all();
        // dd($input);
        $this->validate($request, [
            'nim' => 'required',
            'password' => 'required',
        ]);


        $response = Http::asForm()->withOptions(['verify' => false,])->post('https://sia.iainkendari.ac.id/konseling_api/login_mhs',[
            'nim' => $input['nim'],
            'password' => $input['password'],
        ]);
        // return $input['nim'];
        if($response->json()['status']){            
            $iddata = $response->json()['data'][0]['iddata'];
            // return $iddata;
            $user = User::where('iddata', $iddata)->first();
            if($user==null){
                User::create(['iddata'=> $iddata, "password"=>bcrypt('1234qwer'), 'user_role_id'=>1]);
            }
            if(auth()->attempt(array('iddata' => $iddata, 'password' => "1234qwer")))
            {
                return redirect()->route('user.dashboard');
                // if (auth()->user()->iddata == 1) {
                //     return redirect()->route('assesment.form');
                // }else{
                //     return redirect()->route('assesment.form');
                // }
            }else{
                return redirect()->route('login')->with('error','Anda belum terdaftar.');
            }
        }
        // return $response->body();
        return redirect()->route('login')->with('error','Email-Address And Password Are Wrong.');
          
    }
}