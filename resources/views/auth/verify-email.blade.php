<<<<<<< HEAD
<x-authentication-layout>
    <h1 class="text-3xl text-gray-800 dark:text-gray-100 font-bold mb-6">{{ __('Verify your Email') }}</h1>
    <div>
=======
<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
>>>>>>> main
        {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ __('A new verification link has been sent to the email address you provided during registration.') }}
        </div>
    @endif

<<<<<<< HEAD
    <div class="mt-6 flex items-center justify-between">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <div>
                <x-button type="submit">
                    {{ __('Resend Verification Email') }}
                </x-button>
=======
    <div class="mt-4 flex items-center justify-between">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <div>
                <x-primary-button>
                    {{ __('Resend Verification Email') }}
                </x-primary-button>
>>>>>>> main
            </div>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
<<<<<<< HEAD
            <div class="ml-1">
                <button type="submit" class="text-sm underline hover:no-underline">
                    {{ __('Log Out') }}
                </button>
            </div>
        </form>   
    </div>
</x-authentication-layout>
=======

            <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                {{ __('Log Out') }}
            </button>
        </form>
    </div>
</x-guest-layout>
>>>>>>> main
