<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Models\AdImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RevisorController extends Controller
{
    public function __construct()
    {

        $this->middleware('auth.revisor');
    }

    public function index()
    {

        $trash = Ad::where('is_accepted', null)->latest()->take(5)->get();
        $ad = Ad::where('is_accepted', 0)
            ->first();
        
        return view('revisor.home', compact('ad', 'trash'));
    }

    public function setAccept($ad_id, $value) {

        $ad = Ad::find($ad_id);
        $ad->is_accepted = $value;
        $ad->save();
        return redirect()->back()->with('status', 'annuncio accettato');
    }


    public function reject(Ad $ad)
    {
        $ad->is_accepted = null;
        $ad->save();
        return redirect()->back()->with('status', 'annuncio spostato nel cestino');
        // return $this->setAccept($ad_id, false);
    }


    public function accept($ad_id)
    {
        return $this->setAccept($ad_id, true);
    }

    public function undo(Ad $trash){
        $trash->is_accepted = 0;
        $trash->save();
        return redirect()->back();

    }

    public function destroy(Ad $t)
    {
        //se l'annuncio ha immagini
        //eliminiamo anche la cartella in storage
        if(count($t->images) > 0){
            $t->images->each(
                function($image){
                    $image->delete();
                }
            );

            Storage::deleteDirectory("/public/ads/{$t->id}");
        }
        
        $t->delete();
        return redirect()->back()->with('status', "annuncio $t->title eliminato");
     }
}
