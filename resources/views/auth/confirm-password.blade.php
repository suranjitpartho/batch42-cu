<x-guest-layout>
    <div class="mb-4 text-sm text-text-light">
        {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
    </div>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <!-- Password -->
        <div x-data="{ show: false }">
            <label for="password" class="block font-medium text-sm text-text-light mb-1">{{ __('Password') }}</label>
            <div class="relative">
                <input id="password" class="block w-full border-border rounded-md shadow-sm text-text focus:border-primary focus:ring-primary pr-10 py-2 leading-tight"
                                :type="show ? 'text' : 'password'"
                                name="password"
                                required autocomplete="current-password" />
                <button type="button" class="absolute inset-y-0 right-0 pr-3 flex items-center text-sm leading-5"
                        @click="show = !show">
                    <i class="fa" :class="{ 'fa-eye': show, 'fa-eye-slash': !show }"></i>
                </button>
            </div>
            @error('password')
                <p class="text-danger text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center justify-end mt-4">
            <button type="submit" class="inline-flex items-center px-4 py-2 bg-primary border border-transparent rounded-md font-semibold text-xs text-button-text uppercase tracking-widest hover:bg-primary-dark focus:bg-primary-dark active:bg-primary-darker focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 transition ease-in-out duration-150">
                {{ __('Confirm') }}
            </button>
        </div>
    </form>
</x-guest-layout>
