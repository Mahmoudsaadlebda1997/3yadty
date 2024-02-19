<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PatientController extends Controller
{
    public function index()
    {
        $patients = Patient::all();
        return view('patients.index', compact('patients'));
    }

    public function create()
    {
        return view('patients.create');
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

        return redirect()->route('patients.index')->with('success', 'تم اضافه المريض بنجاح.');
    }


    public function show($id)
    {
        $patient = Patient::findOrFail($id);
        return view('patients.show', compact('patient'));
    }

    public function edit($id)
    {
        $patient = Patient::findOrFail($id);
        return view('patients.edit', compact('patient'));
    }

    public function update(Request $request, $id)
    {
        // Find the patient by ID
        $patient = Patient::findOrFail($id);
        // Validate the request data
        $request->validate([
            'age' => 'required|integer',
            'name' => 'required',
            'password' => 'nullable|string|min:6',
            'email' => 'required',
            'phone_number' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:8192',
        ]);

        // Update other fields
        $patient->update([
            'age' => $request->input('age'),
        ]);

        // Update the associated user if email or phone_number is provided
        if ($request->filled('email') || $request->filled('phone_number')) {
            $user = User::find($patient->user_id);
            $user->update([
                'email' => $request->input('email') ?? $user->email,
                'name' => $request->input('name') ?? $user->name,
                'phone_number' => $request->input('phone_number') ?? $user->phone_number,
            ]);
        }

        // Upload and store the new image if provided
        if ($request->hasFile('image')) {
            // Delete the old image if exists
            if ($patient->image) {
                unlink(public_path('uploads/' . $patient->image));
            }

            // Upload and store the new image
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads'), $imageName);
            $patient->image = $imageName;
            $patient->save();
        }

        // Redirect to the index route
        return redirect()->route('patients.index')->with('success', 'تم تعديل المريض بنجاح');
    }


    public function destroy($id)
    {
        $patient = Patient::findOrFail($id);

        // Delete the associated image if it exists
        if ($patient->image) {
            $imagePath = public_path('uploads/' . $patient->image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        $patient->delete();

        return redirect()->route('patients.index')->with('success', 'تم مسح المريض بنجاح.');
    }
}
