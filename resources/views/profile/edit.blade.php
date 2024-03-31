<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>
            @role('Commercial advertiser')
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                        {{ __('Export Registration to PDF') }}
                    </h2>
                    <a href="{{ route('export') }}"
                       class="inline-block text-gray-600 dark:text-gray-400 hover:text-white hover:border-b-2 hover:border-white hover:border-solid transition duration-300">
                        <p class="mt-1 text-sm">
                            {{ __('Export here your business registration to PDF') }}
                        </p>
                    </a>
                </div>
            </div>
            @endrole
            @role('Commercial advertiser')
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                        {{ __('Change landing-page of website') }}
                    </h2>
                    <a href="{{ route('dashboard') }}"
                       class="inline-block text-gray-600 dark:text-gray-400 hover:text-white hover:border-b-2 hover:border-white hover:border-solid transition duration-300">
                        <p class="mt-1 text-sm">
                            {{ __('Change the URL of your homepage') }}
                        </p>
                    </a>
                </div>
            </div>
            @endrole
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
