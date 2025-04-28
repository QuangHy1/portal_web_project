<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TopBar;
use Illuminate\Http\Request;

class TopBarController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');

        $topBars = TopBar::query()
            ->when($keyword, function ($query) use ($keyword) {
                $query->where('topbar_contact', 'like', '%' . $keyword . '%')
                    ->orWhere('topbar_center_text', 'like', '%' . $keyword . '%');
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.top_bars.index', compact('topBars', 'keyword'));
    }

    public function create()
    {
        return view('admin.top_bars.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'topbar_contact' => 'required|string|max:255',
            'topbar_center_text' => 'required|string|max:255',
            'isHidden' => 'boolean',
        ]);

        TopBar::create($request->all());

        return redirect()->route('admin.top_bars.index')->with('success', 'Top bar created successfully!');
    }

    public function edit(TopBar $topBar)
    {
        return view('admin.top_bars.edit', compact('topBar'));
    }

    public function update(Request $request, TopBar $topBar)
    {
        $request->validate([
            'topbar_contact' => 'required|string|max:255',
            'topbar_center_text' => 'required|string|max:255',
            'isHidden' => 'boolean',
        ]);

        $topBar->update($request->all());

        return redirect()->route('admin.top_bars.index')->with('success', 'Top bar updated successfully!');
    }

    public function destroy(TopBar $topBar)
    {
        $topBar->delete();

        return redirect()->route('admin.top_bars.index')->with('success', 'Top bar deleted successfully!');
    }
}
