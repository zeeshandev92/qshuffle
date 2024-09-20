<section>
    <div class="card-header">
        <h5 class="mb-0">
            {{ __('Profile Information') }}
        </h5>

        <p class="m-0">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </div>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>


    <div class="card-body">

        <form method="post" action="{{ route('profile.update') }}" class="row g-3">
            @csrf
            @method('patch')

            <div class="col-md-6">
                <label for="name">{{ __('Name') }}</label>
                <input id="name" name="name" type="text" class="form-control"
                    value="{{ old('name', $user->name) }}" required autofocus autocomplete="name" />
            </div>

            <div class="col-md-6">
                <label for="email">{{ __('Email') }}</label>
                <input id="email" name="email" type="email" class="form-control"
                    value="{{ old('email', $user->email) }}" required autocomplete="username" />

                {{-- @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                    <div>
                        <p class="text-sm mt-2 text-gray-800">
                            {{ __('Your email address is unverified.') }}

                            <button form="send-verification" class="btn btn-primary">
                                {{ __('Click here to re-send the verification email.') }}
                            </button>
                        </p>

                        @if (session('status') === 'verification-link-sent')
                            <p class="mt-2 font-medium text-sm text-green-600">
                                {{ __('A new verification link has been sent to your email address.') }}
                            </p>
                        @endif
                    </div>
                @endif --}}
            </div>

            <div class="col-md-12 d-flex justify-content-end align-items-center mt-3">
                <button type="submit" class="btn btn-primary ms-3">
                    Submit <i class="ph-paper-plane-tilt ms-2"></i>
                </button>
            </div>
        </form>
    </div>

</section>
