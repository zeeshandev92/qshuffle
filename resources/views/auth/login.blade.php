<x-guest-layout>

    <!-- Content area -->
    <div class="content d-flex justify-content-center align-items-center">

        <!-- Login card -->
        <form class="login-form needs-validation" method="POST" action="{{ route('login') }}" novalidate>
            @csrf
            <div class="card mb-0">
                <div class="card-body">
                    <div class="text-center mb-3">
                        <div class="d-inline-flex align-items-center justify-content-center mb-4 mt-2">
                            <img src="{{ asset('assets/images/qshuffle-transparent.png') }}" class="h-48px" alt="">
                        </div>
                        <h5 class="mb-0">Login to your account</h5>
                        <span class="d-block text-muted">Enter your credentials below</span>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Username</label>
                        <div class="form-control-feedback form-control-feedback-start">
                            <input type="email" name="email" class="form-control" placeholder="john@doe.com"
                                value="{{ old('email') }}" required autofocus autocomplete="username">
                            <div class="form-control-feedback-icon">
                                <i class="ph-user-circle text-muted"></i>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <div class="form-control-feedback form-control-feedback-start">
                            <input type="password" name="password" class="form-control" placeholder="•••••••••••"
                                required autocomplete="current-password">
                            <div class="form-control-feedback-icon">
                                <i class="ph-lock text-muted"></i>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex align-items-center mb-3">
                        <label class="form-check" for="remember_me">
                            <input type="checkbox" id="remember_me" name="remember" class="form-check-input">
                            <span class="form-check-label">Remember</span>
                        </label>

                        {{-- @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="ms-auto">Forgot password?</a>
                        @endif --}}
                    </div>

                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary w-100">Sign in</button>
                    </div>

                    {{-- <div class="text-center text-muted content-divider mb-3">
                        <span class="px-2">Don't have an account?</span>
                    </div>

                    <div class="mb-3">
                        <a href="{{ route('register') }}" class="btn btn-light w-100">Sign up</a>
                    </div> --}}

                </div>
            </div>
        </form>
        <!-- /login card -->

    </div>
    <!-- /content area -->

    @push('scripts')
        <script src="{{ asset('assets/demo/pages/form_validation_styles.js') }}"></script>
    @endpush
</x-guest-layout>
