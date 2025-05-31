<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use Illuminate\Http\Request;
use App\Models\RescuePet;
use Illuminate\Support\Facades\Log;

class PetController extends Controller
{
    public function show($rescue_pets_id)
    {
        $rescue_pet = RescuePet::query()->where('rescue_pets_id', $rescue_pets_id)->firstOrFail();
        return view('pet.show')->with(['rescue_pet' => $rescue_pet]);
    }

    public function favorite(Request $request)
    {
        $favorite = Favorite::query()->where([
            ['member_id', session('member_id')],
            ['rescue_pets_id', $request->input('rescue_pets_id')],
            ['delete_flg', 0]
        ]);

        if ($favorite->exists()) {
            $favorite->update(['delete_flg' => 1]);
        } else {
            $favorite = new Favorite;
            $favorite->fill([
                'member_id' => session('member_id'),
                'rescue_pets_id' => $request->input('rescue_pets_id')
            ])->save();
        }
    }
}
