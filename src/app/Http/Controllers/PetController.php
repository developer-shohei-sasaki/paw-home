<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use Illuminate\Http\Request;
use App\Models\RescuePet;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;

class PetController extends Controller
{
    /**
     * ペットの詳細情報表示
     */
    public function show(int $rescuePetsId): View
    {
        $rescuePet = $this->findRescuePetById($rescuePetsId);

        return view('pet.show', compact('rescuePet'));
    }

    /**
     * お気に入り状態を切り替え
     */
    public function favorite(Request $request): JsonResponse
    {
        $rescuePetsId = $request->input('rescue_pets_id');
        $memberId = session('member_id');

        $favorite = $this->findFavorite($memberId, $rescuePetsId);

        if ($favorite->exists()) {
            $this->removeFavorite($favorite);
            $status = 'removed';
        } else {
            $this->addFavorite($memberId, $rescuePetsId);
            $status = 'added';
        }

        return response()->json(['status' => $status]);
    }

    /**
     * ペット詳細情報取得
     */
    private function findRescuePetById(int $rescuePetsId): RescuePet
    {
        return RescuePet::where('rescue_pets_id', $rescuePetsId)->firstOrFail();
    }

    /**
     * お気に入り情報取得
     */
    private function findFavorite(int $memberId, int $rescuePetsId)
    {
        return Favorite::where([
            ['member_id', $memberId],
            ['rescue_pets_id', $rescuePetsId],
            ['delete_flg', 0]
        ]);
    }

    /**
     * お気に入り削除
     */
    private function removeFavorite($favorite): void
    {
        $favorite->update(['delete_flg' => 1]);
    }

    /**
     * お気に入り追加
     */
    private function addFavorite(int $memberId, int $rescuePetsId): void
    {
        $favorite = new Favorite();
        $favorite->fill([
            'member_id' => $memberId,
            'rescue_pets_id' => $rescuePetsId
        ])->save();
    }
}
