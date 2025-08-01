@extends('layouts.partials')

@section('content')
    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Edit Member</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('updateUser', $user->id) }}" method="POST">
                    @csrf

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="last_name">Last Name</label>
                            <input type="text" name="last_name" class="form-control"
                                value="{{ old('last_name', $user->last_name) }}" required>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="first_name">First Name</label>
                            <input type="text" name="first_name" class="form-control"
                                value="{{ old('first_name', $user->first_name) }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}"
                            required>
                    </div>

                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="text" name="phone" class="form-control" value="{{ old('phone', $user->phone) }}">
                    </div>

                    <div class="form-group">
                        <label for="grade">Grade</label>
                        <input type="text" name="grade" class="form-control" value="{{ old('grade', $user->grade) }}">
                    </div>

                    <div class="form-group">
                        <label for="country">Country</label>
                        <select name="country" class="form-control" required>
                            <option value="">-- Select Country --</option>
                            @php
                                $countries = [
                                    'Angola',
                                    'Benin',
                                    'Botswana',
                                    'Burkina Faso',
                                    'Burundi',

                                    'Cameroon',
                                    'Cape Verde',
                                    'Central African Republic',
                                    'Chad',
                                    'Comoros',
                                    'Congo',
                                    'Cote Ivoire',
                                    'Democratic Republic of Congo',
                                    'Djibouti',
                                    'Egypt',
                                    'Equatorial Guinea',
                                    'Eritrea',
                                    'Gabon',
                                    'Gambia',
                                    'Ghana',
                                    'Guinea',
                                    'Guinea-Bissau',
                                    'Kenya',
                                    'Lesotho',
                                    'Liberia',
                                    'Libya',
                                    'Madagascar',
                                    'Malawi',
                                    'Mali',
                                    'Mauritania',
                                    'Mayotte',
                                    'Morocco',
                                    'Mozambique',
                                    'Namibia',
                                    'Niger',
                                    'Nigeria',
                                    'Rwanda',
                                    'São Tomé and Príncipe',
                                    'Senegal',
                                    'Sierra Leone',
                                    'Somalia',
                                    'South Africa',
                                    'South Sudan',
                                    'Sudan',
                                    'United Republic of Tanzania',
                                    'Togo',
                                    'Tunisia',
                                    'Uganda',
                                    'Zambia',
                                    'Zimbabwe',
                                ];
                            @endphp
                            @foreach ($countries as $country)
                                <option value="{{ $country }}"
                                    {{ old('country', $user->country) === $country ? 'selected' : '' }}>
                                    {{ $country }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group text-right">
                        <a href="{{ route('userList') }}" class="btn btn-secondary">Cancel</a>
                        <button type="submit" class="btn btn-success">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
