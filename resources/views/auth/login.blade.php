<x-guest-layout>
    <!-- Session Status -->
    @if (session('status'))
        <div class="mb-4 font-medium text-sm text-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="block font-medium text-sm text-text-light mb-1">{{ __('Email') }}</label>
            <input id="email" class="block w-full border-border rounded-md shadow-sm text-text focus:border-primary focus:ring-primary py-2 leading-tight" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" />
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

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-border text-primary shadow-sm focus:ring-primary" name="remember">
                <span class="ml-2 text-sm text-text-light">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-between mt-4">
            <div class="flex items-center gap-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-text-light hover:text-text rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
                <a class="underline text-sm text-text-light hover:text-text rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary" href="{{ route('register') }}">
                    {{ __('Not registered yet?') }}
                </a>
            </div>

            <button type="submit" class="inline-flex items-center px-4 py-2 bg-primary border border-transparent rounded-md font-semibold text-xs text-button-text uppercase tracking-widest hover:bg-primary-dark focus:bg-primary-dark active:bg-primary-darker focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 transition ease-in-out duration-150">
                {{ __('Log in') }}
            </button>
        </div>
    </form>
</x-guest-layout>
