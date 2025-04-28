<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Editor;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EditorController extends Controller
{
    public function index(Request $request)
    {
        $query = Editor::with('user', 'location');

        if ($request->filled('keyword')) {
            $keyword = $request->keyword;
            $query->where('full_name', 'like', "%$keyword%")
                ->orWhere('phone', 'like', "%$keyword%")
                ->orWhere('address', 'like', "%$keyword%")
                ->orWhereHas('user', function ($q) use ($keyword) {
                    $q->where('username', 'like', "%$keyword%")
                        ->orWhere('email', 'like', "%$keyword%");
                });
        }

        $editors = $query->paginate(5); // Adjust pagination as needed

        return view('admin.editors.index', compact('editors'));
    }

    public function create()
    {
        return view('admin.editors.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id|unique:editors',
            'location_id' => 'nullable|exists:locations,id',
            'full_name' => 'required|string|max:255',
            'date_of_birth' => 'nullable|date',
            'gender' => 'nullable|in:male,female,other',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'bio' => 'nullable|string',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'post_count' => 'nullable|integer|min:0',
        ]);

        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->store('uploads/editors', 'public');
            $validatedData['avatar'] = basename($avatarPath);
        }

        Editor::create($validatedData);

        return redirect()->route('admin.editors.index')->with('success', 'Editor created successfully!');
    }

    public function show(Editor $editor)
    {
        return view('admin.editors.show', compact('editor'));
    }

    public function edit(Editor $editor)
    {
        $locations = Location::all(); // 👈 Lấy tất cả các locations từ database
        return view('admin.editors.edit', compact('editor', 'locations')); // 👈 Truyền $locations vào view
    }

    public function update(Request $request, Editor $editor)
    {
        $validatedData = $request->validate([
            'location_id' => 'nullable|exists:locations,id',
            'full_name' => 'required|string|max:255',
            'date_of_birth' => 'nullable|date',
            'gender' => 'nullable|in:male,female,other',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'bio' => 'nullable|string',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'post_count' => 'nullable|integer|min:0',
        ]);

        if ($request->hasFile('avatar')) {
            // Delete old avatar if exists
            if ($editor->avatar) {
                Storage::delete('public/uploads/editors/' . $editor->avatar);
            }
            $avatarPath = $request->file('avatar')->store('uploads/editors', 'public');
            $validatedData['avatar'] = basename($avatarPath);
        }

        $editor->update($validatedData);

        return redirect()->route('admin.editors.index')->with('success', 'Editor updated successfully!');
    }

    public function destroy(Editor $editor)
    {
        // Delete avatar if exists
        if ($editor->avatar) {
            Storage::delete('public/uploads/editors/' . $editor->avatar);
        }

        $editor->delete();

        return redirect()->route('admin.editors.index')->with('success', 'Editor deleted successfully!');
    }
}
