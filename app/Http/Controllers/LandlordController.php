<?php

namespace App\Http\Controllers;

use App\Models\Landlord;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;



class LandlordController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    //  public function index()
    //  {
    //      $landlord = User::where('role_id', 3)
    //          ->with('role')
    //          ->orderBy('id', 'desc')
    //          ->get();

    //          return view('frontend.landlord.table', ['landlords' => $landlord]);
    // $users=User::select('*')->where('role_id',3)->with('role')->orderBy('id','desc')->get();
    //  }

    public function index()
    {
           // Fetch all landlord from the database
        $landlord = Landlord::all();
        return view('frontend.landlord.table', ['landlords' => $landlord]);

    //     $landlord = User::where('role_id', 2)->orderBy('id', 'desc')->get();
    // return view('frontend.landlord.table', ['landlords' => $landlord]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("frontend.landlord.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:landlords',
        'password' => 'required|string|min:8',
    ]);

    // Save landlord data to the landlords table
    $landlord = new Landlord;
    $landlord->name = $request->name;
    $landlord->email = $request->email;
    $landlord->password = $request->password;
    $landlord->save();

    // Save landlord data to the users table
    $user = new User;
    $user->name = $request->name;
    $user->email = $request->email;
    $user->password = bcrypt($request->password);
    $user->role_id = 3; // Set role_id as 3 for Landlord
    $user->save();

    return redirect()->route('landlord.index')->withSuccess("Landlord added successfully.");
}




    /**
     * Display the specified resource.
     */
    public function show(Landlord $landlord)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $landlord = Landlord::findOrFail($id);
        return view("frontend.landlord.edit", ['landlord' => $landlord]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $landlord = Landlord::findOrFail($id);

        $request->validate([
            "name" => "required",
            "email" => "required",
            "password" => "required",

        ]);

        $landlord->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,

        ]);

        return redirect()->route('landlord.index')->with('success', 'Landlord updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $landlord = Landlord::findOrFail($id);
        $landlord->delete();

        return redirect()->route('landlord.index')->with('success', 'Landlord deleted successfully.');
    }
}
