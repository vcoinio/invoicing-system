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
    <h1>This page will show Fruits Master</h1>
    <li class='list-categories'>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>FruitCategory</th>
                    <th>FruitName</th>
                    <th>Unit</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($fruits as $fruit)
                    <tr>
                        <td>{{ $fruit->id }}</td>
                        <td>{{ $fruit->FruitCategory }}</td>
                        <td>{{ $fruit->FruitName }}</td>
                        <td>{{ $fruit->Unit }}</td>
                        <td>{{ $fruit->Price }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </li>

    <a href="fruits/create" class="create-fruit" role="button">Register a new fruit master</a>
</body>
</html>