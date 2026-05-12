<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Послуги пральні') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <div class="flex justify-between mb-4">
                    <h3 class="text-lg font-bold">Прайс-лист послуг</h3>
                    <!-- Кнопка для майбутнього створення -->
                    <a href="{{ route('products.create') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                        + Додати послугу
                    </a>
                </div>

                <table class="min-w-full table-auto border-collapse">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border px-4 py-2 text-left">Назва послуги</th>
                            <th class="border px-4 py-2 text-left">Категорія</th>
                            <th class="border px-4 py-2 text-left">Ціна (грн)</th>
                            <th class="border px-4 py-2 text-center">Дії</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $product)
                            <tr>
                                <td class="border px-4 py-2">{{ $product->name }}</td>
                                <td class="border px-4 py-2">{{ $product->category }}</td>
                                <td class="border px-4 py-2">{{ $product->price }}</td>
                                <td class="border px-4 py-2 text-center">
                                    <a href="{{ route('products.edit', $product->id) }}" class="text-blue-600 hover:underline">Редагувати</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="border px-4 py-2 text-center text-gray-500">
                                    Послуг поки немає. Додайте першу!
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="mt-4">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>