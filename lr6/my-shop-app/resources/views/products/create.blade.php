<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Додати нову послугу</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                <!-- Важливо: enctype="multipart/form-data" для завантаження фото -->
                <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-gray-700">Назва послуги</label>
                        <input type="text" name="name" class="w-full border-gray-300 rounded" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700">Категорія</label>
                        <select name="category" class="w-full border-gray-300 rounded">
                            <option value="Прання">Прання</option>
                            <option value="Хімчистка">Хімчистка</option>
                            <option value="Прасування">Прасування</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700">Ціна (грн)</label>
                        <input type="number" name="price" step="0.01" class="w-full border-gray-300 rounded" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700">Фото (мін. 100x100)</label>
                        <input type="file" name="image" class="w-full">
                    </div>

                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Зберегти</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>