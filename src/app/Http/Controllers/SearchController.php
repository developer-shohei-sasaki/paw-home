<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\PetType;
use App\Models\RescuePet;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    /**
     * 検索結果一覧表示
     */
    public function index($petTypeId)
    {
        $rescuePets = $this->getRescuePetsByType($petTypeId);
        $favorites = $this->getMemberFavorites();
        $petTypeName = $this->getPetTypeName($petTypeId);

        return view('search.index', compact('rescuePets', 'favorites', 'petTypeName'));
    }

    /**
     * ペット種別に基づいたペット情報取得
     */
    private function getRescuePetsByType($petTypeId)
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
            ->where('rescue_pets.pet_type_id', $petTypeId)
            ->leftJoin('genders', 'rescue_pets.gender_id', '=', 'genders.gender_id')
            ->leftJoin('pet_type_details', 'rescue_pets.pet_type_detail_id', '=', 'pet_type_details.pet_type_detail_id')
            ->orderBy('created_at', 'desc')
            ->get();
    }

    /**
     * お気に入りペットID取得
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
     * ペットタイプ名を取得
     */
    private function getPetTypeName($petTypeId)
    {
        return PetType::query()->where([
            ['pet_type_id', $petTypeId],
            ['delete_flg', 0]
        ])
            ->pluck('name')
            ->firstOrFail();
    }
}
