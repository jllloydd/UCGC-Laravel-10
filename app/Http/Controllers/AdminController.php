<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\User;
use App\Charts\CounselModeAnalytics;
use App\Charts\GenderChart;
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

    public function panel(CounselModeAnalytics $chart, GenderChart $barchart){

        $userid = Auth::user()->id;

        $admininfo = DB::table('users')
            ->where('id', $userid)
            ->get();

        $appointmentcount = DB::table('appointments')->count();

        $activeappointments = DB::table('appointments')
        ->where('status', 'Active')
        ->selectRaw('count(id) as activeappointments')
        ->pluck('activeappointments')
        ->first();

        $pendingappointments = DB::table('appointments')
        ->where('status', 'Pending')
        ->selectRaw('count(id) as pendingappointments')
        ->pluck('pendingappointments')
        ->first();

        $usercount = DB::table('users')
        ->where('usertype', 'user')
        ->selectRaw('count(id) as usercount')
        ->pluck('usercount')
        ->first();

        return view('admin/adminpanel', compact('appointmentcount', 'activeappointments', 'pendingappointments', 'usercount', 'admininfo'), ['chart'=>$chart->build(),'barchart'=>$barchart->build()]);
    }   
}
