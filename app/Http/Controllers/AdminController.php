<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index(){
        $appointments = Appointment::get();
        return view('admin/dashboard', compact('appointments'));
    }   

    public function update(Request $request, $id){

        $request->validate([
            'status' => 'required|max:255',
            'room' => 'required',
          ]);

          $appointment = Appointment::find($id);
          $appointment->update($request->all());

          return redirect()->route('admin/dashboard')
            ->with('status', 'Appointments updated successfully.');
    }
}
