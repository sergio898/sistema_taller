<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class LoginController extends Controller
{
   
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('login');
    }


    public function doLogin(Request $request){

		$ip= $_SERVER['REMOTE_ADDR'];
		$login = DB::select("select public.login('".$request->input('usuario')."','".$request->input('password')."','".$ip."')");
		$login_ = explode('|', $login[0]->login); 

		if($login_[0] == 'OK'){
			$datosLoggeo = DB::table('vw_login')
							->where('email', $request->input('usuario'))
							->first();
			session(['datos-loggeo' => $datosLoggeo]);
			//$this->getMenuJson($request);
            return redirect()->route('home')->with('success','Bienvenido '.$request->input('usuario'));
    
		}else{
			return redirect()->route('login')->with('error',$login_[0]);
		}
	}	

    public function logout(Request $request){
        $request->session()->flush();
        return redirect('login');
	}

}
