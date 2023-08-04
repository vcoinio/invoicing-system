<x-app-layout>
            <a href="categories/create" class="create-button" role="button">Register a new fruit type</a>
            <h1>This is all categories of fruit:</h1>
            @foreach ($categories as $category)
            <li class='list-category'>
                <div>{{ $category->FruitType }}</div>
            </li>
            @endforeach
</x-app-layout>