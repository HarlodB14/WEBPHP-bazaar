<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Featured Advertisements') }}
        </h2>
    </x-slot>

    @if($advertisements->isEmpty())
        <div
            class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative max-w-xl mx-auto mb-4 mt-4"
            role="alert">
            <span class="block sm:inline">No advertisements posted yet.</span>
            <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                <svg class="fill-current h-6 w-6 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                          d="M9.293 10l-1.147 1.146a1 1 0 0 1-1.414-1.414l2-2a1 1 0 0 1 1.414 0l4 4a1 1 0 0 1 0 1.414l-1.5 1.5a1 1 0 0 1-1.414 0L9.293 11.414 7.793 12.914a1 1 0 0 1-1.414-1.414l2-2a1 1 0 0 1 1.414 0l1.5 1.5a1 1 0 0 1 0 1.414l-4 4a1 1 0 0 1-1.414 0l-6-6a1 1 0 1 1 1.414-1.414l5.5 5.5a1 1 0 0 1 0 1.414l-2 2a1 1 0 1 1-1.414-1.414l1.146-1.147z"
                          clip-rule="evenodd"/>
                </svg>
            </span>
        </div>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 mt-5 ml-4">
            @foreach($advertisements as $key => $advertisement)
                <div class="max-w-sm rounded overflow-hidden shadow-lg bg-white dark:bg-gray-800">
                    <img class="w-full h-fit max-h-64" src="{{ $image_urls[$key] }}" alt="{{ $advertisement->title }}">
                    <div class="px-6 py-4">
                        <div
                            class="font-bold text-xl mb-2 text-gray-800 dark:text-gray-200">{{ $advertisement->title }}</div>
                        <p class="text-gray-700 text-base dark:text-gray-300">{{ $advertisement->body }}</p>
                    </div>
                    <div class="px-6 pt-4 pb-2">
                        <span
                            class="inline-block bg-blue-400 rounded-full px-3 py-1 text-sm font-semibold text-gray-800 dark:text-gray-300 mr-2 mb-2">{{ $advertisement->price }}</span>
                        <a href="{{ route('advertisements.show', $advertisement->id) }}"
                           class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-600">{{ __('View') }}</a>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
    <div class="max-w-71 mx-auto sm:px-6 lg:px-8 mt-2">
        {{($advertisements->links())}}
    </div>

</x-app-layout>
