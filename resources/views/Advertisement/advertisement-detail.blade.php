<x-app-layout>
    <div class="max-w-4xl mx-auto px-4 py-8">
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="p-4">
                <h2 class="text-xl font-bold mb-2">{{ $advertisement->title }}</h2>
                <p class="text-gray-600 mb-4">{{ $advertisement->body }}</p>
                <div class="flex items-center">
                    <span class="text-gray-600">Category:</span>
                    <span class="ml-2 text-gray-800">{{ $advertisement->category->type }}</span>
                </div>
                <div class="flex items-center mt-2">
                    <span class="text-gray-600">Price:</span>
                    <span class="ml-2 text-gray-800">€{{ $advertisement->price }}</span>
                </div>
                <div class="mt-4">
                    <img src="{{ $advertisement->image_URL }}" alt="{{ $advertisement->title }}" class="w-full">
                </div>
                <div class="mt-4">
                    <a href="{{ route('advertisements.edit', ['advertisement' => $advertisement->id]) }}"
                       class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Edit</a>
                    <form action="{{ route('advertisements.delete', ['advertisement' => $advertisement->id]) }}"
                          method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
