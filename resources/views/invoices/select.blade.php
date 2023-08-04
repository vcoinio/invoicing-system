<x-app-layout>
    <a href="fruits/create" class="create-button" role="button">Register a new fruit master</a>
    <h1>This table show all fruits data</h1>
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
</x-app-layout>