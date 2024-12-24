<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $banners = Banner::orderBy('created_at', 'desc')->get();

        return view('admin.banner', compact('banners'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|file|mimes:png,jpg,jpeg,gif,webp',
            'status' => 'required'
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $fileName = time() .'_' .$image->getClientOriginalName();

            $image_path = '/uploads/banners/' . $fileName;

            $image->move(public_path('uploads/banners'), $fileName);

            Banner::create([
                'image_path' => $image_path,
                'status' => $request->status
            ]);

            return redirect()->back()->with('success', 'Create banner successfully');
        }

        return redirect()->back()->with('error', 'Error creating banner');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'image' => 'nullable|mimes:png,jpg,jpeg,webp',
            'status' => 'required'
        ]);

        try {
            $banner = Banner::find($id);

            if (!$banner){
                return redirect()->back()->with('error', 'Banner not found');
            }

            if ($request->hasFile('image')){
                if ($banner->image_path && file_exists(public_path($banner->image_path))) {
                    unlink(public_path($banner->image_path));
                }

                $image = $request->file('image');
                $fileName = time() .'_' .$image->getClientOriginalName();
                $filePath = '/uploads/banners/' . $fileName;
                $image->move(public_path('uploads/banners'), $filePath);
            }else{
                $filePath = $banner->image_path;
            }

            $banner->update([
                'image_path' => $filePath,
                'status' => $request->status
            ]);

            return redirect()->back()->with('success', 'Update banner successfully');
        }catch(\Exception $e){
            return redirect()->back()->with('error', 'Có lỗi xảy ra khi cập nhật');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $banner = Banner::find($id);

        if (!$banner){
            return redirect()->back()->with('error', 'Banner not found');
        }

        if ($banner->image_path && file_exists(public_path($banner->image_path))) {
            unlink(public_path($banner->image_path));
        }

        $banner->delete();

        return redirect()->back()->with('success', 'Deleted banner successfully');
    }
}
