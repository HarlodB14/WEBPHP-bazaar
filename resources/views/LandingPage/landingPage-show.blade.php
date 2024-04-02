<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Landing Page') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
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

                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
