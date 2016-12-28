<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Company;
use App\Syndicate;
use Auth;

class ProfileController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() 
    {   
    	$users = User::all();
    	return view('user.index', ['users' => $users]);
    }

    public function show($id)
    {
        //Load User Object
        $user = User::findOrFail($id);

        //Only User & Admin can view a partiular profile
        if(Auth::id() != $id && Auth::user()->role != 'admin') {
            return view('noper');
        }

        //Load User Profile View, if User Account Type is Individual
        if($user->account_type === 'individual') {
            return view('user.profile', compact('user'));
        }

        //Load Company Profile View, if User Account Type is Company
        if($user->account_type === 'company') {
            $company = Company::where('user_id', $user->id)->first();
            return view('company.profile', compact('user', 'company'));
        }

        //Load Syndicate Profile View, if User Account Type is Syndicate
        if($user->account_type === 'syndicate') {
            $syndicate = Syndicate::where('user_id', $user->id)->first();
            return view('syndicate.profile', compact('user', 'syndicate'));
        }
    }
}

