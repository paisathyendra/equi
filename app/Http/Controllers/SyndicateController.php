<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Syndicate;
use App\User;

class SyndicateController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $syndicate = Syndicate::all();
        return view('syndicate.index', ['syndicates' => $syndicate]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('syndicate.create');
    }

    /**
     * Store a newly created Syndicate
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   

        //Validate Input Fields
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email|max:255',
            'logo' => 'image',
            'certificate' => 'image',
            'address' => 'max:255',
            'contact' => 'max:25'
        ]);

        //Create New Syndicate User
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;

        //Set Password default as 'secret'
        $user->password = bcrypt('secret');

        $user->role = $request->role;
        $user->account_type = $request->account_type;
        $user->save();

        //Create new Syndicate
        $syndicate = new Syndicate;
        $syndicate->name = $request->name;
        $syndicate->user_id = $user->id;
        $syndicate->address = $request->address;
        $syndicate->contact = $request->contact;

        //Check Syndicate Logo file present 
        if ($request->hasFile('logo')) 
        {
            //Store Syndicate Logo in folder : public/uploads/logos/syndicate
            $logo_path = $request->file('logo')->store('logos/syndicate/', 'uploads');

            //Set Path after file is stored
            $syndicate->logo = $logo_path;
        }

        //Check Syndicate Certificate file present
        if ($request->hasFile('certificate')) 
        {
            //Store Syndicate Certificate in folder : public/uploads/certificates/syndicate
            $certificate_path = $request->file('certificate')->store('certificates/syndicate/', 'uploads');

            //Set Path after file is stored
            $syndicate->certificate = $certificate_path;
        }

        //Save Syndicate Record
        $syndicate->save();

        //Render Syndicate List View with Success Message
        return redirect()->route('syndicate.index')->with('alert-success', "New Syndicate '$syndicate->name' is created");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //Load Syndicate Object
        $syndicate = Syndicate::findOrFail($id);

        //Load User Object
        $user = User::findOrFail($syndicate->user_id);

        //Pass Both Company & User Object to Edit View
        return view('syndicate.edit', compact('syndicate', 'user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //Validate Input Fields
        $this->validate($request, [
            'name' => 'required|max:255',
            'logo' => 'image',
            'certificate' => 'image',
            'address' => 'max:255',
            'contact' => 'max:25'
        ]);

        //Load Syndicate Object
        $syndicate = Syndicate::findOrFail($id);
        $syndicate->name = $request->name;
        $syndicate->address = $request->address;
        $syndicate->contact = $request->contact;

        //Check Syndicate Logo file present 
        if ($request->hasFile('logo')) 
        {
            //Store Syndicate Logo in folder : public/uploads/logos/syndicate
            $logo_path = $request->file('logo')->store('logos/syndicate/'.$id, 'uploads');

            //Set Path after file is stored
            $syndicate->logo = $logo_path;
        }

        //Check Syndicate Certificate file present
        if ($request->hasFile('certificate')) 
        {
            //Store Syndicate Certificate in folder : public/uploads/certificates/syndicate
            $certificate_path = $request->file('certificate')->store('certificates/syndicate/'.$id, 'uploads');

            //Set Path after file is stored
            $syndicate->certificate = $certificate_path;
        }

        //Save Syndicate Record
        $syndicate->save();

        //Render Syndicate List View with Success Message
        return redirect()->route('syndicate.index')->with('alert-success', "Updated Syndicate '$syndicate->name'");
    }

    /**
     * Remove Syndicate Record
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Load Syndicate Object
        $syndicate = Syndicate::findOrFail($id);

        //Load Syndicate User Object
        $user = User::findOrFail($syndicate->user_id);

        //Delete Syndicate User
        $user->delete();

        //Delete Syndicate
        $syndicate->delete();

        //Render Syndicate List View with Success Message
        return redirect()->route('syndicate.index')->with('alert-success', "Syndicate '$syndicate->name' is deleted");
    }
}
