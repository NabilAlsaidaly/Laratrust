<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div>
                <x-label for="name" value="{{ __('Name') }}" />
                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            </div>

            <div class="mt-4">
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('Password') }}" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-label for="phone" value="{{ __('Phone') }}" />
                <x-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')" required />
            </div>

            <div class="mt-4">
                <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-label for="account_type" value="{{ __('Account Type') }}" />
                <select id="account_type" name="account_type" class="block mt-1 w-full" required>
                    <option value="customer">{{ __('Client') }}</option>
                    <option value="company">{{ __('Company') }}</option>
                </select>
            </div>

            <div id="company_fields" style="display: none;">
                <div class="mt-4">
                    <x-label for="company_name" value="{{ __('Company Name') }}" />
                    <x-input id="company_name" class="block mt-1 w-full" type="text" name="company_name" :value="old('company_name')" />
                </div>

                <div class="mt-4">
                    <x-label for="website" value="{{ __('Company Website') }}" />
                    <x-input id="website" class="block mt-1 w-full" type="text" name="website" :value="old('website')" />
                </div>

                <div class="mt-4">
                    <x-label for="company_phone" value="{{ __('Company Phone') }}" />
                    <x-input id="company_phone" class="block mt-1 w-full" type="text" name="company_phone" :value="old('company_phone')" />
                </div>

                <div class="mt-4">
                    <x-label for="location" value="{{ __('Company Location') }}" />
                    <x-input id="location" class="block mt-1 w-full" type="text" name="location" :value="old('location')" />
                </div>

                <div class="mt-4">
                    <x-label for="comm_id" value="{{ __('Company Comm_Id') }}" />
                    <x-input id="comm_id" class="block mt-1 w-full" type="number" name="comm_id" :value="old('comm_id')" />
                </div>

                <div class="mt-4">
                    <x-label for="combank_id" value="{{ __('Company Combank_Id') }}" />
                    <x-input id="combank_id" class="block mt-1 w-full" type="number" name="combank_id" :value="old('combank_id')" />
                </div>
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-label for="terms">
                        <div class="flex items-center">
                            <x-checkbox name="terms" id="terms" required />
                            <div class="ms-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Terms of Service').'</a>',
                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Privacy Policy').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-label>
                </div>
            @endif

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ms-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>

<script>
    document.getElementById('account_type').addEventListener('change', function () {
        var companyFields = document.getElementById('company_fields');
        if (this.value === 'company') {
            companyFields.style.display = 'block';
        } else {
            companyFields.style.display = 'none';
        }
    });
</script>
