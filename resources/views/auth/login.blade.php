<x-guest-layout>
    <div>
        <p class="text-[13px] font-bold uppercase tracking-[0.18em] text-neutral-dark">Secure Access</p>
        <h1 class="mt-3 font-heading text-[46px] font-bold uppercase leading-none tracking-[0] text-dark">
            Sign In
        </h1>
        <p class="mt-3 text-[16px] leading-relaxed text-neutral-dark">
            Manage inquiries, analytics, and website controls for Troopers Sports.
        </p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mt-6 border border-black bg-light p-3 text-[14px] font-semibold text-dark" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="mt-8 space-y-5">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-[13px] font-bold uppercase tracking-[0.08em] text-dark">
                {{ __('Email') }}
            </label>
            <input
                id="email"
                class="mt-2 block w-full border border-black bg-white px-4 py-3 text-[16px] text-dark shadow-none transition focus:border-black focus:outline-none focus:ring-2 focus:ring-black"
                type="email"
                name="email"
                value="{{ old('email') }}"
                required
                autofocus
                autocomplete="username"
            >
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-[13px] font-bold uppercase tracking-[0.08em] text-dark">
                {{ __('Password') }}
            </label>
            <input
                id="password"
                class="mt-2 block w-full border border-black bg-white px-4 py-3 text-[16px] text-dark shadow-none transition focus:border-black focus:outline-none focus:ring-2 focus:ring-black"
                type="password"
                name="password"
                required
                autocomplete="current-password"
            >

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div>
            <!-- Remember Me -->
            <label for="remember_me" class="inline-flex items-center gap-3">
                <input id="remember_me" type="checkbox" class="border-black text-black shadow-none focus:ring-2 focus:ring-black focus:ring-offset-2" name="remember">
                <span class="text-[14px] font-semibold text-neutral-dark">{{ __('Remember me') }}</span>
            </label>
        </div>

        <button
            type="submit"
            class="flex w-full items-center justify-center border border-black bg-black px-5 py-4 text-[15px] font-bold uppercase tracking-[0.12em] text-white transition-colors hover:bg-neutral-dark focus:outline-none focus:ring-2 focus:ring-black focus:ring-offset-4"
        >
            {{ __('Log in') }}
        </button>
    </form>
</x-guest-layout>
