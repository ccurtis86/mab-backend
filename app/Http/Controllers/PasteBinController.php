<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\PasteBin;

use Carbon\Carbon;

class PasteBinController extends Controller
{

    public function showall(){
        dd(PasteBin::get()->toArray());
        return;
    }

    public function delete(Request $request, $slug){
        PasteBin::where('slug', $slug)->delete();
        return ['deleted' => true];
    }

    public function get(Request $request, $slug){

        $data = PasteBin::select('slug', 'pastebin_value', 'expiry')
            ->where('slug', $slug)
            ->first();
        if(!empty($data)){

            return [
                'slug' => $data->slug,
                'pastebin_value' => $data->pastebin_value,
                'expiry' => $data->expiry->format('U')
            ];
        }else{
            return [];
        }

    }

    public function check(Request $request, $slug){
        $slug = $this->get($request, $slug);
        if(is_array($slug)){
            return view('pastebin_result', ['slug' => $slug['slug']]);
        }else{
            return $slug;
        }


    }

    //
    public function save(Request $request){
        //if no slug provided lets make one
        if(is_null($request->slug)){
            $slug = Str::random(16);
        }else{
            $slug = $request->slug;
        }
        PasteBin::create([
            'slug' => $slug,
            'pastebin_value' => $request->userString,
            'expiry' => Carbon::now()->addMinutes(15)
        ]);

        return ['slug' => $slug];
    }
}
