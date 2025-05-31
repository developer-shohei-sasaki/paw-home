<div class="row">
    @foreach($rescue_pets as $rescue_pet)
        <div class="{{ $col_class_name }} mb-3 text-center">
            <a class="text-decoration-none text-black" href="{{ route('pet.show', $rescue_pet->rescue_pets_id) }}">
                <div class="mb-3">
                    <img src="{{ $rescue_pet->picture }}" alt="{{ $rescue_pet->name }}" style="margin: 0 auto; display: block; border-radius: 50%; width: 200px; height: 200px; object-fit: cover;">
                </div>
                <p>
                    {{ $rescue_pet->pet_type_detail_name }}
                    <br>
                    {{ $rescue_pet->age }} {{ $rescue_pet->gender_name }}
                    <br>
                    {{ $rescue_pet->self_introduction }}
                </p>
            </a>
            @if(in_array($rescue_pet->rescue_pets_id, $favorites))
                <div class="btn btn-warning" onclick="switchFavorite(this, {{ $rescue_pet->rescue_pets_id }});">★ お気に入り登録済</div>
            @else
                <div class="btn btn-outline-warning" onclick="switchFavorite(this, {{ $rescue_pet->rescue_pets_id }});">☆ お気に入り登録</div>
            @endif
        </div>
    @endforeach
</div>
