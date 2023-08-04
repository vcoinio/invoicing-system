<x-app-layout>
    @if ($userExists)
    <h1>Invoicing application homepage</h1>
    <a href="categories" class="create-button" role="button">Fruit category page</a>
    <a href="fruits" class="create-button" role="button">Fruit detail page</a>
    <a href="invoices" class="create-button" role="button">Invoice page</a>

    @else

    <a href="/login"> Please login</a>
    @endif
</x-app-layout>