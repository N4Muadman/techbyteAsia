<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use App\Models\PortfolioCategory;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $portfolios = Portfolio::with('category')->orderBy('created_at', 'desc')->paginate(10);
        $categories = PortfolioCategory::all();

        return view('admin.portfolio', compact('portfolios', 'categories'));
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
            'name' => 'required',
            'image' => 'required|mimes:png,jpg, jpeg',
            'content' => 'required',
            'link' => 'required',
            'category_id' => 'required|integer',
        ]);

        if ($request->hasFile('image')){
            $image = $request->file('image');
            $imageName = time() .'_' . $image->getClientOriginalName();
            $imagePath = '/uploads/portfolios/' .$imageName;
            $image->move(public_path('uploads/portfolios'), $imageName);

            Portfolio::create([
                'name' => $request->name,
                'image' => $imagePath,
                'content' => $request->content,
                'link' => $request->link,
                'category_id' => $request->category_id,
            ]);

            return redirect()->back()->with('success', 'Add portfolio successfully');
        }else{
            return redirect()->back()->with('error', 'File not found');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $portfolio = Portfolio::find($id);

        if (!$portfolio){
            return response()->json([
                'message' => 'portfolio not found',
            ], 404);
        }

        return response()->json([
            'message' => 'portfolio details',
            'portfolio' => $portfolio
        ], 200);
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
            'name' => 'required',
            'image' => 'nullable|mimes:png,jpg, jpeg',
            'content' => 'required',
            'link' => 'required',
            'category_id' => 'required|integer',
        ]);

        $portfolio = Portfolio::find($id);
        if (!$portfolio){
            return redirect()->back()->with('error', 'portfolio not found');
        }

        if ($request->hasFile('image')){
            if ($portfolio->image && file_exists(public_path($portfolio->image))) {
                unlink(public_path($portfolio->image));
            }

            $image = $request->file('image');
            $imageName = time() .'_' . $image->getClientOriginalName();
            $imagePath = '/uploads/portfolios/' .$imageName;
            $image->move(public_path('uploads/portfolios'), $imageName);
        }else{
            $imagePath = $portfolio->image;
        }

        $portfolio->update([
            'name' => $request->name,
            'image' => $imagePath,
            'content' => $request->content,
            'link' => $request->link,
            'category_id' => $request->category_id,
        ]);

        return redirect()->back()->with('success', 'Update portfolio successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $portfolio = Portfolio::find($id);
        if (!$portfolio){
            return redirect()->back()->with('error', 'portfolio not found');
        }

        $portfolio->delete();

        return redirect()->back()->with('success', 'portfolio successfully deleted');
    }
}
