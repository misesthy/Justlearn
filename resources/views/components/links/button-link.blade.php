<a  {{ $attributes->merge(['class' => 'btn btn-fill btn-dark']) }} data-color="purple" href="#" >
    {{ $slot }}
    {{ $label ?? '' }}
</a>