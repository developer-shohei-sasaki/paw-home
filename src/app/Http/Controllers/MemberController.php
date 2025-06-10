<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use App\Http\Requests\StoreMemberRequest;

class MemberController extends Controller
{
    /**
     * 会員情報を表示
     */
    public function index()
    {
        $member = $this->getMember();

        return view('member.index', compact('member'));
    }

    /**
     * 新規会員登録
     */
    public function create(StoreMemberRequest $request)
    {
        $member = new Member;
        $member->fill([
            'last_name' => $request->input('last-name'),
            'first_name' => $request->input('first-name'),
            'birthday' => $request->input('birthday'),
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            'zip_code' => $request->input('zip-code'),
            'address' => $request->input('address')
        ])->save();

        session(['member_id' => $member->id]);

        return redirect()->route('top.index');
    }

    /**
     * ログイン
     */
    public function login(Request $request)
    {
        try {
            $member = Member::query()->where([
                'email' => $request->input('email'),
                'password' => $request->input('password'),
                'delete_flg' => 0
            ])->first();

            if (!$member) {
                return back()->withErrors([
                    'login' => 'メールアドレスまたはパスワードが正しくありません。'
                ])->withInput(['email' => $request->input('email')]);
            }

            session(['member_id' => $member->member_id]);

            return redirect()->route('top.index');
        } catch (\Exception $e) {
            return back()->withErrors([
                'login' => 'ログイン処理中にエラーが発生しました。'
            ])->withInput(['email' => $request->input('email')]);
        }
    }

    /**
     * ログアウト
     */
    public function logout()
    {
        session()->flush();

        return redirect()->route('top.index');
    }

    /**
     * 会員情報を取得
     *
     * @return Member|array 会員情報
     */
    private function getMember()
    {
        if (!session('member_id')) { return []; }

        return Member::query()->where([
            'member_id' => session('member_id'),
            'delete_flg' => 0
        ])->firstOrFail();
    }
}
