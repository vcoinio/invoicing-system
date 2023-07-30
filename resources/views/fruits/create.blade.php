<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Register Fruit master information here</h1>
    <div>
        <label>Choose category</label>
        <select name="selectedCategory">
            @foreach ($categories as $category)
                <option value="{{ $category->id }}">
                    {{ $category->FruitType }}
                </option>
            @endforeach
        </select>
    </div>
    <form action="/fruits/create" method="post">
        @csrf
        <input class="form-control" type="text" name="FruitName" placeholder="Enter Fruit Name">
        <input class="form-control" type="text" name="Unit" placeholder="Enter Unit">
        <input class="form-control" type="text" name="Price" placeholder="Enter Price">
        <button class="create-fruit" type="submit">Submit</button>
    </form>
</body>
</html>