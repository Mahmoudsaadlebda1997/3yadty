<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::all();
        return view('sliders.index', compact('sliders'));
    }

    public function create()
    {
        return view('sliders.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:8192', // Adjust max file size as needed
            'is_active' => 'boolean',
        ]);

        $imagePath = $this->uploadImage($request->file('image'));

        Slider::create([
            'title' => $request->input('title'),
            'image_path' => $imagePath,
            'is_active' => $request->input('is_active', true),
        ]);

        return redirect()->route('sliders.index')->with('success', 'تم عمل السلايدر.');
    }
    public function show($id)
    {
        $slider = Slider::findOrFail($id);
        return view('sliders.show', compact('slider'));
    }
    public function edit($id)
    {
        $slider = Slider::findOrFail($id);
        return view('sliders.edit', compact('slider'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:8192', // Adjust max file size as needed
            'is_active' => 'boolean',
        ]);

        $slider = Slider::findOrFail($id);

        // Update title and is_active
        $slider->update([
            'title' => $request->input('title'),
            'is_active' => $request->input('is_active', true),
        ]);

        // Update image if provided
        if ($request->hasFile('image')) {
            // Delete the old image if exists
            if ($slider->image_path) {
                $this->deleteImage($slider->image_path);
            }

            $imagePath = $this->uploadImage($request->file('image'));
            $slider->update(['image_path' => $imagePath]);
        }

        return redirect()->route('sliders.index')->with('success', 'تم تعديل السلايدر.');
    }

    public function destroy($id)
    {
        $slider = Slider::findOrFail($id);

        // Delete the associated image
        $this->deleteImage($slider->image_path);

        $slider->delete();

        return redirect()->route('sliders.index')->with('success', 'تم مسح السلايدر.');
    }

    private function uploadImage($image)
    {
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->storeAs('public/sliders', $imageName);

        return 'sliders/' . $imageName;
    }

    private function deleteImage($imagePath)
    {
        Storage::delete('public/' . $imagePath);
    }
}

