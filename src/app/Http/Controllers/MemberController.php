<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MemberController extends Controller
{
    public function index()
    {
        $member = [];
        if (session('member_id')) {
            $member = Member::query()->where([
                ['member_id', session('member_id')],
                ['delete_flg', 0]
            ])->firstOrFail();
        }

        return view('member.index')->with(['member' => $member]);
    }

    public function create(Request $request)
    {
        $member = new Member;
        $member->fill([
            'last_name'     => $request->input('last-name'),
            'first_name'    => $request->input('first-name'),
            'birthday'      => $request->input('birthday'),
            'email'         => $request->input('email'),
            'password'      => $request->input('password'),
            'zip_code'      => $request->input('zip-code'),
            'address'       => $request->input('address')
        ])->save();
        session(['member_id' => $member->id]);
        return redirect()->route('top.index');
    }

    public function login(Request $request)
    {
        $member = Member::query()->where([
            ['email', '=', $request->input('email')],
            ['password', '=', $request->input('password')],
            ['delete_flg', '=', '0']
        ])->firstOrFail();
        \session(['member_id' => $member->member_id]);
        return redirect()->route('top.index');
    }

    public function logout()
    {
        \session()->flush();
        return redirect()->route('top.index');
    }
}
