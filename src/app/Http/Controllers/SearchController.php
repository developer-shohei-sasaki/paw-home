<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\PetType;
use App\Models\RescuePet;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function index($pet_type_id)
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
            ->where('rescue_pets.pet_type_id', $pet_type_id)
            ->leftJoin('genders', 'rescue_pets.gender_id', '=', 'genders.gender_id')
            ->leftJoin('pet_type_details', 'rescue_pets.pet_type_detail_id', '=', 'pet_type_details.pet_type_detail_id')
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

        $pet_type_name = PetType::query()->where([
            ['pet_type_id', $pet_type_id],
            ['delete_flg', 0]
        ])
            ->pluck('name')
            ->firstOrFail();

        return view('search.index')
            ->with('rescue_pets', $rescue_pets)
            ->with('favorites', $favorites)
            ->with('pet_type_name', $pet_type_name);
    }
}
