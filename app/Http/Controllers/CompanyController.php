<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Company;
use App\User;

class CompanyController extends Controller
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
        $company = Company::all();
        return view('company.index', ['company' => $company]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('company.create');
    }

    /**
     * Store a newly created Company
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   

        //Validate Input Fields
        $this->validate($request, [
            'company_name' => 'required|max:255',
            'company_email' => 'required|email|unique:users,email|max:255',
            'company_logo' => 'image',
            'company_certificate' => 'image',
            'company_address' => 'max:255',
            'company_contact' => 'max:25'
        ]);

        //Create New Company User
        $user = new User;
        $user->name = $request->company_name;
        $user->email = $request->company_email;

        //Set Password default as 'secret'
        $user->password = bcrypt('secret');

        $user->role = $request->role;
        $user->account_type = $request->account_type;
        $user->save();

        //Create New Company
        $company = new Company;
        $company->company_name = $request->company_name;
        $company->user_id = $user->id;
        $company->address = $request->company_address;
        $company->contact = $request->company_contact;

        //Check Company Logo file present 
        if ($request->hasFile('company_logo')) 
        {
            //Store Company Logo in folder : public/uploads/logos/company
            $logo_path = $request->file('company_logo')->store('logos/company/', 'uploads');

            //Set Path after file is stored
            $company->company_logo = $logo_path;
        }

        //Check Company Certificate file present
        if ($request->hasFile('company_certificate')) 
        {   
            //Store Company Certificate in folder : public/uploads/certificates/company
            $certificate_path = $request->file('company_certificate')->store('certificates/company/', 'uploads');

            //Set Path after file is stored
            $company->company_certificate = $certificate_path;
        }

        //Save Company Record
        $company->save();

        //Render Company List View with Success Message
        return redirect()->route('company.index')->with('alert-success', "New Company '$company->company_name' is created");
    
    }

    /**
     * Edit a Company
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        //Load Company Object
        $company = Company::findOrFail($id);

        //Load User Object
        $user = User::findOrFail($company->user_id);

        //Pass Both Company & User Object to Edit View
        return view('company.edit', compact('company', 'user'));
    }

    /**
     * Update a Company
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //Validate Input Fields
        $this->validate($request, [
            'company_name' => 'required|max:255',
            'company_logo' => 'image',
            'company_certificate' => 'image',
            'company_address' => 'max:255',
            'company_contact' => 'max:25'
        ]);

        //Load Company Object
        $company = Company::findOrFail($id);
        
        $company->company_name = $request->company_name;

        //Check Company Logo file present 
        if ($request->hasFile('company_logo')) 
        {   
            //Store Company Logo in folder : public/uploads/logos/company
            $logo_path = $request->file('company_logo')->store('logos/company/', 'uploads');

            //Set Path after file is stored
            $company->company_logo = $logo_path;
        }

        //Check Company Certificate file present
        if ($request->hasFile('company_certificate')) 
        {   
            //Store Company Certificate in folder : public/uploads/certificates/company
            $certificate_path = $request->file('company_certificate')->store('certificates/company/', 'uploads');

            //Set Path after file is stored
            $company->company_certificate = $certificate_path;
        }

        //Save Company Record
        $company->save();

        //Render Company List View with Success Message
        return redirect()->route('company.index')->with('alert-success', "Updated Company '$company->company_name'");
    }

    /**
     * Remove Company Record
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Load Company Object
        $company = Company::findOrFail($id);

        //Load Company User Object
        $user = User::findOrFail($company->user_id);

        //Delete Company User
        $user->delete();

        //Delete Company 
        $company->delete();

        //Render Company List View with Success Message
        return redirect()->route('company.index')->with('alert-success', "Company '$company->company_name' is deleted");
    }
}
