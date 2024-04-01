<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Add Component') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6 w-1/2">
                <!-- Validation Errors -->
                @if ($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="max-w-md bg-gray-800"> <!-- Added max-w-md class -->
                    <form method="POST" action="{{ route('components.store') }}">
                        @csrf

                        <!-- Type -->
                        <div class="mt-4">
                            <x-input-label for="type" :value="__('Type')"/>
                            <select id="type" name="type"
                                    class="block w-full px-4 py-2 text-start text-sm leading-5 text-gray-700 dark:text-gray-300 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                                    style="background-color: #333; color: #fff;">
                                @foreach ($types as $type)
                                    <option value="{{ $type->type }}">{{ ucfirst($type->type) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <!-- Content -->
                        <div class="mt-4">
                            <x-input-label for="content" :value="__('Content')"/>
                            <textarea id="content" name="content" rows="4"
                                      class="form-textarea mt-1 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                                      style="resize: vertical;">{{ old('content') }}</textarea>
                        </div>
                        <!-- Image Upload -->
                        <div id="image-upload" class="mt-4 hidden">
                            <x-input-label for="image" :value="__('Image')"/>
                            <input type="file" id="image" name="image" class="block w-full px-4 py-2 text-sm leading-5 text-gray-700 dark:text-gray-300 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"/>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button>{{ __('Add Component') }}</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('type').addEventListener('change', function() {
            const type = this.value;
            const imageUpload = document.getElementById('image-upload');

            if (type === 'image') {
                imageUpload.classList.remove('hidden');
            } else {
                imageUpload.classList.add('hidden');
            }
        });
    </script>
</x-app-layout>
