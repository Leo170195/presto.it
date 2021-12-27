<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Models\AdImage;
use App\Models\Category;
use App\Models\Color;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $colors = Color::all();
        // dd($colors);
        $c = [];
        foreach ($colors as $color) {
            $c[]= $color->color;
        }
        
        $categories = Category::all();
        $ads = Ad::where('is_accepted', 1)->latest()->paginate(6);
        return view('home', compact('ads', 'categories', 'c'));
    }

    public function search(Category $category){
        $ads = Category::find($category->id)->ads()->get();
        return view('category.search', compact('category', 'ads'));

    }

    public function locale($locale){
        session()->put('locale', $locale);
        return redirect()->back();
    }


}
