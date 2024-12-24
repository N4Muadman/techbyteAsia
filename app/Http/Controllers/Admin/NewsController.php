<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $news = News::orderBy('created_at', 'desc')->paginate(10);

        return view('admin.news.index', compact('news'));
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
            'title' => 'required',
            'image' => 'required|mimes:png,jpg,gif,webp,jpeg',
            'short_content' => 'required',
            'content' => 'required',
            'category' => 'required',
            'show' => 'required'
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $imagePath = '/uploads/news/' . $imageName;
            $image->move(public_path('uploads/news'), $imageName);

            News::create([
                'title' => $request->title,
                'short_content' => $request->short_content,
                'content' => $request->content,
                'category' => $request->category,
                'user_id' => Auth::user()->id,
                'show' => $request->show,
                'image' => $imagePath
            ]);

            return redirect()->back()->with('success', 'Add news successfully');
        } else {
            return redirect()->back()->with('error', 'file not found');
        }
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
        $news = News::find($id);

        if (!$news) {
            return response()->json([
                'message' => 'news not found',
            ], 404);
        }

        return view('admin.news.edit', compact('news'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required',
            'image' => 'nullable|mimes:png,jpg,gif,webp,jpeg',
            'short_content' => 'required',
            'content' => 'nullable',
            'category' => 'required',
            'show' => 'required'
        ]);

        $news = News::find($id);

        if (!$news) {
            return redirect()->back()->with('error', 'news not found');
        }


        if ($request->hasFile('image')) {
            if ($news->image && file_exists(public_path($news->image))) {
                unlink(public_path($news->image));
            }

            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $imagePath = '/uploads/news/' . $imageName;
            $image->move(public_path('uploads/news'), $imageName);
        } else {
            $imagePath = $news->image;
        }

        if ($request->content){
            $content = $request->content;
        }else{
            $content = $news->content;
        }

        $news->update([
            'title' => $request->title,
            'short_content' => $request->short_content,
            'content' => $content,
            'category' => $request->category,
            'show' => $request->show,
            'image' => $imagePath
        ]);

        return redirect()->back()->with('success', 'news update successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $news = News::find($id);

        if (!$news) {
            return redirect()->back()->with('error', 'news not found');
        }

        $news->delete();

        return redirect()->back()->with('success', 'news deleted successfully');
    }
    public function uploadImage(Request $request)
    {
        if ($request->hasFile('image')) {
            $file = $request->file('image');

            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp',
            ]);

            $fileName = time() . '_' .$file->getClientOriginalName();
            $path = '/uploads/news/' . $fileName;
            $file->move(public_path('uploads/news'), $fileName);
            return response()->json([
                'url' => $path,
            ]);
        }

        return response()->json(['error' => 'No file uploaded'], 400);
    }
}
