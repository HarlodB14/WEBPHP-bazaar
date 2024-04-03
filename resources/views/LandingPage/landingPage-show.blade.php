<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Landing Page') }}
        </h2>
    </x-slot>

    <div class="py-12">
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
                            <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 mb-8">
                                <div class="p-6">
                                    <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200">{{ $component->title }}</h2>
                                    <p class="text-gray-600 dark:text-gray-400">{{ $component->body }}</p>
                                    <!-- You can add more fields here if needed -->
                                </div>
                            </div>
                        @endif
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
