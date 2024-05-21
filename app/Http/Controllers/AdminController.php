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
    public function index(Appointment $appointment){
        $appointments = $appointment->sortable('date', 'time', 'course', 'mode', 'gender')->paginate(10);
        return view('admin/dashboard', compact('appointments'));
    }   

    public function update(Request $request, $id){

        $request->validate([
            'room' => 'required',
          ]);

          $adminName = Auth::user()->name;

          $appointment = Appointment::find($id);
          $appointment->update($request->all());
          $appointment->status = 'Active';
          $appointment->appointed_counselor = $adminName;
          $appointment->save();

          return redirect()->route('admin/dashboard')
            ->with('status', 'Appointment set successfully.');
    }

    public function panel(CounselModeAnalytics $chart, GenderChart $barchart){

        $userid = Auth::user()->id;

        $adminName = Auth::user()->name;

        $adminNameList = DB::table('users')
        ->where('usertype', 'admin')
        ->where('id', '<>', $userid)
        ->get();

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

        $upcomingappointments = Appointment::where('appointed_counselor', $adminName)
        ->sortable('date', 'time', 'course', 'mode')
        ->paginate(4);
        
        return view('admin/adminpanel', compact('appointmentcount', 'activeappointments', 'pendingappointments', 'usercount', 'admininfo', 'upcomingappointments', 'adminNameList'), ['chart'=>$chart->build(),'barchart'=>$barchart->build()]);
    }   

    public function editappdeets(Request $request, $id){

        $input = $request->validate([
            'room' => 'required',
            'appointed_counselor' => 'required'
          ]);

        $appointment = Appointment::find($id);
        $appointment->room = $input['room'];
        $appointment->appointed_counselor = $input['appointed_counselor'];
        $appointment->save();

        return redirect()->route('admin/panel')->with('status', 'Appointment details edited successfully!');

    }
}
