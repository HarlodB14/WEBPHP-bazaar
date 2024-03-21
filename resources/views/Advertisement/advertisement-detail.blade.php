<x-app-layout>
    <div class="max-w-4xl mx-auto px-4 py-8">
        <a href="{{ route('advertisements.index', ['advertisement' => $advertisement->id]) }}"
           class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-2">Go back</a>
        <div class="bg-gray-800 shadow-md rounded-lg overflow-hidden flex">
            <div class="p-4 w-1/2 text-white">
                <h2 class="text-xl font-bold mb-2">{{ $advertisement->title }}</h2>
                <div class="flex items-center">
                    <span class="text-gray-400">Category:</span>
                    <span class="ml-2 text-gray-300">{{ $advertisement->category->type }}</span>
                </div>
                <div class="flex items-center mt-2">
                    <span class="text-gray-400">Price:</span>
                    <span class="ml-2 text-gray-300">€{{ $advertisement->price }}</span>
                </div>
                <div class="mt-4 flex-grow">
                    <img src="{{ $advertisement->image_URL }}" alt="{{ $advertisement->title }}" class="w-full">
                </div>
                <div class="mt-10">
                    {!! $qrcode !!}
                </div>
                @if(!$user->hasRole('Viewer'))
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
                @endif
            </div>
            <div class="w-1/2 flex-grow">
                <p class="text-gray-300 p-5">{{ $advertisement->body }}</p>
            </div>
        </div>
    </div>
</x-app-layout>
