<x-layout>
    <x-slot:title>{{ $rescuePet->name }} | paw home</x-slot:title>

    <div class="container mt-5">
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('top.index') }}">ホーム</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $rescuePet->name }}の詳細</li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-md-6 mb-4">
                <div class="main-image-container mb-3">
                    <img src="{{ $rescuePet->picture }}" alt="{{ $rescuePet->name }}" class="img-fluid rounded w-100" style="object-fit: cover; height: 400px;">
                </div>
                <div class="d-flex flex-wrap gap-2 justify-content-start">
                    <div class="thumbnail-image active">
                        <img src="{{ $rescuePet->picture }}" alt="{{ $rescuePet->name }}" class="img-thumbnail" style="width: 80px; height: 80px; object-fit: cover;">
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="pet-info bg-light p-4 rounded">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h1 class="fs-3 fw-bold mb-0">{{ $rescuePet->name }}</h1>
                        <button class="btn btn-outline-danger">
                            <i class="bi bi-heart"></i> お気に入り
                        </button>
                    </div>

                    <div class="pet-tags mb-3">
                        <span class="badge bg-primary me-2">{{ $rescuePet->pet_type_detail_name }}</span>
                        <span class="badge bg-secondary me-2">{{ $rescuePet->gender_name }}</span>
                        <span class="badge bg-info">{{ $rescuePet->age }}</span>
                    </div>

                    <table class="table">
                        <tbody>
                        <tr>
                            <th scope="row" style="width: 30%;">年齢</th>
                            <td>{{ $rescuePet->age }}</td>
                        </tr>
                        <tr>
                            <th scope="row">性別</th>
                            <td>{{ $rescuePet->gender_name }}</td>
                        </tr>
                        <tr>
                            <th scope="row">種類</th>
                            <td>{{ $rescuePet->pet_type_detail_name }}</td>
                        </tr>
                        <!-- 追加情報があれば以下に追加 -->
                        <tr>
                            <th scope="row">サイズ</th>
                            <td>中型</td>
                        </tr>
                        <tr>
                            <th scope="row">避妊去勢</th>
                            <td>済み</td>
                        </tr>
                        <tr>
                            <th scope="row">ワクチン</th>
                            <td>接種済み</td>
                        </tr>
                        </tbody>
                    </table>

                    <div class="shelter-info mt-4 p-3 border rounded">
                        <h5 class="fw-bold"><i class="bi bi-house-heart"></i> 保護団体</h5>
                        <p class="mb-1">NPO法人 ペットレスキュー</p>
                        <p class="mb-1"><i class="bi bi-geo-alt"></i> 東京都新宿区</p>
                    </div>

                    <div class="mt-4">
                        <a href="#" class="btn btn-primary btn-lg w-100">
                            <i class="bi bi-envelope-heart"></i> この子に会いたい
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="pet-description mt-5">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h2 class="fs-5 mb-0">{{ $rescuePet->name }}の自己紹介</h2>
                </div>
                <div class="card-body">
                    <p>{{ $rescuePet->self_introduction }}</p>
                </div>
            </div>
        </div>

        <div class="pet-personality mt-4">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h2 class="fs-5 mb-0">性格・特徴</h2>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item"><i class="bi bi-check-circle-fill text-success me-2"></i>とても人懐っこい性格です</li>
                                <li class="list-group-item"><i class="bi bi-check-circle-fill text-success me-2"></i>他の犬とも仲良くできます</li>
                                <li class="list-group-item"><i class="bi bi-check-circle-fill text-success me-2"></i>散歩が大好きです</li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item"><i class="bi bi-check-circle-fill text-success me-2"></i>落ち着いた性格です</li>
                                <li class="list-group-item"><i class="bi bi-check-circle-fill text-success me-2"></i>トイレのしつけができています</li>
                                <li class="list-group-item"><i class="bi bi-check-circle-fill text-success me-2"></i>留守番も得意です</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="adoption-conditions mt-4 mb-5">
            <div class="card">
                <div class="card-header bg-warning">
                    <h2 class="fs-5 mb-0">譲渡条件</h2>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><i class="bi bi-exclamation-circle me-2"></i>終生飼育できる方</li>
                        <li class="list-group-item"><i class="bi bi-exclamation-circle me-2"></i>定期的な健康診断ができる方</li>
                        <li class="list-group-item"><i class="bi bi-exclamation-circle me-2"></i>家族全員が同意している方</li>
                        <li class="list-group-item"><i class="bi bi-exclamation-circle me-2"></i>適切な環境で飼育できる方</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="related-pets mt-5 mb-5">
            <h3 class="mb-4" style="padding: 0.5rem 1rem; border-left: 4px solid #000; font-size: 24px; font-weight: bold;">その他の保護犬・保護猫</h3>
            <div class="row">
                <div class="col-md-4 col-lg-3 mb-4">
                    <div class="card h-100">
                        <img src="{{ asset('images/placeholder.jpg') }}" class="card-img-top" alt="関連ペット" style="height: 180px; object-fit: cover;">
                        <div class="card-body text-center">
                            <h5 class="card-title">モモ</h5>
                            <p class="card-text">柴犬 / 2才 / メス</p>
                            <a href="#" class="btn btn-sm btn-outline-primary">詳細を見る</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 col-lg-3 mb-4">
                    <div class="card h-100">
                        <img src="{{ asset('images/placeholder.jpg') }}" class="card-img-top" alt="関連ペット" style="height: 180px; object-fit: cover;">
                        <div class="card-body text-center">
                            <h5 class="card-title">レオ</h5>
                            <p class="card-text">雑種 / 1才 / オス</p>
                            <a href="#" class="btn btn-sm btn-outline-primary">詳細を見る</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 col-lg-3 mb-4">
                    <div class="card h-100">
                        <img src="{{ asset('images/placeholder.jpg') }}" class="card-img-top" alt="関連ペット" style="height: 180px; object-fit: cover;">
                        <div class="card-body text-center">
                            <h5 class="card-title">ミケ</h5>
                            <p class="card-text">三毛猫 / 8ヶ月 / メス</p>
                            <a href="#" class="btn btn-sm btn-outline-primary">詳細を見る</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 col-lg-3 mb-4">
                    <div class="card h-100">
                        <img src="{{ asset('images/placeholder.jpg') }}" class="card-img-top" alt="関連ペット" style="height: 180px; object-fit: cover;">
                        <div class="card-body text-center">
                            <h5 class="card-title">クロ</h5>
                            <p class="card-text">黒猫 / 3才 / オス</p>
                            <a href="#" class="btn btn-sm btn-outline-primary">詳細を見る</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
