<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Events\AppointmentCreated;
use App\Mail\AppointmentEmail;

class UserController extends Controller
{
    public function store(Request $request)
    {

        $userid = Auth::user()->id;

        $input = $request->all();

        $receiver = DB::table('users')->where('usertype', 'admin')->get();
        $mailmessage = 'A new counseling appointment has been made!';
        $subject= 'New Appointment Created!';

        $request->validate([
            'name' => 'required|string|max:255',
            'course' => 'required|string|max:255',
            'mode' => 'required|string|max:255',
            'gender' => 'required|string|max:255',
            'date' => 'required|date',
            'time' => 'required|string|max:255',
        ]);

        $data = [
            'name' => $input['name'],
            'course' => $input['course'],
            'mode' => $input['mode'],
            'gender' => $input['gender'],
            'date' => $input['date'],
            'time' => $input['time']
        ];

        try{
            Appointment::create([
                'name' => $input['name'],
                'course' => $input['course'],
                'mode' => $input['mode'],
                'gender' => $input['gender'],
                'date' => $input['date'],
                'time' => $input['time'],
                "user_id" => $userid
            ]);

            Mail::to($receiver)->send(new AppointmentEmail($mailmessage, $subject, $receiver));

            event(new AppointmentCreated($data));
            
        }catch(\Exception $e){
            if ($e->getCode() == 23000)
            return redirect('dashboard')->with('failed', 'An error has occured. Please try again.');
        }


            return redirect('dashboard')->with('status', 'Appointment created successfully! You may now check the status of your appointment.');

    }

    public function get(){

       // $appointments = Appointment::get();

       $userid = Auth::user()->id;

       $appointmentinfo = DB::table('appointments')
        ->where('user_id', $userid)
        ->get();

            
        return view('checkstatus', compact('appointmentinfo'));
    }

    public function destroy(){
        $userid = Auth::user()->id;

        $appointmentinfo = DB::table('appointments')
         ->where('user_id', $userid)
         ->delete();

        return redirect('dashboard')->with('status', 'Appointment deleted successfully!');
    }

    public function index(){
        $userid = Auth::user()->id;

        $appointmentinfo = DB::table('appointments')
         ->where('user_id', $userid)
         ->get();

        return view('dashboard', compact('appointmentinfo'));
    }

    // public function sendAppointmentEmail(){
    //     $receiver = DB::table('users')->where('usertype', 'admin')->get();
    //     $mailmessage = 'A new counseling appointment has been made!';
    //     $subject= 'New Appointment Created';

    //     $response = Mail::to($receiver)->send(new AppointmentEmail($mailmessage, $subject, $receiver));

    //     dd($response);
    // }


}
