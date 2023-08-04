<x-app-layout>
    <h1>Register Fruit master information here</h1>

    <form action="/fruits/create" method="post">
        @csrf
        <input class="form-control" type="text" name="FruitName" placeholder="Enter Fruit Name">
        <input class="form-control" type="text" name="Unit" placeholder="Enter Unit">
        <input class="form-control" type="text" name="Price" placeholder="Enter Price">
        <button class="create-fruit" type="submit">Submit</button>
        <div>
            <label>Choose category</label>
            <select name="selectedCategory">
                @foreach ($categories as $category)
                    <option value="{{ $category->FruitType }}">
                        {{ $category->FruitType }}
                    </option>
                @endforeach
            </select>
        </div>
    </form>
</x-app-layout>