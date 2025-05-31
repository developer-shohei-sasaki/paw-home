<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\RescuePet;
use Illuminate\Support\Facades\DB;

class TopController extends Controller
{
    // 新着情報の最大表示件数
    private const PETS_LIMIT = 6;

    // 年齢算出用のクエリ
    private const AGE_CALCULATION_SQL = 'CASE
        WHEN TIMESTAMPDIFF(YEAR, rescue_pets.birthday, CURDATE()) = 0
        THEN CONCAT(TIMESTAMPDIFF(MONTH, rescue_pets.birthday, CURDATE()), "ヶ月")
        ELSE CONCAT(TIMESTAMPDIFF(YEAR, rescue_pets.birthday, CURDATE()), "才")
        END AS age';

    public function index()
    {
        $rescuePets = $this->getRecentRescuePets();
        $favoriteIds = $this->getMemberFavoriteIds();

        return view('top.index', compact('rescuePets', 'favoriteIds'));
    }

    /**
     * 新着の保護犬・猫情報を取得
     */
    private function getRecentRescuePets()
    {
        return RescuePet::select(
            'rescue_pets.rescue_pets_id',
            'rescue_pets.picture',
            'rescue_pets.name',
            DB::raw(self::AGE_CALCULATION_SQL),
            'rescue_pets.created_at',
            'rescue_pets.self_introduction',
            'genders.name as gender_name',
            'pet_type_details.name as pet_type_detail_name'
        )
            ->leftJoin('genders', 'rescue_pets.gender_id', '=', 'genders.gender_id')
            ->leftJoin('pet_type_details', 'rescue_pets.pet_type_detail_id', '=', 'pet_type_details.pet_type_detail_id')
            ->limit(self::PETS_LIMIT)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    /**
     * お気に入りリストを取得（ログイン時のみ）
     */
    private function getMemberFavoriteIds()
    {
        if (!session('member_id')) { return []; }

        return Favorite::where([
            ['delete_flg', 0],
            ['member_id', session('member_id')]
        ])
            ->pluck('rescue_pets_id')
            ->toArray();
    }
}
