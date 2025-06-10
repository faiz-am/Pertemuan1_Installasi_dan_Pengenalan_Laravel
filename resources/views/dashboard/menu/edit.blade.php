<x-layouts.app :title="__('Themes')">
    <div class="relative mb-6 w-full">
        <flux:heading size="xl">Edit Menu</flux:heading>
        <flux:subheading size="lg" class="mb-6">Update data Menu</flux:subheading>
        <flux:separator variant="subtle" />
    </div>

    @if(session()->has('successMessage'))
        <flux:badge color="lime" class="mb-3 w-full">{{ session()->get('successMessage') }}</flux:badge>
    @elseif(session()->has('errorMessage'))
        <flux:badge color="red" class="mb-3 w-full">{{ session()->get('errorMessage') }}</flux:badge>
    @endif

    <form action="{{ route('menu.update', $menu->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <flux:input label="Menu_text" name="menu_text" class="mb-3" :value="old('menu_text', $menu->menu_text)" />

        <flux:textarea label="Menu_icon" name="menu_icon" class="mb-3">{{ old('menu_icon', $menu->menu_icon) }}</flux:textarea>

        <flux:input label="Menu_url" name="menu_url" class="mb-3" :value="old('menu_url', $menu->menu_url)" />

        <flux:input label="Menu_order" name="menu_order" class="mb-3" :value="old('menu_order', $menu->menu_order)" />

        <flux:select label="Status" name="status" class="mb-6">
            <flux:select.option value="active">Active</flux:select.option>
            <flux:select.option value="inactive">Inactive</flux:select.option>
        </flux:select>

        <flux:separator />

        <div class="mt-4">
            <flux:button type="submit" variant="primary">Update</flux:button>
            <flux:link href="{{ route('menu.index') }}" variant="ghost" class="ml-3">Kembali</flux:link>
        </div>
    </form>
</x-layouts.app>