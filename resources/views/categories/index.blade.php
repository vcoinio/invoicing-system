<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>This is all categories of fruit:</h1>
    {{-- @if (1<2)
        <h3> 1 is really smaller than 2</h3>
    @else <h3>1 is bigger than 2</h3>
    @endif --}}
    {{-- <img src="{{ asset('storage/apple.png') }}" width="100" height="100" alt=""> --}}
    @foreach ($categories as $category)
        <li class='list-categories'>
            <div>{{ $category->FruitType }}</div>
        </li>
    @endforeach
    <a href="categories/create" class="create-button" role="button">Register a new fruit type</a>

</body>
</html>