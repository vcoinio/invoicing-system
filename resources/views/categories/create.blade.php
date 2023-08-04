<x-app-layout>
    <h1>Enter Fruit category information here</h1>
    <form action="/categories/create" method="post">
        @csrf
        <input class="form-control" type="text" name="FruitType" placeholder="Enter Fruit Category">
        <button class="create-button" type="submit">Submit</button>
    </form>
</x-app-layout>