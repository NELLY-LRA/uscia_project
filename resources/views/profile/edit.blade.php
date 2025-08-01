@extends('layouts.partials')

@section('content')
<div class="container">
    <h4 class="text-primary mb-4">Edit Admin Account</h4>

    <form action="{{ route('updateAdmin', $admin->id) }}" method="POST">
        @csrf

        <div class="form-group">
            <label>Last Name</label>
            <input type="text" name="last_name" value="{{ $admin->last_name }}" class="form-control" required>
        </div>

        <div class="form-group">
            <label>First Name</label>
            <input type="text" name="first_name" value="{{ $admin->first_name }}" class="form-control">
        </div>

        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" value="{{ $admin->email }}" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Phone</label>
            <input type="text" name="phone" value="{{ $admin->phone }}" class="form-control">
        </div>

        <div class="form-group">
            <label>Grade</label>
            <input type="text" name="grade" value="{{ $admin->grade }}" class="form-control">
        </div>

        <div class="form-group">
            <label>Country</label>
<select name="country" value="{{ $admin->country }}" class="form-control">
<option value="">Choose a country</option>
                            <option value="Algerie">Algerie</option>
                            <option value="Angola">Angola</option>
                            <option value="Benin">Benin</option>
                            <option value="Botswana">Botswana</option>
                            <option value="Burkina Faso">Burkina Faso</option>
                            <option value="Burundi">Burundi</option>
                            <option value="Cameroon">Cameroon</option>
                            <option value="Cape Verde">Cape Verde</option>
                            <option value="Central African Republic">Central African Republic</option>
                            <option value="Chad">Chad</option>
                            <option value="Comoros">Comoros</option>
                            <option value="Congo">Congo</option>
                            <option value="Cote d'Ivoire">Cote d'Ivoire</option>
                            <option value="Democratic Republic of Congo">Democratic Republic of Congo</option>
                            <option value="Djibouti">Djibouti</option>
                            <option value="Egypt">Egypt</option>
                            <option value="Equatorial Guinea">Equatorial Guinea</option>
                            <option value="Eritrea">Eritrea</option>
                            <option value="Eswatini (Swaziland)">Eswatini (Swaziland)</option>
                            <option value="Ethiopia">Ethiopia</option>
                            <option value="Gabon">Gabon</option>
                            <option value="Gambia">Gambia</option>
                            <option value="Ghana">Ghana</option>
                            <option value="Guinea">Guinea</option>
                            <option value="Guinea-Bissau">Guinea-Bissau</option>
                            <option value="Kenya">Kenya</option>
                            <option value="Lesotho">Lesotho</option>
                            <option value="Liberia">Liberia</option>
                            <option value="Libya">Libya</option>
                            <option value="Madagascar">Madagascar</option>
                            <option value="Malawi">Malawi</option>
                            <option value="Mali">Mali</option>
                            <option value="Mauritania">Mauritania</option>
                            <option value="Mauritius">Mauritius</option>
                            <option value="Mayotte">Mayotte</option>
                            <option value="Morocco">Morocco</option>
                            <option value="Mozambique">Mozambique</option>
                            <option value="Namibia">Namibia</option>
                            <option value="Niger">Niger</option>
                            <option value="Nigeria">Nigeria</option>
                             <option value="Réunion">Réunion</option>
                            <option value="Rwanda">Rwanda</option>
                            <option value="Saint Helena">Saint Helena</option>
                            <option value="São Tomé and Príncipe">São Tomé and Príncipe</option>
                             <option value="Senegal">Senegal</option>
                            <option value="Seychelles">Seychelles</option>
                            <option value="Sierra Leone">Sierra Leone</option>
                             <option value="Somalia">Somalia</option>
                            <option value="South Africa">South Africa</option>
                            <option value="South Sudan">South Sudan</option>
                            <option value="Sudan">Sudan</option>
                            <option value="United Republic of Tanzania">United Republic of Tanzania</option>
                            <option value="Togo">Togo</option>
                            <option value="Tunisia">Tunisia</option>
                            <option value="Uganda">Uganda</option>
                             <option value="Zambia">Zambia</option>
                            <option value="Zimbabwe">Zimbabwe</option>
                        </select>
        </div>

        <button type="submit" class="btn btn-success mt-3">Update</button>
        <a href="{{ route('adminList') }}" class="btn btn-secondary mt-3">Cancel</a>
    </form>
</div>
@endsection
