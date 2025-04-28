<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FooterContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FooterContentController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');

        $footerContents = FooterContent::query()
            ->when($keyword, function ($query) use ($keyword) {
                $query->where('address', 'like', '%' . $keyword . '%')
                    ->orWhere('phone', 'like', '%' . $keyword . '%')
                    ->orWhere('email', 'like', '%' . $keyword . '%')
                    ->orWhere('copyright_text', 'like', '%' . $keyword . '%');
            })
            ->paginate(10);
        $footerContent = FooterContent::first();

        return view('admin.footer_contents.index', compact('footerContents', 'keyword', 'footerContent'));
    }

    public function create()
    {
        return view('admin.footer_contents.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'facebook' => 'nullable|string|max:255', // Thay đổi từ url thành string
            'twitter' => 'nullable|string|max:255', // Thay đổi từ url thành string
            'instagram' => 'nullable|string|max:255', // Thay đổi từ url thành string
            'linkedin' => 'nullable|string|max:255', // Thay đổi từ url thành string
            'youtube' => 'nullable|string|max:255', // Thay đổi từ url thành string
            'copyright_text' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        FooterContent::create($request->all());

        return redirect()->route('admin.footer_contents.index')->with('success', 'Footer Content created successfully!');
    }

    public function edit(FooterContent $footerContent)
    {
        return view('admin.footer_contents.edit', compact('footerContent'));
    }

    public function update(Request $request, FooterContent $footerContent)
    {
        $validator = Validator::make($request->all(), [
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'facebook' => 'nullable|string|max:255', // Thay đổi từ url thành string
            'twitter' => 'nullable|string|max:255', // Thay đổi từ url thành string
            'instagram' => 'nullable|string|max:255', // Thay đổi từ url thành string
            'linkedin' => 'nullable|string|max:255', // Thay đổi từ url thành string
            'youtube' => 'nullable|string|max:255', // Thay đổi từ url thành string
            'copyright_text' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $footerContent->update($request->all());

        return redirect()->route('admin.footer_contents.index')->with('success', 'Cập nhật Footer Content thành công!');
    }

    public function destroy(FooterContent $footerContent)
    {
        $footerContent->delete();
        return redirect()->route('admin.footer_contents.index')->with('success', 'Xóa 1 hàng của Footer Content thành công!');
    }
}
