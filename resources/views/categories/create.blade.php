<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Enter Fruit category information here</h1>
    <form action="/categories/create" method="post">
        @csrf
        <input class="form-control" type="text" name="FruitType" placeholder="Enter Fruit Category">
        <button class="create-button" type="submit">Submit</button>
    </form>
</body>
</html>