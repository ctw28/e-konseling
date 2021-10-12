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
        $this->validate($request, [
            'user' => 'required',
            'password' => 'required',
        ]);
        $input = $request->all();
        
        if($input['kategori']=="admin"){
            if(auth()->attempt(array('iddata' => $input['user'], 'password' => "1234qwer")))
                return redirect()->route('admin.dashboard');
            return redirect()->route('login')->with('error','Anda belum terdaftar.');
        }else{
            if($input['kategori']=="konselor"){
                $data = [
                    "url" => "https://sia.iainkendari.ac.id/konseling_api/login_konselor",
                    "user" => "nip",
                    "id" => "idpegawai",
                    "redirect" => "konselor.dashboard",
                    "role" => 2  
                ];
            }
            if($input['kategori']=="mahasiswa"){
                $data = [
                    "url" => "https://sia.iainkendari.ac.id/konseling_api/login_mhs",
                    "user" => "nim",
                    "id" => "iddata",
                    "redirect" => "user.dashboard",
                    "role" => 3  
                ];
            }        
            $response = Http::asForm()->withOptions(['verify' => false,])->post($data['url'],[
                $data['user'] => $input['user'],
                'password' => $input['password'],
            ]);

            if($response->json()['status']){
                $id = $response->json()['data'][0][$data['id']];
                $user = User::where('iddata', $id)->first();
                if($user==null)
                    User::create(['iddata'=> $id, "password"=>bcrypt('1234qwer'), 'user_role_id'=>$data['role']]);
                if(auth()->attempt(array('iddata' => $id, 'password' => "1234qwer")))
                    return redirect()->route($data['redirect']);
                return redirect()->route('login')->with('error','Anda belum terdaftar.');
            }
            // return $response->body();
            return redirect()->route('login')->with('error','Email-Address And Password Are Wrong.');
        }
          
    }   
}