<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    public function myAppointments()
    {
        // Get the authenticated user's ID and user_type
        $userId = Auth::id();
        $userType = Auth::user()->user_type;

        // Check if the authenticated user is a doctor
        if ($userType === 'DOCTOR') {
            // Get all appointments where doctor_id is equal to the authenticated doctor's ID
            $appointments = Appointment::where('doctor_id', $userId)->get();

            // Other logic or view rendering as needed

            // For example, you can return the appointments to a view
            return view('appointments.myAppointments', compact('appointments'));
        } else {
            // If the authenticated user is not a doctor, you can handle it accordingly
            return redirect()->back()->with('error', 'You do not have access to this page.');
        }
    }
    public function index()
    {
        // Get appointments for the authenticated patient
        $appointments = Appointment::all();
        return view('appointments.index', compact('appointments'));
    }

    public function create()
    {
        // You can implement logic to retrieve available doctors, e.g., $doctors = User::where('role', 'DOCTOR')->get();
        $doctors = Doctor::all();
        return view('appointments.create',compact('doctors'));
    }
    public function show($id)
    {
        $appointment = Appointment::findOrFail($id);
        return view('appointments.show',compact('appointment'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'doctor_id' => 'required|exists:users,id', // Ensure the selected doctor is a DOCTOR
            'appointment_datetime' => 'required|date|after:now', // Ensure the appointment is in the future
        ]);

        // Create a new appointment for the authenticated patient
        Appointment::create([
            'doctor_id' => $request->input('doctor_id'),
            'patient_id' => auth()->user()->id,
            'appointment_datetime' => $request->input('appointment_datetime'),
            'status' => 'INHOLD', // Default status
        ]);
        return redirect()->route('appointments.index')->with('success', 'تم حجز الموعد بنجاح');
    }

    public function edit($id)
    {
        $appointment = Appointment::findOrFail($id);
        $doctors = Doctor::all();
        return view('appointments.edit', compact('appointment','doctors'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'doctor_id' => 'required|exists:users,id',
            'appointment_datetime' => 'required|date|after:now',
            'status' => 'required|in:INHOLD,ACCEPTED,CANCELLED',
        ]);

        $appointment = Appointment::findOrFail($id);

        $appointment->update([
            'doctor_id' => $request->input('doctor_id'),
            'appointment_datetime' => $request->input('appointment_datetime'),
            'status' => $request->input('status'),
        ]);

        return redirect()->route('appointments.index')->with('success', 'تم تحديث الحجز!');
    }

    public function destroy($id)
    {
        $appointment = Appointment::findOrFail($id);

        $appointment->delete();

        return redirect()->route('appointments.index')->with('success', 'تم مسح الحجز!');
    }


}
