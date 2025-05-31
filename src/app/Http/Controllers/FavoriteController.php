<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\RescuePet;
use Illuminate\Support\Facades\DB;

class FavoriteController extends Controller
{
    /**
     * お気に入り一覧表示
     */
    public function index()
    {
        $favorites = $this->getMemberFavorites();
        $rescuePets = $this->getFavoritePets($favorites);

        return view('favorite.index', compact('rescuePets', 'favorites'));
    }

    /**
     * お気に入りペットID取得
     *
     * @return array お気に入りペットID
     */
    private function getMemberFavorites()
    {
        if (!session('member_id')) { return []; }

        return Favorite::where([
            ['delete_flg', 0],
            ['member_id', session('member_id')]
        ])
            ->pluck('rescue_pets_id')
            ->toArray();
    }

    /**
     * お気に入り登録のペット情報取得
     *
     * @param array $favoriteIds お気に入りペットID
     * @return \Illuminate\Database\Eloquent\Collection お気に入りペット情報
     */
    private function getFavoritePets(array $favoriteIds)
    {
        return RescuePet::select(
            'rescue_pets.rescue_pets_id',
            'rescue_pets.picture',
            'rescue_pets.name',
            DB::raw(RescuePet::AGE_CALCULATION_SQL),
            'rescue_pets.created_at',
            'rescue_pets.self_introduction',
            'genders.name as gender_name',
            'pet_type_details.name as pet_type_detail_name'
        )
            ->whereIn('rescue_pets.rescue_pets_id', $favoriteIds)
            ->leftJoin('genders', 'rescue_pets.gender_id', '=', 'genders.gender_id')
            ->leftJoin('pet_type_details', 'rescue_pets.pet_type_detail_id', '=', 'pet_type_details.pet_type_detail_id')
            ->orderBy('created_at', 'desc')
            ->get();
    }
}
