@extends('layouts.app')

@section('content')
<div class="my-4">
    <h2 class="text-center main-color mb-4">Edit Your Profile</h2>

    <div class="row justify-content-center">
        <div class="col-md-8">

            {{-- Display session messages --}}
            @if(session('status'))
            <div class="alert alert-success">
                <p class="m-0">{{ session('status') }}</p>
            </div>
            @endif

            @if(session('success'))
            <div class="alert alert-success">
                <p class="m-0">{{ session('success') }}</p>
            </div>
            @endif

            @if(session('error'))
            <div class="alert alert-danger">
                <p class="m-0">{{ session('error') }}</p>
            </div>
            @endif

            <div class="card shadow-sm border-0">
                <div class="card-header main-bg border-0 text-white">
                    <h5 class="mb-0">Profile Information</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Full Name -->
                        <div class="form-group mb-3">
                            <label for="name" class="form-label">Full Name</label>
                            <div class="input-group">
                                <div class="input-group-text"><i class="fas fa-user"></i></div>
                                <input type="text" name="name" id="name"
                                    class="form-control @error('name') is-invalid @enderror"
                                    value="{{ old('name', Auth::user()->name) }}" required>
                            </div>
                            @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Email Address -->
                        <div class="form-group mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <div class="input-group">
                                <div class="input-group-text"><i class="fas fa-envelope"></i></div>
                                <input type="email" name="email" id="email"
                                    class="form-control @error('email') is-invalid @enderror"
                                    value="{{ old('email', Auth::user()->email) }}" required>
                            </div>
                            @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Bio -->
                        <div class="form-group mb-3">
                            <label for="bio" class="form-label">Short Bio</label>
                            <div class="input-group">
                                <div class="input-group-text"><i class="fas fa-info-circle"></i></div>
                                <textarea name="bio" id="bio" class="form-control @error('bio') is-invalid @enderror"
                                    rows="3">{{ old('bio', Auth::user()->bio) }}</textarea>
                            </div>
                            @error('bio')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Phone Number -->
                        <div class="form-group mb-3">
                            <label for="phone_number" class="form-label">Phone Number</label>
                            <div class="input-group">
                                <div class="input-group-text"><i class="fas fa-phone-alt"></i></div>
                                <input type="text" name="phone_number" id="phone_number"
                                    class="form-control @error('phone_number') is-invalid @enderror"
                                    value="{{ old('phone_number', Auth::user()->phone_number) }}">
                            </div>
                            @error('phone_number')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Date of Birth -->
                        <div class="form-group mb-3">
                            <label for="date_of_birth" class="form-label">Date of Birth</label>
                            <div class="input-group">
                                <div class="input-group-text"><i class="fas fa-calendar-alt"></i></div>
                                <input type="date" name="date_of_birth" id="date_of_birth"
                                    class="form-control @error('date_of_birth') is-invalid @enderror"
                                    value="{{ old('date_of_birth', Auth::user()->date_of_birth) }}" required>
                            </div>
                            @error('date_of_birth')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Gender -->
                        <div class="form-group mb-3">
                            <label for="gender" class="form-label">Gender</label>
                            <div class="input-group">
                                <div class="input-group-text"><i class="fas fa-genderless"></i></div>
                                <select name="gender" id="gender"
                                    class="form-control @error('gender') is-invalid @enderror" required>
                                    <option value="" disabled selected>Select Gender</option>
                                    <option value="male" @if (old('gender', Auth::user()->gender) == 'male') selected
                                        @endif>Male</option>
                                    <option value="female" @if (old('gender', Auth::user()->gender) == 'female')
                                        selected
                                        @endif>Female</option>
                                    <option value="other" @if (old('gender', Auth::user()->gender) == 'other') selected
                                        @endif>Other</option>
                                </select>
                            </div>
                            @error('gender')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Location -->
                        <div class="form-group mb-3">
                            <label for="location" class="form-label">Location</label>
                            <div class="input-group">
                                <div class="input-group-text"><i class="fas fa-map-marker-alt"></i></div>
                                <input type="text" name="location" id="location"
                                    class="form-control @error('location') is-invalid @enderror"
                                    value="{{ old('location', Auth::user()->location) }}">
                            </div>
                            @error('location')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Availability -->
                        <div class="form-group mb-3">
                            <label for="availability" class="form-label">Availability</label>
                            <div class="input-group">
                                <div class="input-group-text"><i class="fas fa-clock"></i></div>
                                <select name="availability" id="availability"
                                    class="form-control @error('availability') is-invalid @enderror" required>
                                    <option value="" disabled selected>Select Availability</option>
                                    <option value="available" @if (old('availability', Auth::user()->availability) ==
                                        'available') selected @endif>Available</option>
                                    <option value="unavailable" @if (old('availability', Auth::user()->availability) ==
                                        'unavailable') selected @endif>Unavailable</option>
                                </select>
                            </div>
                            @error('availability')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Hourly Rate -->
                        <div class="form-group mb-3">
                            <label for="hourly_rate" class="form-label">Hourly Rate</label>
                            <div class="input-group">
                                <div class="input-group-text"><i class="fas fa-dollar-sign"></i></div>
                                <input type="number" name="hourly_rate" id="hourly_rate" step="0.01"
                                    class="form-control @error('hourly_rate') is-invalid @enderror"
                                    value="{{ old('hourly_rate', Auth::user()->hourly_rate) }}">
                            </div>
                            @error('hourly_rate')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Escort Status -->
                        <div class="form-group mb-3">
                            <label for="is_escort" class="form-label">Escort Status</label>
                            <div class="input-group">
                                <div class="input-group-text"><i class="fas fa-user-secret"></i></div>
                                <select name="is_escort" id="is_escort"
                                    class="form-control @error('is_escort') is-invalid @enderror" required>
                                    <option value="1" @if (old('is_escort', Auth::user()->is_escort) == 1) selected
                                        @endif>Yes</option>
                                    <option value="0" @if (old('is_escort', Auth::user()->is_escort) == 0) selected
                                        @endif>No</option>
                                </select>
                            </div>
                            @error('is_escort')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Verification Status -->
                        <div class="form-group mb-3">
                            <label for="is_verified" class="form-label">Verification Status</label>
                            <div class="input-group">
                                <div class="input-group-text"><i class="fas fa-check-circle"></i></div>
                                <select name="is_verified" id="is_verified"
                                    class="form-control @error('is_verified') is-invalid @enderror" required>
                                    <option value="1" @if (old('is_verified', Auth::user()->is_verified) == 1) selected
                                        @endif>Verified</option>
                                    <option value="0" @if (old('is_verified', Auth::user()->is_verified) == 0) selected
                                        @endif>Not Verified</option>
                                </select>
                            </div>
                            @error('is_verified')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Profile Image -->
                        <div class="form-group mb-3">
                            <label for="profile_image" class="form-label">Profile Image</label>
                            <input type="file" name="profile_image" id="profile_image"
                                class="form-control @error('profile_image') is-invalid @enderror">
                            @error('profile_image')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="form-group">
                            <button type="submit" class="btn-solid-main w-100"><i class="fas fa-save"></i> Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection