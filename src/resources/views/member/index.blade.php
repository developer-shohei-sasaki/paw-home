<x-layout>
    <x-slot:title>新規会員登録 | paw home</x-slot:title>
    <div class="container">
        <div class="py-5 text-center">
            <h2>
                @if($member)
                    会員登録内容編集
                @else
                    新規会員登録
                @endif
            </h2>
        </div>

        <form class="col-lg-8 mx-auto" method="post" action="{{ route('member.create') }}">
            @csrf
            <div class="row g-3">
                <div class="col-sm-6">
                    <label for="last-name" class="form-label">姓</label>
                    <input type="text" class="form-control" id="last-name" name="last-name" value="{{ $member->last_name ?? '' }}" required="">
                </div>

                <div class="col-sm-6">
                    <label for="first-name" class="form-label">名</label>
                    <input type="text" class="form-control" id="first-name" name="first-name" value="{{ $member->first_name ?? '' }}" required="">
                </div>

                <div class="col-sm-6">
                    <label for="birthday" class="form-label">生年月日</label>
                    <input type="date" class="form-control" id="birthday" name="birthday" value="{{ $member->birthday ?? '' }}" required="">
                </div>

                <div>
                    <label for="zip-code" class="form-label">郵便番号</label>
                    <input type="text" class="form-control" id="zip-code" name="zip-code" placeholder="ハイフンなしで入力してください" maxlength="7" required="" value="{{ $member->zip_code ?? '' }}" oninput="fetchAddressByZipCode(this.value)">
                </div>

                <div>
                    <label for="address" class="form-label">住所</label>
                    <input type="text" class="form-control" id="address" name="address" required="" value="{{ $member->address ?? '' }}">
                </div>

                <div>
                    <label for="email" class="form-label">メールアドレス</label>
                    <input type="email" class="form-control" id="email" name="email" required="" value="{{ $member->email ?? '' }}" >
                </div>

                <div>
                    <label for="password" class="form-label">パスワード</label>
                    <input type="password" class="form-control" id="password" name="password" required="" value="{{ $member->password ?? '' }}">
                </div>
            </div>

            <a href="#" class="btn btn-primary my-4 w-100 btn-lg me-2" data-bs-toggle="modal" data-bs-target="#modalChoice">
                @if($member)
                    会員登録編集
                @else
                    新規会員登録
                @endif
            </a>

            <div class="modal fade" tabindex="-1" role="dialog" id="modalChoice">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content rounded-3 shadow">
                        <div class="modal-body p-4 text-center">
                            <p class="mb-2"><b>新規会員登録</b></p>
                            <p class="mb-0">こちらの内容で新規会員登録してもよろしいですか？</p>
                        </div>
                        <div class="modal-footer flex-nowrap p-0">
                            <button type="button" class="btn btn-lg btn-link fs-6 text-decoration-none col-6 py-3 m-0 rounded-0 border-end" data-bs-dismiss="modal">キャンセル</button>
                            <button type="submit" class="btn btn-lg btn-link fs-6 text-decoration-none col-6 py-3 m-0 rounded-0"><strong>登録</strong></button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</x-layout>
