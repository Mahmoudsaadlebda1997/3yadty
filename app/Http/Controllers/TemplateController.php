<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Slider;
use App\Models\Specialty;
use App\Models\User;
use Cassandra\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class TemplateController extends Controller
{
    public function mainPage(){
        $specialites = Specialty::all();
        $doctors = Doctor::all();
        $sliders = Slider::all();
        return view('template.index',compact('specialites','doctors','sliders'));

    }
    public function showLoginForm()
    {
        return view('template.loginTemplate');
    }
    public function showRegisterForm()
    {
        return view('template.registerTemplate');
    }
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string',
            'user_type' => [
                'required',
                Rule::in(['PATIENT']),
            ],
            'password' => 'required|string|min:6',
            'email' => 'required|email|unique:users,email',
            'phone_number' => 'nullable|string|unique:users,phone_number',
            'age' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:8192',
        ]);
        // Create a new user
        $user = User::create([
            'name' => $request->input('name'),
            'user_type' =>  'PATIENT',
            'password' => bcrypt($request->input('password')),
            'email' => $request->input('email'),
            'phone_number' => $request->input('phone_number'),
        ]);
        // Create a new Patient associated with the user
        $patient = Patient::create([
            'age' => $request->input('age'),
            'user_id' => $user->id,
        ]);
        // Upload and store the image if provided
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads'), $imageName);
            $patient->image = $imageName;
            $patient->save();
        }

        return redirect()->route('loginTemplate')->with('success', 'تم اضافه المريض بنجاح.');
    }

    // Login function
    public function login(Request $request)
    {
        // Validate the request data
        $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required',
        ]);

        // Attempt to log in the user
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            // Authentication passed
            return redirect()->intended('/'); // Redirect to the intended URL or a default path
        }

        // Authentication failed
        return back()->withErrors(['email' => 'Invalid credentials'])->withInput($request->only('email'));
    }

    // Log the user out
    public function logout()
    {
        Auth::logout();
        return redirect('/template/login');
    }
    public function myAppointments()
    {
        // Get the authenticated user's ID and user_type
        $userId = Auth::id();
        $userType = Auth::user()->user_type;

        // Check if the authenticated user is a doctor
        if ($userType === 'PATIENT') {
            // Get all appointments where patient_id is equal to the authenticated patient's ID
            $appointments = Appointment::where('patient_id', $userId)->get();

            // Other logic or view rendering as needed

            // For example, you can return the appointments to a view
            return view('template.myAppointments', compact('appointments'));
        } else {
            // If the authenticated user is not a doctor, you can handle it accordingly
            return redirect()->back()->with('error', 'You do not have access to this page.');
        }
    }
    public function storeAppointment(Request $request)
    {
        $validatedData = $request->validate([
            'appointment_datetime' => 'required|date',
            'doctor_id' => 'required|exists:users,id', // Ensure the selected doctor is a DOCTOR
        ]);
        // Check if the appointment datetime is already registered
        $existingAppointment = Appointment::where('appointment_datetime', $validatedData['appointment_datetime'])
            ->where('patient_id', '!=', $request->patient_id)->where('status','!=', 'ACCEPTED') // Exclude the current patient
            ->first();

        if ($existingAppointment) {
            // Appointment datetime is already taken
            $errorMessage = 'تاريخ الحجز محجوز بالفعل. يرجى اختيار وقت آخر.';
            \Illuminate\Support\Facades\Session::flash('error', $errorMessage);
            return redirect()->back()->withInput();
        }
        // Create a new appointment for the authenticated patient
        Appointment::create([
            'doctor_id' => $request->input('doctor_id'),
            'patient_id' => auth()->user()->id,
            'appointment_datetime' => $request->input('appointment_datetime'),
            'status' => 'INHOLD', // Default status
        ]);
        return redirect()->route('myAppointment')->with('success', 'تم حجز الموعد بنجاح');
    }
}
