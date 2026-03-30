<flux:sidebar stashable sticky class="lg:hidden border-r border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900">
    <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />

    <a href="{{ route('home') }}" class="ml-1 flex items-center space-x-2" wire:navigate>
        <x-app-logo class="size-8" href="#"></x-app-logo>
    </a>

    <flux:navlist variant="outline">
        <flux:navlist.group heading="Platform">
            <flux:navlist.item icon="home" href="{{ route('home') }}" :current="request()->routeIs('home')" wire:navigate>
                Home
            </flux:navlist.item>
        </flux:navlist.group>
    </flux:navlist>

</flux:sidebar>