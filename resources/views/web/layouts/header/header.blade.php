<header>
    <div class="nav-bg"></div>

    @if (site()?->locale == 'hu')
        <!-- nav -->
        <x-neon-menu id="fomenu">
        </x-neon-menu>
    @else
        <!-- nav -->
        <x-neon-menu id="main">
        </x-neon-menu>
    @endif
</header>
