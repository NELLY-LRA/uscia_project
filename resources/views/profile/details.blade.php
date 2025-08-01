
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- DataTales Example
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="">
                    <div class="">
                        <h6 class="m-0 font-weight-bold text-dark">
                            Admin Profile
                        </h6>
                    </div>
                </div>
            </div>
            <form action="{{ route('adminProfileUpdate') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="">
                            <input type="hidden" name="oldImage" value="{{ auth()->user()->profile }}">

                            <div class="mb-3 text-center">

                                @if (auth()->user()->profile == null)
                                    <img class="img-profile img-thumbnail" id="output"
                                        src="{{ asset('admin/img/undraw_profile.svg') }}" style="max-width: 300px; height:300px;">
                                @else
                                    <img class="img-profile img-thumbnail" id="output"
                                        src="{{ asset('adminProfile/' . auth()->user()->profile) }}" style="max-width: 300px; height:300px;">
                                @endif
                                <input type="file" name="image" style="max-width: 300px;"
                                    class="form-control mt-1 @error('image') is-invalid @enderror"
                                    onchange="loadFile(event)">
                            </div>
                            @error('image')
                                <small class="invalid-feedback">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col">
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Last_Name</label>
                                        <input type="text" name="last_name"
                                            @if (auth()->user()->provider != 'simple') disabled @endif
                                            class="form-control @error('last_name') is-invalid @enderror"
                                            id="exampleFormControlInput1" placeholder="Last Name..."
                                            value="{{ old('last_name', auth()->user()->name == null ? auth()->user()->last_name : auth()->user()->first_name) }}">
                                        @error('last_name')
                                            <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                 <div class="col">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">First_Name</label>
                                        <input type="text" name="first_name"
                                            @if (auth()->user()->provider != 'simple') disabled @endif
                                            class="form-control @error('first_name') is-invalid @enderror"
                                            id="exampleFormControlInput1" placeholder="First Name..."
                                            value="{{ old('first_name', auth()->user()->name == null ? auth()->user()->first_name : auth()->user()->first_name) }}">
                                        @error('first_name')
                                            <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Email</label>
                                        <input type="text" name="email"
                                            @if (auth()->user()->provider != 'simple') disabled @endif
                                            class="form-control @error('email') is-invalid @enderror"
                                            id="exampleFormControlInput1" placeholder="Email..."
                                            value="{{ auth()->user()->email }}">
                                        @error('email')
                                            <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Phone</label>
                                        <input type="text" name="phone"
                                            class="form-control @error('phone') is-invalid @enderror"
                                            id="exampleFormControlInput1" placeholder="09xxxxxxxx"
                                            value="{{ old('phone', auth()->user()->phone) }}">
                                        @error('phone')
                                            <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror

                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Address</label>
                                        <input type="text" name="address"
                                            class="form-control @error('address') is-invalid @enderror"
                                            id="exampleFormControlInput1" placeholder="Address..."
                                            value="{{ old('address', auth()->user()->address) }}">
                                        @error('address')
                                            <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                                    @if (auth()->user()->provider == 'simple')
                                        <a href="{{ route('passwordChange') }}">Change Password</a><br><br>
                                    @endif
                            <div class="row">
                                <div class="col-6">
                                    <input type="submit" value="Update" class="btn btn-primary mt-2 w-100">
                                </div>
                                <div class="col-6">
                                    <a href="{{ route('adminDashboard') }}" class="btn btn-secondary mt-2 w-100 text-center"
                                    >Back</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

    </div>
    /.container-fluid -->


    @extends('admin.layouts.app')

@section('content')
    <div class="container mt-5">
        <h2>My Profile</h2>
        <form method="POST" action="{{ route('admin.profile.update', $admin->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="last_name" class="form-label">Last Name</label>
                <input type="text" name="last_name" class="form-control" value="{{ old('last_name', $admin->last_name) }}" required>
                @error('last_name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label for="first_name" class="form-label">First Name</label>
                <input type="text" name="first_name" class="form-control" value="{{ old('first_name', $admin->first_name) }}" required>
                @error('first_name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" name="email" class="form-control" value="{{ old('email', $admin->email) }}" required>
                @error('email')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="text" name="phone" class="form-control" value="{{ old('phone', $admin->phone) }}">
                @error('phone')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label for="grade" class="form-label">Grade</label>
                <input type="text" name="grade" class="form-control" value="{{ old('grade', $admin->grade) }}">
                @error('grade')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label for="country" class="form-label">Country</label>
                <input type="text" name="country" class="form-control" value="{{ old('country', $admin->country) }}">
                @error('country')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label for="profile" class="form-label">Profile Photo</label><br>
                @if ($admin->profile)
                    <img src="{{ asset('storage/profiles/' . $admin->profile) }}" alt="Profile image" width="100" class="mb-2"><br>
                @endif
                <input type="file" name="profile" class="form-control">
                @error('profile')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
