<x-form method="{{ $method }}" action="{{ $action }}">
    <button type="submit" {{ $attributes }}>
        {{ $slot }}
    </button>
</x-form>