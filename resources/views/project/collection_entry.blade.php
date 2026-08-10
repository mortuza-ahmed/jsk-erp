@extends('layouts.app')
@section('title', isset($collection) ? 'Edit Collection Entry' : 'Interview List Search')
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
    .search-tabs.nav-tabs {
        border-bottom: none !important;
    }
    .search-tabs.nav-tabs .nav-link {
        border: 1px solid #E9ECEF !important;
        border-bottom: none !important;
        color: #495057 !important;
        background-color: #F8F9FA !important;
        font-weight: 500;
        border-radius: 0.25rem 0.25rem 0 0 !important;
    }
    .search-tabs.nav-tabs .nav-link:hover {
        color: #556EE6 !important;
        background-color: #EEF0FC !important;
    }
    .search-tabs.nav-tabs .nav-link.active,
    .search-tabs.nav-tabs .nav-item.show .nav-link {
        color: #fff !important;
        background-color: #556EE6 !important;
        border-color: #556EE6 !important;
    }
    .search-tabs.nav-tabs .nav-link.active i,
    .search-tabs.nav-tabs .nav-link.active {
        color: #fff !important;
    }
    .search-tabs .tab-content {
        border: 1px solid #E9ECEF;
        border-top: none;
        padding: 1.25rem;
        border-radius: 0 0 0.25rem 0.25rem;
    }
