<?php

namespace App\Http\Controllers;
use App\Models\AboutContent;
use Illuminate\Http\Request;
use DB;
class AboutController extends Controller
{
    public function about()
    {
        $ourStory = DB::table('about_contents')->where('title', 'Câu Chuyện Của Chúng Tôi')->first();
        $ourMission = DB::table('about_contents')->where('title', 'Sứ Mệnh Của Chúng Tôi')->first();
    
        return view('Front-end-Shopping.about', compact('ourStory', 'ourMission'));
    }
}
