@extends('backend.layouts.app', ['activePage' => 'users', 'title' => 'Profile Page', 'navName' => 'userslist', 'activeButton' => 'laravel'])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="section-image">
                <!--   you can change the color of the filter page using: data-color="blue | purple | green | orange | red | rose " -->
                <h3 class="mb-3">{{ __('Edit Profile') }}</h3>
                <div class="card">
                    <div class="card-body">
                        <form method="post" action="{{ route('backend.users.update', $user->id) }}" autocomplete="off"
                            enctype="multipart/form-data">
                            @csrf
                            @method('patch')

                            <h5 class="text-muted mb-4">{{ __('User information') }}</h5>
                            
                            @include('backend.alerts.success')
                            @include('backend.alerts.error_self_update', ['key' => 'not_allow_profile'])
    
                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('first_name') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="firstName">
                                        <i class="w3-xxlarge fa fa-user"></i>{{ __('First Name') }}
                                    </label>
                                    <input type="text" name="first_name" id="firstName" class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" placeholder="{{ __('First Name') }}" value="{{ old('name', $user->first_name) }}" required autofocus>
    
                                    @include('backend.alerts.feedback', ['field' => 'first_name'])
                                </div>
                                <div class="form-group{{ $errors->has('last_name') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="lastName">
                                        <i class="w3-xxlarge fa fa-user"></i>{{ __('Last Name') }}
                                    </label>
                                    <input type="text" name="last_name" id="lastName" class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}" placeholder="{{ __('Last Name') }}" value="{{ old('last_name', $user->last_name) }}" required>
    
                                    @include('backend.alerts.feedback', ['field' => 'last_name'])
                                </div>
                                <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-email"><i class="w3-xxlarge fa fa-envelope-o"></i>{{ __('Email') }}</label>
                                    <input type="email" name="email" id="input-email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('Email') }}" value="{{ old('email', auth()->user()->email) }}" required>
    
                                    @include('backend.alerts.feedback', ['field' => 'email'])
                                </div>
                                <div class="">
                                    <button type="submit" class="btn btn-primary mt-4">{{ __('Update') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card mt-3">
                    <div class="card-body">
                        <form method="post" action="">
                            @csrf
                            @method('patch')
    
                            <h5 class="text-muted mb-4">{{ __('Password') }}</h5>
    
                            @include('backend.alerts.success', ['key' => 'password_status'])
                            @include('backend.alerts.error_self_update', ['key' => 'not_allow_password'])
    
                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('old_password') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-current-password">
                                        <i class="w3-xxlarge fa fa-eye-slash"></i>{{ __('Current Password') }}
                                    </label>
                                    <input type="password" name="old_password" id="input-current-password" class="form-control{{ $errors->has('old_password') ? ' is-invalid' : '' }}" placeholder="{{ __('Current Password') }}" value="" required>
    
                                    @include('backend.alerts.feedback', ['field' => 'old_password'])
                                </div>
                                <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-password">
                                        <i class="w3-xxlarge fa fa-eye-slash"></i>{{ __('New Password') }}
                                    </label>
                                    <input type="password" name="password" id="input-password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ __('New Password') }}" value="" required>
    
                                    @include('backend.alerts.feedback', ['field' => 'password'])
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label" for="input-password-confirmation">
                                        <i class="w3-xxlarge fa fa-eye-slash"></i>{{ __('Confirm New Password') }}
                                    </label>
                                    <input type="password" name="password_confirmation" id="input-password-confirmation" class="form-control" placeholder="{{ __('Confirm New Password') }}" value="" required>
                                </div>
    
                                <div class="">
                                    <button type="submit" class="btn btn-primary mt-4">{{ __('Change password') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                {{-- @if($user->role_id == 2) --}}
                <div class="card mt-3">
                    <div class="card-body">
                        <form method="post" action="">
                            @csrf
                            @method('patch')
    
                            <h5 class="text-muted mb-4">{{ __('Commission Rate') }}</h5>
    
                            @include('backend.alerts.success', ['key' => 'sales_commission_rate'])
                            @include('backend.alerts.error_self_update', ['key' => 'sales_commission_rate'])
    
                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('old_password') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="sales_commission_rate">
                                        <i class="w3-xxlarge fa fa-eye-slash"></i>{{ __('Sales Commission Rate') }}
                                    </label>
                                    <input type="text" name="sales_commission_rate" id="sales_commission_rate" class="form-control{{ $errors->has('sales_commission_rate') ? ' is-invalid' : '' }}" value="" required>
    
                                    @include('backend.alerts.feedback', ['field' => 'sales_commission_rate'])
                                </div>
    
                                <div class="">
                                    <button type="submit" class="btn btn-primary mt-4">{{ __('Update') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                {{-- @endif --}}
            </div>
        </div>
    </div>
@endsection