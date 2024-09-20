<section>
    <div class="card-header">
        <h5 class="mb-0">
            {{ __('Update Password') }}
        </h5>

        <p class="m-0">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </div>

    <div class="card-body">
        <form method="post" action="{{ route('password.update') }}" class="row g-3">
            @csrf
            @method('put')

            <div class="col-md-12">
                <label for="current_password">{{ __('Current Password') }}</label>
                <input id="current_password" name="current_password" type="password" class="form-control" required
                    autocomplete="current-password" />
            </div>

            <div class="col-md-6">
                <label for="password">{{ __('New Password') }}</label>
                <input id="password" name="password" type="password" class="form-control" required
                    autocomplete="new-password" />
            </div>

            <div class="col-md-6">
                <label for="password_confirmation">{{ __('Confirm Password') }}</label>
                <input id="password_confirmation" name="password_confirmation" type="password" class="form-control"
                    required autocomplete="new-password" />
            </div>

            <div class="col-md-12 d-flex justify-content-end align-items-center mt-3">
                <button type="submit" class="btn btn-primary ms-3">
                    Submit <i class="ph-paper-plane-tilt ms-2"></i>
                </button>
            </div>

        </form>
    </div>
</section>
