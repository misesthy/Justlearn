<button  type="submit" {{ $attributes->merge(['class' => 'btn btn-block btn-primary btn-login']) }}>
    {{ $slot }}
    {{-- {{ $label }} --}}
</button>
