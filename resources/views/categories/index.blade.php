<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
</head>
<body>
    <h1>This is all categories of fruit:</h1>
    @foreach ($categories as $category)
    <li class='list-category'>
        <div>{{ $category->FruitType }}</div>
    </li>
    @endforeach
    <a href="categories/create" class="create-button" role="button">Register a new fruit type</a>

</body>
</html>