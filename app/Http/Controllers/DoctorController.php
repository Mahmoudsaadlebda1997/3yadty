<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Specialty;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DoctorController extends Controller
{
    public function index()
    {
        $doctors = Doctor::all();
        return view('doctors.index', compact('doctors'));
    }

    public function create()
    {
        $specialties = Specialty::all();
        return view('doctors.create',compact('specialties'));
    }

    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string',
            'user_type' => [
                'required',
                Rule::in(['DOCTOR']),
            ],
            'password' => 'required|string|min:6',
            'email' => 'required|email|unique:users,email',
            'phone_number' => 'nullable|string|unique:users,phone_number',
            'age' => 'required|integer',
            'specialty_id' => 'required|exists:specialties,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:8192',
            'description' => 'nullable|string',
        ]);

        // Create a new user
        $user = User::create([
            'name' => $request->input('name'),
            'user_type' =>  $request->input('user_type'),
            'password' => bcrypt($request->input('password')),
            'email' => $request->input('email'),
            'phone_number' => $request->input('phone_number'),
        ]);
        // Create a new doctor associated with the user
        $doctor = Doctor::create([
            'age' => $request->input('age'),
            'specialty_id' => $request->input('specialty_id'),
            'user_id' => $user->id,
            'description' => $request->input('description'),
        ]);

        // Upload and store the image if provided
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads'), $imageName);
            $doctor->image = $imageName;
            $doctor->save();
        }

        return redirect()->route('doctors.index')->with('success', 'تم اضافه الدكتور بنجاح.');
    }


    public function show($id)
    {
        $doctor = Doctor::findOrFail($id);
        return view('doctors.show', compact('doctor'));
    }

    public function edit($id)
    {
        $doctor = Doctor::findOrFail($id);
        $specialties = Specialty::all();
        return view('doctors.edit', compact('doctor','specialties'));
    }

    public function update(Request $request, $id)
    {
        // Find the doctor by ID
        $doctor = Doctor::findOrFail($id);
        // Validate the request data
        // Validate the request data
        $request->validate([
            'age' => 'required|integer',
            'name' => 'required',
            'specialty_id' => 'required|exists:specialties,id',
            'description' => 'required|string',
            'password' => 'nullable|string|min:6',
            'email' => 'required',
            'phone_number' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:8192',
        ]);

        // Update other fields
        $doctor->update([
            'age' => $request->input('age'),
            'specialty_id' => $request->input('specialty_id'),
            'description' => $request->input('description'),
        ]);

        // Update the associated user if email or phone_number is provided
        if ($request->filled('email') || $request->filled('phone_number')) {
            $user = User::find($doctor->user_id);
            $user->update([
                'email' => $request->input('email') ?? $user->email,
                'phone_number' => $request->input('phone_number') ?? $user->phone_number,
            ]);
        }

        // Upload and store the new image if provided
        if ($request->hasFile('image')) {
            // Delete the old image if exists
            if ($doctor->image) {
                unlink(public_path('uploads/' . $doctor->image));
            }

            // Upload and store the new image
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads'), $imageName);
            $doctor->image = $imageName;
            $doctor->save();
        }

        // Debugging: Check if the doctor is updated
        // dd($doctor);

        // Debugging: Check if the route exists
        // dd(route('doctors.index'));

        // Redirect to the index route
        return redirect()->route('doctors.index')->with('success', 'تم تعديل الدكنور بنجاح');
    }


    public function destroy($id)
    {
        $doctor = Doctor::findOrFail($id);

        // Delete the associated image if it exists
        if ($doctor->image) {
            $imagePath = public_path('uploads/' . $doctor->image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        $doctor->delete();

        return redirect()->route('doctors.index')->with('success', 'تم مسح الدكنور بنجاح.');
    }
}
