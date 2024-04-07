<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Landing Page') }}
        </h2>
    </x-slot>

    <div class="py-12">
        @if(session()->has('message'))
            <div
                class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative max-w-xl mx-auto mb-4"
                role="alert">
                <span class="block sm:inline">{{ session()->get('message') }}</span>
                <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                <svg class="fill-current h-6 w-6 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                          d="M9.293 10l-1.147 1.146a1 1 0 0 1-1.414-1.414l2-2a1 1 0 0 1 1.414 0l4 4a1 1 0 0 1 0 1.414l-1.5 1.5a1 1 0 0 1-1.414 0L9.293 11.414 7.793 12.914a1 1 0 0 1-1.414-1.414l2-2a1 1 0 0 1 1.414 0l1.5 1.5a1 1 0 0 1 0 1.414l-4 4a1 1 0 0 1-1.414 0l-6-6a1 1 0 1 1 1.414-1.414l5.5 5.5a1 1 0 0 1 0 1.414l-2 2a1 1 0 1 1-1.414-1.414l1.146-1.147z"
                          clip-rule="evenodd"/>
                </svg>
            </span>
            </div>
        @endif
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <button onclick="window.location='{{ route('landing-page.create') }}'"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 mb-2 rounded focus:outline-none focus:shadow-outline">
                Add Component
            </button>
            <div class="g-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="container mx-auto px-4 flex justify-center">
                    @foreach($components as $component)
                        <div class="mb-8">
                            <p class="text-lg font-semibold text-white mb-4">{{ $component->content }}</p>
                        </div>
                    @endforeach
                </div>
                <div class="max-w-7xl mx-auto px-4 flex justify-center">
                    @foreach($components as $component)
                        @if($component->type === 'image')
                            <div
                                class="max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 mb-8">
                                <img class="rounded-t-lg" src="{{ $component->content }}" alt=""/>
                            </div>
                        @endif
                    @endforeach
                </div>
                <div class="max-w-7xl mx-auto px-4 flex justify-center">
                    @foreach($components as $component)
                        @if($component->type === 'featured advertisement')
                            <div
                                class="max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 mb-8">
                                <div class="p-6">
                                    <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200">{{ $component->title }}</h2>
                                    <p class="text-gray-600 dark:text-gray-400">{{ $component->body }}</p>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
