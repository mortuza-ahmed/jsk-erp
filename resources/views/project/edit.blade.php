@extends('layouts.app')
@section('title', 'Projects')
@section('style')
<style>
    .select2-container--default .select2-selection--single {
        border: 1px solid #CED4DA !important;
        border-radius: 0.25rem !important;
        height: 38px !important;
        display: flex;
        align-items: center;
    }
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        padding-left: 12px !important;
        line-height: normal !important;
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 36px !important;
    }
</style>
@endsection
@section('content')
    <div class="page-content">
        <div class="container-fluid mt-8">
            <div class="page-content-wrapper">
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-6">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h4>Project Edit</h4>
                                    <a href="{{ route('projects.index') }}" class="btn btn-info">
                                        <i class="fas fa-arrow-circle-left"></i> Project List
                                    </a>
                                </div>
                            </div>
                            <form class="custom-validation" action="{{ route('projects.update', $project->id) }}" method="post">
                                @csrf
                                @method('PUT')
                                <div class="card-body">

                                    <div class="field-group">
                                        <label for="project_name"><i class="fas fa-briefcase"></i> Name of Project <span class="text-danger">*</span></label>
                                        <input type="text" name="project_name" id="project_name"
                                            class="form-control @error('project_name') is-invalid @enderror"
                                            value="{{ old('project_name', $project->project_name) }}" placeholder="e.g. Al Maharah Manpower Supply">
                                        @error('project_name')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="field-group mt-3">
                                        <label for="country"><i class="fas fa-globe-asia"></i> Country <span class="text-danger">*</span></label>
                                        <select name="country" class="form-control select2">
                                            <option value="">Select Country</option>
                                            @php
                                                $countries = [
                                                    'Afghanistan', 'Albania', 'Algeria', 'Andorra', 'Angola', 'Antigua and Barbuda',
                                                    'Argentina', 'Armenia', 'Australia', 'Austria', 'Azerbaijan', 'Bahamas', 'Bahrain',
                                                    'Bangladesh', 'Barbados', 'Belarus', 'Belgium', 'Belize', 'Benin', 'Bhutan',
                                                    'Bolivia', 'Bosnia and Herzegovina', 'Botswana', 'Brazil', 'Brunei', 'Bulgaria',
                                                    'Burkina Faso', 'Burundi', 'Cabo Verde', 'Cambodia', 'Cameroon', 'Canada',
                                                    'Central African Republic', 'Chad', 'Chile', 'China', 'Colombia', 'Comoros',
                                                    'Congo (Congo-Brazzaville)', 'Costa Rica', 'Croatia', 'Cuba', 'Cyprus', 'Czechia',
                                                    'Democratic Republic of the Congo', 'Denmark', 'Djibouti', 'Dominica',
                                                    'Dominican Republic', 'Ecuador', 'Egypt', 'El Salvador', 'Equatorial Guinea',
                                                    'Eritrea', 'Estonia', 'Eswatini', 'Ethiopia', 'Fiji', 'Finland', 'France', 'Gabon',
                                                    'Gambia', 'Georgia', 'Germany', 'Ghana', 'Greece', 'Grenada', 'Guatemala', 'Guinea',
                                                    'Guinea-Bissau', 'Guyana', 'Haiti', 'Honduras', 'Hungary', 'Iceland', 'India',
                                                    'Indonesia', 'Iran', 'Iraq', 'Ireland', 'Israel', 'Italy', 'Ivory Coast', 'Jamaica',
                                                    'Japan', 'Jordan', 'Kazakhstan', 'Kenya', 'Kiribati', 'Kuwait', 'Kyrgyzstan',
                                                    'Laos', 'Latvia', 'Lebanon', 'Lesotho', 'Liberia', 'Libya', 'Liechtenstein',
                                                    'Lithuania', 'Luxembourg', 'Madagascar', 'Malawi', 'Malaysia', 'Maldives', 'Mali',
                                                    'Malta', 'Marshall Islands', 'Mauritania', 'Mauritius', 'Mexico', 'Micronesia',
                                                    'Moldova', 'Monaco', 'Mongolia', 'Montenegro', 'Morocco', 'Mozambique', 'Myanmar',
                                                    'Namibia', 'Nauru', 'Nepal', 'Netherlands', 'New Zealand', 'Nicaragua', 'Niger',
                                                    'Nigeria', 'North Korea', 'North Macedonia', 'Norway', 'Oman', 'Pakistan', 'Palau',
                                                    'Palestine', 'Panama', 'Papua New Guinea', 'Paraguay', 'Peru', 'Philippines',
                                                    'Poland', 'Portugal', 'Qatar', 'Romania', 'Russia', 'Rwanda',
                                                    'Saint Kitts and Nevis', 'Saint Lucia', 'Saint Vincent and the Grenadines',
                                                    'Samoa', 'San Marino', 'Sao Tome and Principe', 'Saudi Arabia', 'Senegal',
                                                    'Serbia', 'Seychelles', 'Sierra Leone', 'Singapore', 'Slovakia', 'Slovenia',
                                                    'Solomon Islands', 'Somalia', 'South Africa', 'South Korea', 'South Sudan',
                                                    'Spain', 'Sri Lanka', 'Sudan', 'Suriname', 'Sweden', 'Switzerland', 'Syria',
                                                    'Taiwan', 'Tajikistan', 'Tanzania', 'Thailand', 'Timor-Leste', 'Togo', 'Tonga',
                                                    'Trinidad and Tobago', 'Tunisia', 'Turkey', 'Turkmenistan', 'Tuvalu', 'Uganda',
                                                    'Ukraine', 'United Arab Emirates', 'United Kingdom', 'United States', 'Uruguay',
                                                    'Uzbekistan', 'Vanuatu', 'Vatican City', 'Venezuela', 'Vietnam', 'Yemen',
                                                    'Zambia', 'Zimbabwe',
                                                ];
                                            @endphp
                                            @foreach ($countries as $country)
                                                <option value="{{ $country }}" {{ old('country', $project->country) == $country ? 'selected' : '' }}>{{ $country }}</option>
                                            @endforeach
                                        </select>
                                        @error('country')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="field-group mt-3">
                                        <label for="company_name"><i class="fas fa-building"></i> Company Name <span class="text-danger">*</span></label>
                                        <input type="text" name="company_name" id="company_name"
                                            class="form-control @error('company_name') is-invalid @enderror"
                                            value="{{ old('company_name', $project->company_name) }}" placeholder="Enter company name">
                                        @error('company_name')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mt-3">
                                        <label class="mb-1"><i class="fas fa-id-card"></i> Waqala - Visa No. <span class="text-danger">*</span></label>
                                        <input type="text" name="waqala_visa_number" id="waqala_visa_number"
                                            class="form-control @error('waqala_visa_number') is-invalid @enderror"
                                            value="{{ old('waqala_visa_number', $project->waqala_visa_number) }}" placeholder="Waqala-Visa Number">
                                        @error('waqala_visa_number')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mt-3">
                                        <label class="mb-1"><i class="fas fa-user-tie"></i> Profession <span class="text-danger">*</span></label>
                                        <input type="text" name="profession" id="profession"
                                            class="form-control @error('profession') is-invalid @enderror"
                                            value="{{ old('profession', $project->profession) }}" placeholder="Enter profession">
                                        @error('profession')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mt-3">
                                        <label class="mb-1"><i class="fas fa-hashtag"></i> Ref No.</label>
                                        <input type="text" name="ref_no" id="ref_no"
                                            class="form-control ref-input @error('ref_no') is-invalid @enderror"
                                            value="{{ old('ref_no', $project->ref_no) }}" placeholder="Reference">
                                        @error('ref_no')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mt-3">
                                        <label class="mb-1"><i class="fas fa-calendar-day"></i> Initiate <span class="text-danger">*</span></label>
                                        <input type="date" name="initiate_date" id="initiate_date"
                                            class="form-control @error('initiate_date') is-invalid @enderror"
                                            value="{{ old('initiate_date', \Carbon\Carbon::parse($project->initiate_date)->format('Y-m-d')) }}">
                                        @error('initiate_date')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mt-3">
                                        <div>
                                            <button type="submit" class="btn btn-primary waves-effect waves-light me-1">
                                                Update
                                            </button>
                                            <a href="{{ route('projects.index') }}" type="reset"
                                                class="btn btn-secondary waves-effect">
                                                Cancel
                                            </a>
                                        </div>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function () {
            $('.select2').select2({
                placeholder: 'Select Country',
                allowClear: true,
                width: '100%'
            });
        });
    </script>
@endsection