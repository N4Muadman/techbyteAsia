<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Recruitment;
use App\Models\Application;
use Illuminate\Http\Request;

class RecruitmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $recruitments = Recruitment::with('application')->orderBy('created_at', 'desc')->get();

        return response()->json([
            'message' => 'Recruitments list',
            'recruitments' => $recruitments
        ], 200);
    }

    public function getCVofRecruitment($id){
        $cvs = Application::where('recruitment_id', $id)->get();

        return response()->json([
            'message' => 'cv list',
            'cvs' => $cvs
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'position_job' => 'required',
            'salary' => 'required',
            'time' => 'required',
            'quantity' => 'required|integer',
            'expiration_date' => 'required|date',
            'content' => 'required',
            'show' => 'required',
        ]);

        try {
            Recruitment::create($data);
            return response()->json([
                'message' => 'created recruitment successfully',
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'errors' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $recruitment = Recruitment::findOrFail($id);

            return response()->json([
                'message' => 'recruitment detail',
                'recruitment' => $recruitment
            ], 200);
        } catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['message' => 'recruiment not found'], 404);
        } catch(\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'position_job' => 'required',
            'salary' => 'required',
            'time' => 'required',
            'quantity' => 'required|integer',
            'expiration_date' => 'required|date',
            'content' => 'required',
            'show' => 'required',
        ]);
        try {
            $recruitment = Recruitment::findOrFail($id);

            $recruitment->update($data);

            return response()->json([
                'message' => 'recruitment updated successfully',
                'recruitment' => $recruitment
            ], 200);

        } catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['message' => 'recruiment not found'], 404);
        } catch(\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $recruitment = Recruitment::findOrFail($id);

            $recruitment->delete();

            return response()->json([
                'message' => 'recruitment deleted successfully'
            ], 200);

        } catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['message' => 'recruiment not found'], 404);
        } catch(\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function downloadCv($path){
        $fullPath = public_path($path);

        if (!file_exists($fullPath)) {
            return response()->json(['message' => 'File không tồn tại.'], 404);
        }

        return response()->download($fullPath);
    }
}
