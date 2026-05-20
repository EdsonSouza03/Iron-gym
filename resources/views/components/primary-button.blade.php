<button {{ $attributes->merge(['type' => 'submit', 'class' => 'primary-button inline-flex items-center px-4 py-2 border rounded-md font-semibold text-sm uppercase tracking-widest transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
