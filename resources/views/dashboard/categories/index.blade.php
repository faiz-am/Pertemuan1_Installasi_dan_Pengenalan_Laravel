<x-layouts.app :title="__('Categories')"> 
    <div class="relative mb-6 w-full"> 
        <flux:heading size="xl">Product</flux:heading> 
        <flux:subheading size="lg" class="mb-6">
            Manage data Product
        </flux:subheading> 
        <flux:separator variant="subtle" /> 
    </div> 
 
    <div class="flex justify-between items-center mb-4"> 
        <div> 
            <form action="{{ route('categories.index') }}" method="get"> 
                <flux:input icon="magnifying-glass" name="q" value="{{ $q }}" placeholder="Search Product" />
            </form> 
        </div> 
        <div> 
            <flux:button icon="plus"> 
                <flux:link href="{{ route('categories.create') }}" variant="subtle">Add New Product</flux:link> 
            </flux:button> 
        </div> 
    </div> 
 
    @if(session()->has('successMessage')) 
        <flux:badge color="lime" class="mb-3 w-full">
            {{ session()->get('successMessage') }}
        </flux:badge> 
    @endif 
 
    <div class="overflow-x-auto"> 
        <table class="min-w-full leading-normal"> 
            <thead> 
                <tr>
                    <th class="table-header">ID</th>
                    <th class="table-header ">Name</th>
                    <th class="table-header">slug</th>
                    <th class="table-header">description</th>
                    <th class="table-header">sku</th>
                    <th class="table-header">price</th>
                    <th class="table-header">stock</th>
                    <th class="table-header">product_category_id</th>
                    <th class="table-header">image_url</th>
                    <th class="table-header">is_active</th>
                    <th class="table-header">Created At</th>
                    <th class="table-header">Updated At</th>
                    <th class="table-header">Actions</th>
                </tr> 
            </thead> 
            <tbody> 
                @foreach($categories as $key => $category) 
                    <tr>
                        <td class="px-5 py-5 text-sm text-center" >{{ $key + 1 }}</td>
                        <td class="px-5 py-5 text-sm text-center">{{ $category->name }}</td>
                        <td class="px-5 py-5 text-sm text-center">{{ $category->slug }}</td>
                        <td class="px-5 py-5 text-sm text-center">{{ $category->description }}</td>
                        <td class="px-5 py-5 text-sm text-center">{{ $category->sku }}</td>
                        <td class="px-5 py-5 text-sm text-center">{{ $category->price }}</td>
                        <td class="px-5 py-5 text-sm text-center">{{ $category->stock }}</td>
                        <td class="px-5 py-5 text-sm text-center">{{ $category->product_category_id }}</td>
                        <td class="px-5 py-5 text-sm text-center">{{ $category->image_url }}</td>
                        <td class="px-5 py-5 text-sm text-center">{{ $category->is_active }}</td>
                        <td class="px-5 py-5 text-sm text-center">{{ $category->created_at }}</td>
                        <td class="px-5 py-5 text-sm text-center">{{ $category->updated_at }}</td>
                        <td class="px-5 py-5 text-sm text-center">
                            <flux:dropdown>
                                <flux:button icon:trailing="chevron-down">Actions</flux:button>
                                <flux:menu>
                                    <flux:menu.item icon="pencil" href="{{ route('categories.edit', $category->id) }}">
                                        Edit
                                    </flux:menu.item>
                                    <flux:menu.item icon="trash" variant="danger" 
                                        onclick="event.preventDefault(); if(confirm('Are you sure you want to delete this category?')) document.getElementById('delete-form-{{ $category->id }}').submit();">
                                        Delete
                                    </flux:menu.item>
                                </flux:menu>
                            </flux:dropdown>

                            <form id="delete-form-{{ $category->id }}" action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td> 
                    </tr> 
                @endforeach 
            </tbody> 
        </table> 
 
        <div class="mt-3"> 
            {{ $categories->links() }} 
        </div> 
    </div> 
</x-layouts.app> 
