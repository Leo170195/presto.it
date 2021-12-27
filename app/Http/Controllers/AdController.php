<?php

namespace App\Http\Controllers;

use id;
use App\Models\Ad;
use App\Models\AdImage;
use App\Models\Category;
use App\Jobs\ResizeImage;
use App\Mail\MailRevisor;
use Illuminate\Http\Request;
use App\Http\Requests\AdRequest;
use App\Jobs\GoogleVisionLabelImage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use App\Jobs\GoogleVisionRemoveFaces;
use Illuminate\Support\Facades\Storage;
use App\Jobs\GoogleVisionSafeSearchImage;

class AdController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->only('create', 'store', 'edit', 'update', 'destroy', 'revisor');
    }
    public function submit(Request $request)
    {
        $email = $request->email;
        $contact = compact('email');
        Mail::to('pluto@pluto.com')->send(new MailRevisor($contact));
        return redirect()->back()->with('status', 'Le faremo sapere');
    }

    public function search(Request $request)
    {
        $q = $request->input('q');

        $ads = Ad::search($q)->get();

        return view('result', compact('q', 'ads'));
    }

    public function revisor()
    {
        return view('revisor.form');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $categories = Category::all();

        // $uniqueSecret = $request->old('uniqueSecret', base_convert(sha1(uniqid(mt_rand())), 16, 36));

        return view('ads.form', compact('categories'));
    }

    public function upload(Request $request)
    {
        $uniqueSecret = $request->uniqueSecret;
        $fileName = $request->file('file')->store("public/temp/{$uniqueSecret}");

        dispatch(new ResizeImage(
            $fileName,
            120,
            120
        ));
        session()->push("images.{$uniqueSecret}", $fileName);

        return response()->json(
            [
                'id' => $fileName
            ]
        );
    }

    public function remove(AdRequest $request)
    {
        $uniqueSecret = $request->uniqueSecret;
        $fileName = $request->input('id');

        session()->push("removedimages.{$uniqueSecret}", $fileName);

        Storage::delete($fileName);

        return response()->json('ok');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdRequest $request)
    {
        $ad = Ad::create([
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'category_id' => $request->name,
            'user_id' => Auth::id(),
        ]);
        $uniqueSecret = $request->input('uniqueSecret');
    
        $images = session()->get("images.{$uniqueSecret}", []);
        $removedImages = session()->get("removedimages.{$uniqueSecret}", []);

        $images = array_diff($images, $removedImages);


        foreach ($images as $image) {
            $i = new AdImage();
            $fileName = basename($image);
            $newFileName = "public/ads/{$ad->id}/{$fileName}";
            Storage::move($image, $newFileName);

            // dispatch(new ResizeImage(
            //     $newFileName,
            //     150,
            //     150
            // ));
            // dispatch(new ResizeImage(
            //     $newFileName,
            //     500,
            //     400
            // ));

            $i->file = $newFileName;
            $i->ad_id = $ad->id;
            $i->save();

            // dispatch(new GoogleVisionSafeSearchImage($i->id));
            // dispatch(new GoogleVisionLabelImage($i->id));
            // dispatch(new GoogleVisionRemoveFaces($i->id));

            GoogleVisionSafeSearchImage::withChain([

                new GoogleVisionLabelImage($i->id),
                new GoogleVisionRemoveFaces($i->id),
                new ResizeImage($i->file, 500, 400),
                new ResizeImage($i->file, 150, 150),
            ])->dispatch($i->id);
        }

        File::deleteDirectory(storage_path("/app/public/temp/{uniquesecret}"));

        return redirect()->back()->with('status', 'Annuncio inserito correttamente');
    }

    public function getImages(Request $request)
    {

        $uniqueSecret = $request->uniqueSecret;
        $images = session()->get("images.{$uniqueSecret}", []);
        $removedImages = session()->get("removedimages.{$uniqueSecret}", []);

        $images = array_diff($images, $removedImages);
        $data = [];
        foreach ($images as $image) {
            $data[] = [
                'id' => $image,
                'src' => AdImage::getUrlByFilePath($image, 120, 120)
            ];
        }
        return response()->json($data);
    }
    
    public function show(Ad $ad)
    {
        if ($ad->is_accepted == 1) {
            return view('ads.show', compact('ad'));
        } else {
            return redirect(route('home'));
        }
    }

    public function edit(Ad $ad)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ad  $ad
     * @return \Illuminate\Http\Response
     */
    public function update(AdRequest $request, Ad $ad)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ad  $ad
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ad $ad)
    {
        //
    }
}
