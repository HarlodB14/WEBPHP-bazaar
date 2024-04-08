<div class="bg-white dark:bg-gray-900 shadow-md rounded-lg overflow-hidden">
    <img src="{{ $advertisement->image_URL }}" alt="{{ $advertisement->title }}"
         class="w-full h-48 object-cover object-center">
    <div class="p-4">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-100">{{ $advertisement->title }}</h2>
        <p class="mt-2 text-gray-600 dark:text-gray-400">{{ $advertisement->body }}</p>
        <div class="mt-3 flex items-center justify-between">
            <span class="text-gray-600 dark:text-gray-400">{{ $advertisement->price }}</span>
            <a href="{{ route('advertisements.show', $advertisement->id) }}"
               class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-600">{{ __('View') }}</a>
        </div>
    </div>
</div>
