<x-app-layout>
    <x-breadcrumb title="Profile" />

    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="col-md-12">
                <div class="card">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            {{-- <div class="col-md-12">
            <div class="card">
                @include('profile.partials.delete-user-form')
            </div>
        </div> --}}
        </div>
    </div>

</x-app-layout>
