@csrf

@if($errors->any())
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
        <ul class="list-disc list-inside text-sm">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="card p-6 space-y-4">
    <div>
        <label class="block text-sm font-medium mb-1">Product Name *</label>
        <input type="text" name="name" value="{{ old('name', $product->name ?? '') }}" required
               class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-tajer-green">
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label class="block text-sm font-medium mb-1">Category *</label>
            <select name="category_id" required class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-tajer-green">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ (old('category_id', $product->category_id ?? '') == $category->id) ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Price (USD) *</label>
            <input type="number" name="price" step="0.01" min="0" value="{{ old('price', $product->price ?? '') }}" required
                   class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-tajer-green">
        </div>
    </div>

    <div>
        <label class="block text-sm font-medium mb-1">Stock Quantity *</label>
        <input type="number" name="stock" min="0" value="{{ old('stock', $product->stock ?? 0) }}" required
               class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-tajer-green">
    </div>

    <div>
        <label class="block text-sm font-medium mb-1">Description *</label>
        <textarea name="description" rows="5" required
                  class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-tajer-green">{{ old('description', $product->description ?? '') }}</textarea>
    </div>

    <div class="flex space-x-6">
        <label class="flex items-center">
            <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $product->is_featured ?? false) ? 'checked' : '' }} class="rounded">
            <span class="ml-2 text-sm">Featured product</span>
        </label>
        <label class="flex items-center">
            <input type="checkbox" name="is_active" value="1" {{ old('is_active', $product->is_active ?? true) ? 'checked' : '' }} class="rounded">
            <span class="ml-2 text-sm">Active (visible in store)</span>
        </label>
    </div>
</div>

<div class="mt-6 flex gap-3">
    <button type="submit" class="btn-primary">Save Product</button>
    <a href="{{ route('admin.products.index') }}" class="btn-secondary">Cancel</a>
</div>