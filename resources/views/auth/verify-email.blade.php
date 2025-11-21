<x-guest-layout>
    <div class="mb-4 text-sm text-text-light">
        {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-medium text-sm text-success">
            {{ __('A new verification link has been sent to the email address you provided during registration.') }}
        </div>
    @endif

    <div class="flex items-center justify-between mt-4">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            @if (isset($email))
                <input type="hidden" name="email" value="{{ $email }}">
                <div class="mb-4">
                    <p class="text-sm text-text-light">A new verification link will be sent to <strong>{{ $email }}</strong>.</p>
                </div>
            @else
                <div class="mb-4">
                    <label for="email" class="block font-medium text-sm text-text-light mb-1">{{ __('Email') }}</label>
                    <input id="email" class="block w-full border-border rounded-md shadow-sm text-text focus:border-primary focus:ring-primary py-2 leading-tight" type="email" name="email" value="{{ old('email') }}" required autofocus />
                </div>
            @endif

            <div>
                <button type="submit" class="inline-flex items-center px-4 py-2 bg-primary border border-transparent rounded-md font-semibold text-xs text-button-text uppercase tracking-widest hover:bg-primary-dark focus:bg-primary-dark active:bg-primary-darker focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 transition ease-in-out duration-150">
                    {{ __('Resend Verification Email') }}
                </button>
            </div>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit" class="underline text-sm text-text-light hover:text-text rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary ml-4">
                {{ __('Log Out') }}
            </button>
        </form>
    </div>
</x-guest-layout>
