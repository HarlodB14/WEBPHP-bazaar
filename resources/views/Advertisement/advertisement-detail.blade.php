<x-app-layout>
    <div class="max-w-4xl mx-auto px-4 py-8">
        <a href="{{ route('advertisements.index') }}"
           class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-2">{{__('Go back')}}</a>
        <div class="bg-gray-800 shadow-md rounded-lg overflow-hidden flex">
            <div class="p-4 w-1/2 text-white">
                <h2 class="text-xl font-bold mb-2">{{ __($advertisement->title) }}</h2>
                <div class="flex items-center">
                    <span class="text-gray-400">{{__('Category:')}}</span>
                    <span class="ml-2 text-gray-300">{{ __($advertisement->category->type) }}</span>
                </div>
                <div class="flex items-center mt-2">
                    <span class="text-gray-400">{{__('Price:')}}</span>
                    <span class="ml-2 text-gray-300">€{{ __($advertisement->price) }}</span>
                </div>
                <div class="mt-4 flex-grow">
                    <img src="{{ __($advertisement->image_URL) }}" alt="{{ __($advertisement->title) }}" class="w-full">
                </div>
                <div class="mt-10">
                    {!! $qrcode !!}
                </div>
                @role(['Private advertiser','Commercial advertiser'])
                <div class="mt-4">
                    <a href="{{ route('advertisements.edit', ['advertisement' => $advertisement->id]) }}"
                       class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">{{__('Edit')}}</a>
                    <form action="{{ route('advertisements.delete', ['advertisement' => $advertisement->id]) }}"
                          method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">{{__('Delete')}}</button>
                    </form>
                </div>
                @endrole
                @role('Viewer')
                <a href="{{ route('advertisements.add', ['advertisement' => $advertisement->id]) }}"
                   class="inline-block bg-green-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-2">{{ __('Add to basket') }}</a>
                @endrole
            </div>
            <div class="w-1/2 flex-grow">
                <p class="text-gray-300 p-5">{{__($advertisement->body) }}</p>
            </div>
        </div>
    </div>
</x-app-layout>
