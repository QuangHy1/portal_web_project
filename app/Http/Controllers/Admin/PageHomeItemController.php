<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PageHomeItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PageHomeItemController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');

        $pageHomeItems = PageHomeItem::query()
            ->when($keyword, function ($query) use ($keyword) {
                $query->where('heading', 'like', '%' . $keyword . '%')
                    ->orWhere('description', 'like', '%' . $keyword . '%')
                    ->orWhere('job_placeholder', 'like', '%' . $keyword . '%')
                    ->orWhere('job_button', 'like', '%' . $keyword . '%')
                    ->orWhere('location_placeholder', 'like', '%' . $keyword . '%')
                    ->orWhere('category_placeholder', 'like', '%' . $keyword . '%')
                    ->orWhere('job_category_heading', 'like', '%' . $keyword . '%')
                    ->orWhere('job_category_description', 'like', '%' . $keyword . '%')
                    ->orWhere('job_category_status', 'like', '%' . $keyword . '%');
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.page_home_items.index', compact('pageHomeItems', 'keyword'));
    }


    public function create()
    {
        return view('admin.page_home_items.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'heading' => 'required|string',
            'description' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'job_placeholder' => 'required|string|max:255',
            'job_button' => 'required|string|max:255',
            'location_placeholder' => 'required|string|max:255',
            'category_placeholder' => 'required|string|max:255',
            'job_category_heading' => 'required|string|max:255',
            'job_category_description' => 'nullable|string',
            'job_category_status' => 'required|string|max:255',
        ]);

        $input = $request->all();

        if ($image = $request->file('image')) {
            $destinationPath = 'uploads/page_home_items/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = $profileImage;
        }

        PageHomeItem::create($input);

        return redirect()->route('admin.page_home_items.index')->with('success', 'Page Home Item created successfully!');
    }


    public function edit(PageHomeItem $pageHomeItem)
    {
        return view('admin.page_home_items.edit', compact('pageHomeItem'));
    }

    public function update(Request $request, PageHomeItem $pageHomeItem)
    {
        $request->validate([
            'heading' => 'required|string',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'job_placeholder' => 'required|string|max:255',
            'job_button' => 'required|string|max:255',
            'location_placeholder' => 'required|string|max:255',
            'category_placeholder' => 'required|string|max:255',
            'job_category_heading' => 'required|string|max:255',
            'job_category_description' => 'nullable|string',
            'job_category_status' => 'required|string|max:255',
        ]);

        $input = $request->all();

        if ($image = $request->file('image')) {
            $destinationPath = 'uploads/page_home_items/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = $profileImage;
            //Delete old image if exists
            if ($pageHomeItem->image) {
                Storage::delete('uploads/page_home_items/' . $pageHomeItem->image);
            }
        } else {
            $input['image'] = $pageHomeItem->image;
        }

        $pageHomeItem->update($input);

        return redirect()->route('admin.page_home_items.index')->with('success', 'Cập nhật Page Home Item thành công!');
    }

    public function destroy(PageHomeItem $pageHomeItem)
    {
        //Delete image if exists
        if ($pageHomeItem->image) {
            Storage::delete('uploads/page_home_items/' . $pageHomeItem->image);
        }
        $pageHomeItem->delete();

        return redirect()->route('admin.page_home_items.index')->with('success', 'Xóa 1 dòng Page Home Item thành công!');
    }
}
