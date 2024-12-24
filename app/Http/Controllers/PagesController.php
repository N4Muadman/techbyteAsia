<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Banner;
use App\Models\Contact;
use App\Models\News;
use App\Models\Portfolio;
use App\Models\Recruitment;
use Illuminate\Http\Request;

use function Laravel\Prompts\alert;

class PagesController extends Controller
{
    public function home(){
        $banners = Banner::where('status', 1)->get();
        return view('pages.home', compact('banners'));
    }
    public function aboutUs(){
        return view('pages.aboutUs');
    }
    public function portfolio(){
        $portfolios = Portfolio::with('category')->get();
        return view('pages.portfolio', compact('portfolios'));
    }
    public function contact(){
        return view('pages.contact');
    }
    public function sendContact(Request $request){
        $request->validate([
            'full_name' => 'required',
            'phone_number' => 'required',
            'email' => 'required|email',
        ]);

        Contact::create([
            'full_name' => $request->full_name,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
            'content' => $request->content,
        ]);

        return redirect()->back()->with('success', 'Send contact successfully');
    }
    public function recruitment(){
        $recruitments = Recruitment::where('show', 1)->where('expiration_date', '>=', today())->get();

        return view('pages.recruitment', compact('recruitments'));
    }

    public function recruitmentDetail($id){
        $recruitment = Recruitment::where('id', $id)->where('show', 1)->where('expiration_date', '>=', today())->first();
        if(!$recruitment){
            return view('pages.404');
        }

        return view('pages.recruitment-detail', compact('recruitment'));
    }

    public function applyRecruitment(Request $request, $id){
        $request->validate([
            'full_name' => 'required',
            'phone_number' => 'required',
            'email' => 'required|email',
            'cv' => 'required|mimes:pdf,docx,png,jpg,jpeg',
        ]);

        $recruitment = Recruitment::where('id', $id)->where('show', 1)->where('expiration_date', '>=', today())->first();

        if (!$recruitment){
            return redirect()->back()->with('error', 'The vacancy does not exist or has expired');
        }
        if($request->hasFile('cv')){
            $file = $request->file('cv');
            $fileName = time().'_'. $file->getClientOriginalName();
            $cvPath = '/uploads/cvs/' .$fileName;
            $file->move(public_path('uploads/cvs'), $fileName);

            Application::create([
                'full_name' => $request->full_name,
                'phone_number' => $request->phone_number,
                'email' => $request->email,
                'cv_path' => $cvPath,
                'cover_letter' => $request->cover_letter,
                'recruitment_id' => $recruitment->id,
            ]);

            return redirect()->back()->with('success', 'Applied to recruitment successfully');
        }
        else return redirect()->back()->with('error', 'File CV not found');
    }

    public function news() {
        $newsQueyry = News::with('user')->where('show', 1);

        $news_main =(clone $newsQueyry)->orderBy('created_at', 'desc')->take(5)->get();
        $new_main_id = $news_main->pluck('id');

        $quickView =(clone $newsQueyry)->whereNotIn('id', $new_main_id)->orderBy('created_at', 'desc')->take(8)->get();
        $quickViewId = $quickView->pluck('id');

        $news_remaining = $newsQueyry->whereNotIn('id', $new_main_id->merge($quickViewId))->orderBy('created_at', 'desc')->paginate(9);
        return view('pages.news', compact('news_main', 'quickView', 'news_remaining'));
    }

    public function newsDetail($id){
        $news = News::where('id', $id)->where('show', 1)->first();

        if(!$news){
            return view('pages.404');
        }

        $post_new = News::where('id', '!=',$id)->orderBy('created_at', 'desc')->take(8)->get();

        return view('pages.news-detail', compact('news', 'post_new'));
    }
}
