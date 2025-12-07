<x-guest-layout>
    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <div>
            <label for="email" class="block font-medium text-sm text-text-light mb-1">{{ __('Email') }}</label>
            <input id="email" class="block w-full border-border rounded-md shadow-sm text-text focus:border-primary focus:ring-primary py-2 leading-tight" type="email" name="email" value="{{ old('email', $request->email) }}" required autofocus autocomplete="username" />
            @error('email')
                <p class="text-danger text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Password -->
        <div class="mt-4" x-data="{ show: false }">
            <label for="password" class="block font-medium text-sm text-text-light mb-1">{{ __('Password') }}</label>
            <div class="relative">
                <input id="password" class="block w-full border-border rounded-md shadow-sm text-text focus:border-primary focus:ring-primary pr-10 py-2 leading-tight"
                                :type="show ? 'text' : 'password'"
                                name="password"
                                required autocomplete="new-password" />
                <button type="button" class="absolute inset-y-0 right-0 pr-3 flex items-center text-sm leading-5"
                        @click="show = !show">
                    <i class="fa" :class="{ 'fa-eye': show, 'fa-eye-slash': !show }"></i>
                </button>
            </div>
            @error('password')
                <p class="text-danger text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Confirm Password -->
        <div class="mt-4" x-data="{ show: false }">
            <label for="password_confirmation" class="block font-medium text-sm text-text-light mb-1">{{ __('Confirm Password') }}</label>
            <div class="relative">
                <input id="password_confirmation" class="block w-full border-border rounded-md shadow-sm text-text focus:border-primary focus:ring-primary pr-10 py-2 leading-tight"
                                type="password"
                                name="password_confirmation" required autocomplete="new-password" />
                <button type="button" class="absolute inset-y-0 right-0 pr-3 flex items-center text-sm leading-5"
                        @click="show = !show">
                    <i class="fa" :class="{ 'fa-eye': show, 'fa-eye-slash': !show }"></i>
                </button>
            </div>
            @error('password_confirmation')
                <p class="text-danger text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center justify-end mt-4">
            <button type="submit" class="w-full sm:w-auto justify-center inline-flex items-center px-4 py-2 bg-primary border border-transparent rounded-md font-semibold text-xs text-button-text uppercase tracking-widest hover:bg-primary-dark focus:bg-primary-dark active:bg-primary-darker focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 transition ease-in-out duration-150">
                {{ __('Reset Password') }}
            </button>
        </div>
    </form>
</x-guest-layout>
