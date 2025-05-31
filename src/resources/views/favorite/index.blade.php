<x-layout>
    <x-slot:title>
        お気に入り一覧 | paw home
    </x-slot:title>
    <h1 class="mb-4 mt-4" style="padding: 1rem 2rem; border-left: 4px solid #000; font-size: 30px; font-weight: bold;">
        お気に入り一覧
    </h1>
    @include('components.list', ['col_class_name' => 'col-lg-3'])
</x-layout>
