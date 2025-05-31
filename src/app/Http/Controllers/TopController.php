<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\RescuePet;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TopController extends Controller
{
    public function index()
    {
        $rescue_pets = RescuePet::select(
            'rescue_pets.rescue_pets_id',
            'rescue_pets.picture',
            'rescue_pets.name',
            DB::raw('CASE
                WHEN TIMESTAMPDIFF(YEAR, rescue_pets.birthday, CURDATE()) = 0
                THEN CONCAT(TIMESTAMPDIFF(MONTH, rescue_pets.birthday, CURDATE()), "ヶ月")
                ELSE CONCAT(TIMESTAMPDIFF(YEAR, rescue_pets.birthday, CURDATE()), "才")
                END AS age'),
            'rescue_pets.created_at',
            'rescue_pets.self_introduction',
            'genders.name as gender_name',
            'pet_type_details.name as pet_type_detail_name'
        )
            ->leftJoin('genders', 'rescue_pets.gender_id', '=', 'genders.gender_id')
            ->leftJoin('pet_type_details', 'rescue_pets.pet_type_detail_id', '=', 'pet_type_details.pet_type_detail_id')
            ->limit(6)
            ->orderBy('created_at', 'desc')
            ->get();

        $favorites = [];
        if (session('member_id')) {
            $favorites = Favorite::where([
                    ['delete_flg', 0],
                    ['member_id', session('member_id')]
                ])
                ->pluck('rescue_pets_id')
                ->toArray();
        }

        return view('top.index')
            ->with('rescue_pets', $rescue_pets)
            ->with('favorites', $favorites);
    }
}
