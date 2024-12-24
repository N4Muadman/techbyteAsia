<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function index(){
        $feedbacks = Contact::orderBy('created_at', 'desc')->paginate(10);

        return view('admin.contact', compact('feedbacks'));
    }

    public function show($id){

    }

    public function delete($id){
        $feedback = Contact::find($id);

        if (!$feedback){
            return redirect()->back()->with('error', 'Feedback not found');
        }

        $feedback->delete();

        return redirect()->back()->with('success', 'deleted successfully');
    }
}
