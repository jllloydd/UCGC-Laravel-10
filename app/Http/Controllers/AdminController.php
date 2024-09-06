<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\User;
use App\Models\CounselorInfo;
use App\Charts\CounselModeAnalytics;
use App\Charts\GenderChart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\PostCounselEmail;
use App\Mail\AppointmentSetMail;

class AdminController extends Controller
{
    public function index(Appointment $appointment, Request $request){
        $appointments = $appointment->where('appointed_counselor', 'To be assigned')->sortable('date', 'time', 'course', 'mode', 'gender')->paginate(10);
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

          $indivuserid = $appointment->user_id;
          $user = User::find($indivuserid);
  
          $receiver = $user->email;
          $mailmessage = 'Your appointment has been set! You may now check your appointment details or cancel the appointment by clicking the link below.';
          $subject= 'Counseling Appointment Set';
  
          Mail::to($receiver)->send(new AppointmentSetMail($mailmessage, $subject, $receiver));

          return redirect()->route('admin/dashboard')
            ->with('status', 'Appointment set successfully.');
    }

    public function panel(CounselModeAnalytics $chart, GenderChart $barchart, Request $request){

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

        $completedcount = DB::table('appointments')
        ->where('status', 'Completed')
        ->selectRaw('count(id) as completedcount')
        ->pluck('completedcount')
        ->first();

        $upcomingappointments = Appointment::where('appointed_counselor', $adminName)
        ->orderBy('date', 'asc')
        ->orderBy('time', 'asc')
        ->sortable('course', 'mode')
        ->paginate(4);

        if ($request->ajax()) {
            return response()->json([
                'appointmentcount' => $appointmentcount,
                'activeappointments' => $activeappointments,
                'pendingappointments' => $pendingappointments,
                'completedcount' => $completedcount
            ]);
        }
        
        return view('admin/adminpanel', compact('appointmentcount', 'activeappointments', 'pendingappointments', 'completedcount', 'admininfo', 'upcomingappointments', 'adminNameList'), ['chart'=>$chart->build(),'barchart'=>$barchart->build()]);
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

    public function setAsComplete(Request $request, $id){


        $appointment = Appointment::find($id);
        $appointment->status = 'Completed';
        $appointment->save();

        $indivuserid = $appointment->user_id;
        $user = User::find($indivuserid);

        $receiver = $user->email;
        $mailmessage = 'Your appointment has been officially completed! Please accomplish the post counseling survey for our counselors.';
        $subject= 'Post Counseling Form';

        Mail::to($receiver)->send(new PostCounselEmail($mailmessage, $subject, $receiver));

        return redirect()->route('admin/panel')->with('status', 'Appointment marked as completed!');
    }

    public function counselorList(Request $request)
    {
        $admininfo = DB::table('users')
            ->leftJoin('counselorinfo', 'users.id', '=', 'counselorinfo.user_id')
            ->where('users.usertype', 'admin')
            ->select('users.*', 'counselorinfo.gender', 'counselorinfo.department', 'counselorinfo.expertise')
            ->get();
        
        return view('admin/counselorlist', compact('admininfo'));
    }

    public function updateCounselorProfile(Request $request)
    {
        $request->validate([
            'gender' => 'required',
            'department' => 'required',
            'expertise' => 'required',
        ]);

        try {
            CounselorInfo::updateOrCreate(
                ['user_id' => Auth::id()],
                [
                    'name' => Auth::user()->name,
                    'gender' => $request->gender,
                    'department' => $request->department,
                    'expertise' => $request->expertise,
                ]
            );

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            \Log::error('Error updating counselor profile: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'An error occurred. Please try again.'], 500);
        }
    }
}
