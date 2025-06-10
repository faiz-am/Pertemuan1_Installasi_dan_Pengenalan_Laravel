<x-layouts.app :title="__('Menu')">
    <div class="relative mb-6 w-full">
        <flux:heading size="xl">Menu</flux:heading>
        <flux:subheading size="lg" class="mb-6">Manage data Menu</flux:heading>
        <flux:separator variant="subtle" />
    </div>

    <div class="flex justify-between items-center mb-4">
        <div>
            <form action="{{ route('menu.index') }}" method="get">
                @csrf
                <flux:input icon="magnifying-glass" name="q" value="{{ $q }}" placeholder="Search Product menu" />
            </form>
        </div>
        <div>
            <flux:button icon="plus">
                <flux:link href="{{ route('menu.create') }}" variant="subtle">Add New Menu</flux:link>
            </flux:button>
        </div>
    </div>

    @if(session()->has('successMessage'))
        <div class="mb-3 w-full rounded bg-lime-100 border border-lime-400 text-lime-800 px-4 py-3">
            {{ session()->get('successMessage') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="min-w-full leading-normal">
            <thead>
                <tr>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        ID
                    </th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Menu_text
                    </th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Menu_icon
                    </th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Menu_url
                    </th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Menu_order
                    </th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Status
                    </th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($menu as $key => $item)
    <tr>
        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
            <p class="text-gray-900 whitespace-no-wrap">
                {{ $key + 1 }}
            </p>
        </td>
        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
            <p class="text-gray-900 whitespace-no-wrap">
                {{ $item->menu_text }}
            </p>
        </td>
        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
            <p class="text-gray-900 whitespace-no-wrap">
                {{ $item->menu_icon }}
            </p>
        </td>
        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
            <p class="text-gray-900 whitespace-no-wrap">
                {{ $item->menu_url }}
            </p>
        </td>
        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
            <p class="text-gray-900 whitespace-no-wrap">
                {{ $item->menu_order }}
            </p>
        </td>
        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
            <p class="text-gray-900">
                {{ $item->status }}
            </p>
        </td>
        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
            <flux:dropdown>
                <flux:button icon:trailing="chevron-down">Actions</flux:button>
                <flux:menu>
                    <flux:menu.item icon="pencil" href="{{ route('menu.edit', $item->id) }}">Edit</flux:menu.item>
                    <flux:menu.item icon="trash" variant="danger"
                        onclick="event.preventDefault(); if(confirm('Are you sure you want to delete this menu?')) document.getElementById('delete-form-{{ $item->id }}').submit();">Delete
                    </flux:menu.item>
                    <form id="delete-form-{{ $item->id }}" action="{{ route('menu.destroy', $item->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                    </form>
                </flux:menu>
            </flux:dropdown>
        </td>
    </tr>
@endforeach

            </tbody>
        </table>

        <div class="mt-3">
            {{ $menu->links() }}
        </div>
    </div>
    
</x-layouts.app>