</style>
@endsection
@section('content')
    <div class="page-content">
        <div class="container-fluid mt-8">
            <div class="page-content-wrapper">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h4>{{ isset($collection) ? 'Edit Collection Entry' : 'Collection Entry' }}</h4>
                                    <div>
                                        @if (isset($collection))
                                            <a href="{{ route('projects.collectionView', $collection->project_id ?? null) }}" class="btn btn-success">
                                                <i class="fas fa-arrow-circle-left"></i> Collection List
                                            </a>
                                        @endif
                                        <a href="{{ route('projects.index') }}" class="btn btn-info">
                                            <i class="fas fa-arrow-circle-left"></i> Project List
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <form class="custom-validation"
                                  action="{{ isset($collection) ? route('projects.collectionEntry.update', $collection->id) : route('projects.collectionEntry.store') }}"
                                  method="post">
                                @csrf
                                @if (isset($collection))
                                    @method('PUT')
                                @endif
                                <div class="card-body">

                                    <div class="row">
                                        <div class="col-12 col-md-6 col-lg-3 field-group">
                                            <label for="project_id"><i class="fas fa-briefcase"></i> Project</label>
                                            <select name="project_id" id="project_id" class="form-control select2">
                                                <option value="">Select Project</option>
                                                @foreach ($projects ?? [] as $project)
                                                    <option value="{{ $project->id }}"
                                                        {{ old('project_id', $collection->project_id ?? '') == $project->id ? 'selected' : '' }}>
                                                        {{ $project->project_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-12 col-md-6 col-lg-3 field-group">
                                            <label for="name"><i class="fas fa-user"></i> Name</label>
                                            <input type="text" name="name" id="name" class="form-control"
                                                value="{{ old('name', $collection->name ?? '') }}" placeholder="Candidate name">
                                        </div>
                                        <div class="col-12 col-md-6 col-lg-3 field-group">
                                            <label for="pp_no"><i class="fas fa-passport"></i> PP No.</label>
                                            <input type="text" name="pp_no" id="pp_no" class="form-control"
                                                value="{{ old('pp_no', $collection->pp_no ?? '') }}" placeholder="Passport number">
                                        </div>
                                        <div class="col-12 col-md-6 col-lg-3 field-group">
                                            <label for="phone_no"><i class="fas fa-phone"></i> Phone No.</label>
                                            <input type="text" name="phone_no" id="phone_no" class="form-control"
                                                value="{{ old('phone_no', $collection->phone_no ?? '') }}" placeholder="Phone number">
                                        </div>
                                    </div>

                                    {{-- ===================== SECTION TABS ===================== --}}
                                    <ul class="nav nav-tabs search-tabs mt-4" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-bs-toggle="tab" href="#tab-interview" role="tab">
                                                <i class="fas fa-clipboard-list"></i> Passport Collection (Interview)
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-bs-toggle="tab" href="#tab-entry" role="tab">
                                                <i class="fas fa-file-import"></i> Passport Entry, Ready
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-bs-toggle="tab" href="#tab-mofa" role="tab">
                                                <i class="fas fa-stamp"></i> MOFA Section
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-bs-toggle="tab" href="#tab-visa" role="tab">
                                                <i class="fas fa-id-badge"></i> Visa Management
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-bs-toggle="tab" href="#tab-embassy" role="tab">
                                                <i class="fas fa-landmark"></i> Embassy Section
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-bs-toggle="tab" href="#tab-manpower" role="tab">
                                                <i class="fas fa-users"></i> Manpower
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-bs-toggle="tab" href="#tab-flight" role="tab">
                                                <i class="fas fa-plane"></i> Flight
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-bs-toggle="tab" href="#tab-delivery" role="tab">
                                                <i class="fas fa-truck"></i> Delivery Section
                                            </a>
                                        </li>
                                    </ul>

                                    <div class="tab-content">

                                        {{-- ---- Passport Collection (Interview) ---- --}}
                                        <div class="tab-pane fade show active" id="tab-interview" role="tabpanel">
                                            <div class="row">
                                                <div class="col-12 col-md-6 col-lg-4 mt-3">
                                                    <label class="mb-1"><i class="fas fa-calendar-day"></i> Date</label>
                                                    <input type="date" name="interview_date_from" class="form-control"
                                                        value="{{ old('interview_date_from', isset($collection->interview_date_from) ? \Carbon\Carbon::parse($collection->interview_date_from)->format('Y-m-d') : '') }}">
                                                </div>
                                                <div class="col-12 col-md-6 col-lg-4 mt-3">
                                                    <label class="mb-1"><i class="fas fa-user-clock"></i> Age</label>
                                                    <div class="d-flex gap-2">
                                                        <input type="number" name="age" class="form-control" min="18" max="60"
                                                            value="{{ old('age', $collection->age ?? '') }}" placeholder="Age">
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6 col-lg-4 mt-3">
                                                    <label class="mb-1"><i class="fas fa-user-tie"></i> Agent Name</label>
                                                    <select name="agent_id" id="agent_id" class="form-control select2">
                                                        <option value="">Select Agent</option>
                                                        @foreach ($agents ?? [] as $agent)
                                                            <option value="{{ $agent['id'] }}"
                                                                {{ old('agent_id', $collection->agent_id ?? '') == $agent['id'] ? 'selected' : '' }}>
                                                                {{ $agent['name'] }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-12 col-md-6 col-lg-4 mt-3">
                                                    <label class="mb-1"><i class="fas fa-check-circle"></i> Status</label>
                                                    <select name="status" class="form-control select2">
                                                        <option value="">Any Status</option>
                                                        <option value="SELECTED" {{ old('status', $collection->status ?? '') == 'SELECTED' ? 'selected' : '' }}>SELECTED</option>
                                                        <option value="FINAL SELECTED" {{ old('status', $collection->status ?? '') == 'FINAL SELECTED' ? 'selected' : '' }}>FINAL SELECTED</option>
                                                    </select>
                                                </div>
                                                <div class="col-12 col-md-6 col-lg-4 mt-3">
                                                    <label class="mb-1"><i class="fas fa-briefcase"></i> Category</label>
                                                    <select name="category" class="form-control select2">
                                                        <option value="">Any Category</option>
                                                        @foreach ($categories ?? [] as $cat)
                                                            <option value="{{ $cat['id'] }}"
                                                                {{ old('category', $collection->category ?? '') == $cat['id'] ? 'selected' : '' }}>
                                                                {{ $cat['name'] }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-12 col-md-6 col-lg-4 mt-3">
                                                    <label class="mb-1"><i class="fas fa-notes-medical"></i> Medical</label>
                                                    <input type="text" name="medical" class="form-control"
                                                        value="{{ old('medical', $collection->medical ?? '') }}" placeholder="e.g. MEDICAL DONE">
                                                </div>
                                                <div class="col-12 col-md-6 col-lg-4 mt-3">
                                                    <label class="mb-1"><i class="fas fa-vial"></i> Takamul</label>
                                                    <input type="text" name="takamul" class="form-control"
                                                        value="{{ old('takamul', $collection->takamul ?? '') }}" placeholder="e.g. TAKAMUL DONE">
                                                </div>
                                                <div class="col-12 col-md-6 col-lg-4 mt-3">
                                                    <label class="mb-1"><i class="fas fa-file-alt"></i> PC</label>
                                                    <input type="text" name="pc" class="form-control"
                                                        value="{{ old('pc', $collection->pc ?? '') }}" placeholder="e.g. PC READY">
                                                </div>
                                                <div class="col-12 col-md-6 col-lg-4 mt-3">
                                                    <label class="mb-1"><i class="fas fa-id-card-alt"></i> DL</label>
                                                    <select name="dl" class="form-control select2">
                                                        <option value="">Any</option>
                                                        <option value="NEED DL" {{ old('dl', $collection->dl ?? '') == 'NEED DL' ? 'selected' : '' }}>NEED DL</option>
                                                        <option value="OK" {{ old('dl', $collection->dl ?? '') == 'OK' ? 'selected' : '' }}>OK</option>
                                                    </select>
                                                </div>
                                                <div class="col-12 col-md-6 col-lg-4 mt-3">
                                                    <label for="final_status_id"><i class="fas fa-flag"></i> Final Status</label>
                                                    <select name="final_status_id" id="final_status_id" class="form-control select2">
                                                        <option value="">Select Status</option>
                                                        @foreach ($finalStatus ?? [] as $status)
                                                            <option value="{{ $status['id'] }}"
                                                                {{ old('final_status_id', $collection->final_status_id ?? '') == $status['id'] ? 'selected' : '' }}>
                                                                {{ $status['name'] }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-12 col-md-6 col-lg-4 mt-3">
                                                    <label for="company_id"><i class="fas fa-building"></i> Company</label>
                                                    <select name="company_id" id="company_id" class="form-control select2">
                                                        <option value="">Select Company</option>
                                                        @foreach ($companies ?? [] as $company)
                                                            <option value="{{ $company['id'] }}"
                                                                {{ old('company_id', $collection->company_id ?? '') == $company['id'] ? 'selected' : '' }}>
                                                                {{ $company['name'] }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- ---- Passport Entry, Ready ---- --}}
                                        <div class="tab-pane fade" id="tab-entry" role="tabpanel">
                                            <div class="row">
                                                <div class="col-12 col-md-6 col-lg-4 mt-3">
                                                    <label class="mb-1"><i class="fas fa-sign-in-alt"></i> S. Entry</label>
                                                    <input type="text" name="s_entry" class="form-control"
                                                        value="{{ old('s_entry', $collection->s_entry ?? '') }}" placeholder="Entry status">
                                                </div>
                                                <div class="col-12 col-md-6 col-lg-4 mt-3">
                                                    <label class="mb-1"><i class="fas fa-calendar-day"></i> Date</label>
                                                    <input type="date" name="entry_date" class="form-control"
                                                        value="{{ old('entry_date', isset($collection->entry_date) ? \Carbon\Carbon::parse($collection->entry_date)->format('Y-m-d') : '') }}">
                                                </div>
                                                <div class="col-12 col-md-6 col-lg-4 mt-3">
                                                    <label class="mb-1"><i class="fas fa-image"></i> Pic</label>
                                                    <select name="pic" class="form-control select2">
                                                        <option value="">Any</option>
                                                        <option value="YES" {{ old('pic', $collection->pic ?? '') == 'YES' ? 'selected' : '' }}>YES</option>
                                                        <option value="NO" {{ old('pic', $collection->pic ?? '') == 'NO' ? 'selected' : '' }}>NO</option>
                                                    </select>
                                                </div>
                                                <div class="col-12 col-md-6 col-lg-4 mt-3">
                                                    <label class="mb-1"><i class="fas fa-passport"></i> Tasheer</label>
                                                    <input type="text" name="tasheer" class="form-control"
                                                        value="{{ old('tasheer', $collection->tasheer ?? '') }}" placeholder="Tasheer status">
                                                </div>
                                                <div class="col-12 col-md-6 col-lg-4 mt-3">
                                                    <label class="mb-1"><i class="fas fa-flag-checkered"></i> Final Status</label>
                                                    <select name="entry_final_status" id="entry_final_status" class="form-control select2">
                                                        <option value="">Select Status</option>
                                                        @foreach ($finalStatus ?? [] as $status)
                                                            <option value="{{ $status['id'] }}"
                                                                {{ old('entry_final_status', $collection->entry_final_status ?? '') == $status['id'] ? 'selected' : '' }}>
                                                                {{ $status['name'] }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- ---- MOFA Section ---- --}}
                                        <div class="tab-pane fade" id="tab-mofa" role="tabpanel">
                                            <div class="row">
                                                <div class="col-12 col-md-6 col-lg-4 mt-3">
                                                    <label class="mb-1"><i class="fas fa-calendar-day"></i> MOFA Date</label>
                                                    <input type="date" name="mofa_date" class="form-control"
                                                        value="{{ old('mofa_date', isset($collection->mofa_date) ? \Carbon\Carbon::parse($collection->mofa_date)->format('Y-m-d') : '') }}">
                                                </div>
                                                <div class="col-12 col-md-6 col-lg-4 mt-3">
                                                    <label class="mb-1"><i class="fas fa-check-double"></i> MOFA Status</label>
                                                    <select name="mofa_status" class="form-control select2">
                                                        <option value="">Any</option>
                                                        <option value="DONE" {{ old('mofa_status', $collection->mofa_status ?? '') == 'DONE' ? 'selected' : '' }}>DONE</option>
                                                        <option value="PENDING" {{ old('mofa_status', $collection->mofa_status ?? '') == 'PENDING' ? 'selected' : '' }}>PENDING</option>
                                                    </select>
                                                </div>
                                                <div class="col-12 col-md-6 col-lg-4 mt-3">
                                                    <label class="mb-1"><i class="fas fa-comment-dots"></i> Comments</label>
                                                    <input type="text" name="comments" class="form-control"
                                                        value="{{ old('comments', $collection->comments ?? '') }}" placeholder="Search comments">
                                                </div>
                                            </div>
                                        </div>

                                        {{-- ---- Visa Management ---- --}}
                                        <div class="tab-pane fade" id="tab-visa" role="tabpanel">
                                            <div class="row">
                                                <div class="col-12 col-md-6 col-lg-4 mt-3">
                                                    <label class="mb-1"><i class="fas fa-building"></i> F. Company Name</label>
                                                    <select name="f_company_id" class="form-control select2">
                                                        <option value="">Any Company</option>
                                                        @foreach ($companies ?? [] as $company)
                                                            <option value="{{ $company['id'] }}"
                                                                {{ old('f_company_id', $collection->f_company_id ?? '') == $company['id'] ? 'selected' : '' }}>
                                                                {{ $company['name'] }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-12 col-md-6 col-lg-4 mt-3">
                                                    <label class="mb-1"><i class="fas fa-paper-plane"></i> Sent for MOFA / Agency</label>
                                                    <input type="text" name="sent_for_mofa_agency" class="form-control"
                                                        value="{{ old('sent_for_mofa_agency', $collection->sent_for_mofa_agency ?? '') }}" placeholder="e.g. JSK">
                                                </div>
                                                <div class="col-12 col-md-6 col-lg-4 mt-3">
                                                    <label class="mb-1"><i class="fas fa-user-hard-hat"></i> Occupation</label>
                                                    <input type="text" name="occupation" class="form-control"
                                                        value="{{ old('occupation', $collection->occupation ?? '') }}" placeholder="Occupation">
                                                </div>
                                                <div class="col-12 col-md-6 col-lg-4 mt-3">
                                                    <label class="mb-1"><i class="fas fa-file-import"></i> Visa Inport</label>
                                                    <input type="text" name="visa_inport" class="form-control"
                                                        value="{{ old('visa_inport', $collection->visa_inport ?? '') }}" placeholder="Visa inport status">
                                                </div>
                                                <div class="col-12 col-md-6 col-lg-4 mt-3">
                                                    <label class="mb-1"><i class="fas fa-tasks"></i> Status in Visa Section</label>
                                                    <select name="status_in_visa_section" class="form-control select2">
                                                        <option value="">Any</option>
                                                        <option value="READY FOR EMBASSY" {{ old('status_in_visa_section', $collection->status_in_visa_section ?? '') == 'READY FOR EMBASSY' ? 'selected' : '' }}>READY FOR EMBASSY</option>
                                                    </select>
                                                </div>
                                                <div class="col-12 col-md-6 col-lg-4 mt-3">
                                                    <label class="mb-1"><i class="fas fa-clock"></i> Embassy Section Handover Date & Time</label>
                                                    <input type="datetime-local" name="embassy_handover" class="form-control"
                                                        value="{{ old('embassy_handover', isset($collection->embassy_handover) ? \Carbon\Carbon::parse($collection->embassy_handover)->format('Y-m-d\TH:i') : '') }}"
                                                        placeholder="e.g. 30 JUL 12.45">
                                                </div>
                                            </div>
                                        </div>

                                        {{-- ---- Embassy Section ---- --}}
                                        <div class="tab-pane fade" id="tab-embassy" role="tabpanel">
                                            <div class="row">
                                                <div class="col-12 col-md-6 col-lg-4 mt-3">
                                                    <label class="mb-1"><i class="fas fa-stamp"></i> Stamping</label>
                                                    <select name="stamping" class="form-control select2">
                                                        <option value="">Any</option>
                                                        <option value="STAMPING DONE" {{ old('stamping', $collection->stamping ?? '') == 'STAMPING DONE' ? 'selected' : '' }}>STAMPING DONE</option>
                                                        <option value="PENDING" {{ old('stamping', $collection->stamping ?? '') == 'PENDING' ? 'selected' : '' }}>PENDING</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- ---- Manpower ---- --}}
                                        <div class="tab-pane fade" id="tab-manpower" role="tabpanel">
                                            <div class="row">
                                                <div class="col-12 col-md-6 col-lg-4 mt-3">
                                                    <label class="mb-1"><i class="fas fa-chalkboard-teacher"></i> Training</label>
                                                    <select name="training" class="form-control select2">
                                                        <option value="">Any</option>
                                                        <option value="DONE" {{ old('training', $collection->training ?? '') == 'DONE' ? 'selected' : '' }}>DONE</option>
                                                        <option value="PENDING" {{ old('training', $collection->training ?? '') == 'PENDING' ? 'selected' : '' }}>PENDING</option>
                                                    </select>
                                                </div>
                                                <div class="col-12 col-md-6 col-lg-4 mt-3">
                                                    <label class="mb-1"><i class="fas fa-fingerprint"></i> Finger</label>
                                                    <select name="finger" class="form-control select2">
                                                        <option value="">Any</option>
                                                        <option value="DONE" {{ old('finger', $collection->finger ?? '') == 'DONE' ? 'selected' : '' }}>DONE</option>
                                                        <option value="PENDING" {{ old('finger', $collection->finger ?? '') == 'PENDING' ? 'selected' : '' }}>PENDING</option>
                                                    </select>
                                                </div>
                                                <div class="col-12 col-md-6 col-lg-4 mt-3">
                                                    <label class="mb-1"><i class="fas fa-users-cog"></i> Man. P.</label>
                                                    <input type="text" name="man_p" class="form-control"
                                                        value="{{ old('man_p', $collection->man_p ?? '') }}" placeholder="Manpower remarks">
                                                </div>
                                            </div>
                                        </div>

                                        {{-- ---- Flight ---- --}}
                                        <div class="tab-pane fade" id="tab-flight" role="tabpanel">
                                            <div class="row">
                                                <div class="col-12 col-md-6 col-lg-4 mt-3">
                                                    <label class="mb-1"><i class="fas fa-plane-departure"></i> F. Date</label>
                                                    <input type="date" name="f_date_from" class="form-control"
                                                        value="{{ old('f_date_from', isset($collection->f_date_from) ? \Carbon\Carbon::parse($collection->f_date_from)->format('Y-m-d') : '') }}">
                                                </div>
                                                <div class="col-12 col-md-6 col-lg-4 mt-3">
                                                    <label class="mb-1"><i class="fas fa-calendar-times"></i> Exp. Date</label>
                                                    <input type="date" name="exp_date" class="form-control"
                                                        value="{{ old('exp_date', isset($collection->exp_date) ? \Carbon\Carbon::parse($collection->exp_date)->format('Y-m-d') : '') }}">
                                                </div>
                                            </div>
                                        </div>

                                        {{-- ---- Delivery Section ---- --}}
                                        <div class="tab-pane fade" id="tab-delivery" role="tabpanel">
                                            <div class="row">
                                                <div class="col-12 col-md-6 col-lg-4 mt-3">
                                                    <label class="mb-1"><i class="fas fa-id-card"></i> Fit Card</label>
                                                    <select name="fit_card" class="form-control select2">
                                                        <option value="">Any</option>
                                                        <option value="DONE" {{ old('fit_card', $collection->fit_card ?? '') == 'DONE' ? 'selected' : '' }}>DONE</option>
                                                        <option value="PENDING" {{ old('fit_card', $collection->fit_card ?? '') == 'PENDING' ? 'selected' : '' }}>PENDING</option>
                                                    </select>
                                                </div>
                                                <div class="col-12 col-md-6 col-lg-4 mt-3">
                                                    <label class="mb-1"><i class="fas fa-exchange-alt"></i> Hand Over to Visa Section</label>
                                                    <select name="hand_over_to_visa_section" class="form-control select2">
                                                        <option value="">Any</option>
                                                        <option value="DONE" {{ old('hand_over_to_visa_section', $collection->hand_over_to_visa_section ?? '') == 'DONE' ? 'selected' : '' }}>DONE</option>
                                                        <option value="PENDING" {{ old('hand_over_to_visa_section', $collection->hand_over_to_visa_section ?? '') == 'PENDING' ? 'selected' : '' }}>PENDING</option>
                                                    </select>
                                                </div>
                                                <div class="col-12 col-md-6 col-lg-4 mt-3">
                                                    <label class="mb-1"><i class="fas fa-truck"></i> Delivery</label>
                                                    <select name="delivery" class="form-control select2">
                                                        <option value="">Any</option>
                                                        <option value="DONE" {{ old('delivery', $collection->delivery ?? '') == 'DONE' ? 'selected' : '' }}>DONE</option>
                                                        <option value="PENDING" {{ old('delivery', $collection->delivery ?? '') == 'PENDING' ? 'selected' : '' }}>PENDING</option>
                                                    </select>
                                                </div>
                                                <div class="col-12 col-md-6 col-lg-4 mt-3">
                                                    <label class="mb-1"><i class="fas fa-calendar-day"></i> Date</label>
                                                    <input type="date" name="delivery_date" class="form-control"
                                                        value="{{ old('delivery_date', isset($collection->delivery_date) ? \Carbon\Carbon::parse($collection->delivery_date)->format('Y-m-d') : '') }}">
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    {{-- ===================== /SECTION TABS ===================== --}}

                                    <div class="mt-4">
                                        <button type="submit" class="btn btn-primary waves-effect waves-light me-1">
                                            <i class="fas fa-save"></i> {{ isset($collection) ? 'Update' : 'Submit' }}
                                        </button>
                                        <a href="{{ route('projects.collectionEntry') }}" class="btn btn-secondary waves-effect">
                                            <i class="fas fa-redo"></i> {{ isset($collection) ? 'Cancel' : 'Reset' }}
                                        </a>
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
                width: '100%'
            });
        });
    </script>
@endsection
