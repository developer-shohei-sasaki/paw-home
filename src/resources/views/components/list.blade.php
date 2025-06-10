<div class="row">
    @foreach($rescuePets as $rescuePet)
        <div class="{{ $col_class_name }} mb-3 text-center">
            <a class="text-decoration-none text-black" href="{{ route('pet.show', $rescuePet->rescue_pets_id) }}">
                <div class="mb-3">
                    <img src="{{ $rescuePet->picture }}" alt="{{ $rescuePet->name }}" style="margin: 0 auto; display: block; border-radius: 50%; width: 200px; height: 200px; object-fit: cover;">
                </div>
                <p>
                    {{ $rescuePet->pet_type_detail_name }}
                    <br>
                    {{ $rescuePet->age }} {{ $rescuePet->gender_name }}
                    <br>
                    {{ $rescuePet->self_introduction }}
                </p>
            </a>
            @if(!session("member_id"))
                <a href="#" class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#modalSignin">☆ お気に入り登録</a>
            @else
                @if(in_array($rescuePet->rescue_pets_id, $favorites))
                    <div class="btn btn-warning" onclick="switchFavorite(this, {{ $rescuePet->rescue_pets_id }});">★ お気に入り登録済</div>
                @else
                    <div class="btn btn-outline-warning" onclick="switchFavorite(this, {{ $rescuePet->rescue_pets_id }});">☆ お気に入り登録</div>
                @endif
            @endif
        </div>
    @endforeach
</div>
