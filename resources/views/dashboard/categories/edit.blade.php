<x-layouts.app :title="__('Categories')">
    <div class="relative mb-6 w-full">
        <flux:heading size="xl">Update product</flux:heading>
        <flux:subheading size="lg" class="mb-6">Manage data product</flux:heading>
        <flux:separator variant="subtle" />
    </div>

    @if(session()->has('successMessage'))
        <flux:badge color="lime" class="mb-3 w-full">{{session()->get('successMessage')}}</flux:badge>
    @elseif(session()->has('errorMessage'))
        <flux:badge color="red" class="mb-3 w-full">{{session()->get('errorMessage')}}</flux:badge>
    @endif

<form action="{{ route('categories.update', $category->id) }}" method="post" enctype="multipart/form-data">
@method('patch')
@csrf
<flux:input label="Name" name="name" class="mb-3" :value="$category->name" />
<flux:input label="Slug" name="slug" class="mb-3" :value="$category->slug" />
<flux:input label="Description" name="description" class="mb-3" :value="$category->description" />
<flux:input label="SKU" name="sku" class="mb-3" :value="$category->sku" />
<flux:input label="Price" name="price" class="mb-3" :value="$category->price" />
<flux:input label="Stock" name="stock" class="mb-3" :value="$category->stock" /> 
<flux:input label="Product Category ID" name="product_category_id" class="mb-3" :value="$category->product_category_id" />
<flux:input label="Image URL" name="image_url" class="mb-3" :value="$category->image_url" />
<flux:input label="Is Active" name="is_active" class="mb-3" :value="$category->is_active" />
<flux:separator /> 
<div class="mt-4">
    <flux:button type="submit" variant="primary">Update</flux:button>
    <flux:link href="{{ route('categories.index') }}" variant="ghost" class="ml-3">Kembali</flux:link>
</div>
</form>
</x-layouts.app>