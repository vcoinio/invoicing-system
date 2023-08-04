<!-- fruit_options.blade.php -->
@foreach ($fruits as $fruit)
    <option value="{{ $fruit->id }}">{{ $fruit->FruitName }}</option>
@endforeach
