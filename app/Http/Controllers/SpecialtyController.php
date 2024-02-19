<?php

namespace App\Http\Controllers;

use App\Models\Specialty;
use Illuminate\Http\Request;

class SpecialtyController extends Controller
{
    public function index()
    {
        $specialties = Specialty::all();
        return view('specialties.index', compact('specialties'));
    }

    public function create()
    {
        return view('specialties.create');
    }

    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:8192',
        ]);

        // Create a new Specialty
        $specialty = Specialty::create([
            'name' => $request->input('name'),
        ]);

        // Upload and store the image if provided
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads'), $imageName);
            $specialty->image = $imageName;
            $specialty->save();
        }

        return redirect()->route('specialties.index')->with('success', 'تم اضافه التخصص بنجاح.');
    }


    public function show($id)
    {
        $specialty = Specialty::findOrFail($id);
        return view('specialties.show', compact('specialty'));
    }

    public function edit($id)
    {
        $specialty = Specialty::findOrFail($id);
        return view('specialties.edit', compact('specialty'));
    }

    public function update(Request $request, $id)
    {
        // Find the doctor by ID
        $specialty = Specialty::findOrFail($id);
        $request->validate([
            'name' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:8192',
        ]);

        // Update other fields
        $specialty->update([
            'name' => $request->input('name'),
        ]);

        // Upload and store the new image if provided
        if ($request->hasFile('image')) {
            // Delete the old image if exists
            if ($specialty->image) {
                unlink(public_path('uploads/' . $specialty->image));
            }

            // Upload and store the new image
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads'), $imageName);
            $specialty->image = $imageName;
            $specialty->save();
        }

        // Redirect to the index route
        return redirect()->route('specialties.index')->with('success', 'تم تعديل التخصص بنجاح');
    }


    public function destroy($id)
    {
        $speciality = Specialty::findOrFail($id);

        // Delete the associated image if it exists
        if ($speciality->image) {
            $imagePath = public_path('uploads/' . $speciality->image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        $speciality->delete();

        return redirect()->route('specialties.index')->with('success', 'تم مسح التخصص بنجاح.');
    }
}
