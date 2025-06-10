<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="{{ asset('css/carousel.css') }}" rel="stylesheet">
    <link href="{{ asset('css/side-bar.css') }}" rel="stylesheet">
    <link href="{{ asset('images/favicon.ico') }}" rel="shortcut icon" type="image/x-icon">
</head>
<body>
<div class="container-fluid">
    <div class="row">

        <header class="p-3 border-bottom">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 link-body-emphasis text-decoration-none me-lg-auto">
                    paw home
                </a>
                <div class="dropdown text-end">
                    @if(!session('member_id'))
                        <a href="#" class="btn btn-outline-primary me-2" data-bs-toggle="modal" data-bs-target="#modalSignin">ログイン</a>
                    @else
                        <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="true">
                            <img src="{{ asset('images/account.png') }}" alt="mdo" width="32" height="32" class="rounded-circle">
                        </a>
                        <ul class="dropdown-menu text-small" data-popper-placement="top-start" style="position: absolute; inset: auto auto 0px 0px; margin: 0px; transform: translate3d(0px, -34px, 0px);">
                            <li><a class="dropdown-item" href="{{ route('member.index') }}">プロフィール</a></li>
                            <li><a class="dropdown-item" href="{{ route('favorite.index') }}">お気に入り一覧</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="{{ route('member.logout') }}">ログアウト</a></li>
                        </ul>
                    @endif
                </div>
            </div>
        </header>

        <div class="col-md-3 col-lg-2 d-md-block sidebar collapse">
            <div class="position-sticky">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link sidebar-item" href="{{ route('top.index') }}">
                            <i class="bi bi-house-fill me-2"></i>ホーム
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link sidebar-item" href="{{ route('search.index', 1) }}">
                            <i class="bi bi-search me-2"></i>保護犬を探す
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link sidebar-item" href="{{ route('search.index', 2) }}">
                            <i class="bi bi-search me-2"></i>保護猫を探す
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link sidebar-item" href="#">
                            <i class="bi bi-info-circle me-2"></i>譲渡について
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link sidebar-item" href="#">
                            <i class="bi bi-chat-dots me-2"></i>お問い合わせ
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <main class="col-md-9 ms-sm-auto col-lg-10">
            {{ $slot }}
        </main>

        <footer>
            <p class="float-end"><a href="{{ route('top.index') }}">トップに戻る</a></p>
        </footer>

    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="modalSignin" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content rounded-4 shadow">
            <div class="modal-header p-5 pb-4 border-bottom-0">
                <h1 class="fw-bold mb-0 fs-2">ログイン</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-5 pt-0">
                @if($errors->has('login'))
                    <div class="alert alert-danger login-error">
                        {{ $errors->first('login') }}
                    </div>
                @endif
                <form method="post" action="{{ route('member.login') }}">
                    @csrf
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control rounded-3" id="email" name="email" placeholder="name@example.com" value="{{ old('email') }}" required>
                        <label for="email">メールアドレス</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control rounded-3" id="password" name="password" placeholder="Password" required>
                        <label for="password">パスワード</label>
                    </div>
                    <button class="w-100 mb-2 btn btn-lg rounded-3 btn-primary" type="submit">ログイン</button>
                    <a href="{{ route('member.index') }}" class="d-block">新規会員登録はこちら</a>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('js/utils.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>
