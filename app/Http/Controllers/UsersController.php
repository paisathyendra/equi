<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use App\Repositories\UserRepository;

class UsersController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() 
    {   
        //List only those user whose Account Type is 'Individual' and Skip Admin user while listing
    	$users = User::where([
            ['account_type', '=','individual'],
            ['role', '<>', 'admin']
        ])->get();

        //Pass User Object to User List View
        return view('user.index', ['users' => $users]);
    }

    public function create()
    {
        return view('user.create');
    }

    public function store(Request $request)
    {   
        //Validate Input Fields
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email|max:255',
            'avatar' => 'image'
        ]);

        //Create New User
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;

        //Check whether User Avatar file present
        if ($request->hasFile('avatar')) 
        {   
            //Store User Avatars in folder : public/uploads/avatars
            $path = $request->file('avatar')->store('avatars/'.$request->user()->id, 'uploads');
            
            //Set Path after file is stored
            $user->avatar = $path;
        }

        //Set User Password to 'secret'
        $user->password = bcrypt('secret');
        $user->role = $request->role;
        $user->account_type = $request->account_type;
        $user->save();

        //Render User List View with Success Message
        return redirect()->route('user.index')->with('alert-success', "New User '$user->name' is Created");
    }

    /**
    * Show User Profile
    *
    **/
    public function show($id)
    {   
        //Load User Object
        $user = User::findOrFail($id);

        //Pass User Obejct to User Profile View
        return view('user.profile', compact('user'));
    }

    /**
    * Edit User Profile
    *
    **/
    public function edit($id)
    {   
        //Load User Object
        $user = User::findOrFail($id);

        //Only User & Admin can edit a particular profile
        if(Auth::id() != $id && Auth::user()->role != 'admin') {

            //Render No Permission View if the user doesn't have permission to edit the profile
            return view('noper');
        }

        //Pass User Object to User Edit View
        return view('user.edit', compact('user'));
    }

    /**
    * Update User Profile
    *
    **/
    public function update(Request $request, $id)
    {
        
        //Validate Input Fields
        $this->validate($request, [
            'name' => 'required|max:255',
            'avatar' => 'image'
        ]);

        //Load User Object
        $user = User::findOrFail($id);
        $user->name = $request->name;
        
        //Check whether User Avatar file present
        if ($request->hasFile('avatar')) 
        {   
            //Store User Avatars in folder : public/uploads/avatars
            $path = $request->file('avatar')->store('avatars/'.$request->user()->id, 'uploads');
            
            //Set Path after file is stored
            $user->avatar = $path;
        }

        $user->save();

        //Render User List View with Success Message
        return redirect()->route('user.index')->with('alert-success', "User '$user->name' profile has been updated");
    }

    /**
    * Destroy User
    *
    */
    public function destroy($id)
    {
        //Load User Object
        $user = User::findOrFail($id);

        //Delete User
        $user->delete();

        //Render User List View with Success Message
        return redirect()->route('user.index')->with('alert-success', "User '$user->name' has been deleted");
    }

    public function baz(UserRepository $users)
    {
        $users->find(1);

        $users->findAll();

        $users->setCacheDriver('redis')->whereIn('id', [1, 2, 5, 8]);

        $users->setCacheLifetime(123)->whereNotIn('id', [1, 2, 5, 8]);

        $users->setCacheLifetime(0)->findBy('name', 'tester');

        $users->with('role')                           
               ->where('name', '!=', 'test')        
               ->whereNotIn('id', [1, 2, 5, 8])          
               ->offset(5)                              
               ->limit(9)                               
               ->orderBy('id', 'asc')                   
               ->setCacheDriver('redis')                
               ->setCacheLifetime(123);            

        $users->create(['name' => 'example']);
    }
}

