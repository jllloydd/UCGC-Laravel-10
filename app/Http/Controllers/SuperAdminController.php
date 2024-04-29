<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SuperAdmin;

class SuperAdminController extends Controller
{
    public function index(){

        $users = SuperAdmin::orderBy('id', 'ASC')->get();

        return view('superadmin.dashboard', ['users' => $users]);
    }

    public function update(Request $request, string $id){
        $request->validate([
            'usertype' => 'required'
        ]);
        $users = SuperAdmin::find($id);
        $users->update($request->all());
        return redirect()->route('superadmin/dashboard')->with('status','User permissions updated successfully!');
    }

    public function destroy(string $id){

        $users = SuperAdmin::findOrFail($id);
        $users->delete();

        return redirect()->route('superadmin/dashboard')->with('status', 'User record deleted successfully!');
    }

}
