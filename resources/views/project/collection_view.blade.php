@extends('layouts.app')
@section('title', 'Collection View')
@section('style')
    <style>
        #datatable th, #datatable td {
            white-space: nowrap;
            font-size: 12px;
            vertical-align: middle;
        }
        #datatable thead tr:first-child th {
            text-align: center;
            background-color: #aef3de;
            color: black;
            font-weight: 600;
        }
        #datatable thead tr:last-child th {
            background-color: #38f1ba;
            color: #333;
            text-align: center;
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
                                    <h4>Collection View - {{ $project->project_name }}</h4>
                                    <div>
                                        <a href="{{ route('projects.collectionExport', $project->id) }}" class="btn btn-success">
                                            <i class="fas fa-file-excel"></i> Export Excel
                                        </a>
                                        <a href="{{ route('projects.collectionEntry') }}" class="btn btn-info">
                                            <i class="fas fa-plus"></i> Collection Entry
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="datatable" class="table table-sm table-bordered table-striped"
                                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                            {{-- Grouped section header row --}}
                                            <tr>
                                                <th rowspan="2">SL</th>
                                                <th colspan="14">PASSPORT COLLECTION (INTERVIEW)</th>
                                                <th colspan="5">PASSPORT ENTRY, READY</th>
                                                <th colspan="3">MOFA SECTION</th>
                                                <th colspan="6">VISA MANAGEMENT</th>
                                                <th colspan="1">EMB. SEC.</th>
                                                <th colspan="3">MANPOWER</th>
                                                <th colspan="2">FLIGHT</th>
                                                <th colspan="4">DELIVERY SECTION</th>
                                                <th rowspan="2">ACTION</th>
                                            </tr>
                                            {{-- Column header row --}}
                                            <tr>
                                                <th>DATE</th>
                                                <th>NAME</th>
                                                <th>PP NO</th>
                                                <th>AGE</th>
                                                <th>PHONE NO</th>
                                                <th>AGENT NAME</th>
                                                <th>STATUS</th>
                                                <th>CATEGORY</th>
                                                <th>MEDICAL</th>
                                                <th>TAKAMUL</th>
                                                <th>PC</th>
                                                <th>DL</th>
                                                <th>Final Status</th>
                                                <th>Company</th>
                                                <th>S. ENTRY</th>
                                                <th>DATE</th>
                                                <th>PIC</th>
                                                <th>TASHEER</th>
                                                <th>FINAL STATUS</th>
                                                <th>MOFA DATE</th>
                                                <th>MOFA STATUS</th>
                                                <th>COMMENTS</th>
                                                <th>F. COMPANY NAME</th>
                                                <th>SENT FOR MOFA/AGENCY</th>
                                                <th>OCCUPATION</th>
                                                <th>VISA INPORT</th>
                                                <th>STATUS IN VISA SECTION</th>
                                                <th>EMBASSY HANDOVER DATE &amp; TIME</th>
                                                <th>STAMPING</th>
                                                <th>TRAINING</th>
                                                <th>FINGER</th>
                                                <th>MAN. P.</th>
                                                <th>F. DATE</th>
                                                <th>EXP. DATE</th>
                                                <th>FIT CARD</th>
                                                <th>HAND OVER TO VISA SECTION</th>
                                                <th>DELIVERY</th>
                                                <th>DATE</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($collections as $index => $collection)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ $collection->interview_date_from ? \Carbon\Carbon::parse($collection->interview_date_from)->format('d-M-Y') : '' }}</td>
                                                    <td>{{ $collection->name }}</td>
                                                    <td>{{ $collection->pp_no }}</td>
                                                    <td>{{ $collection->age }}</td>
                                                    <td>{{ $collection->phone_no }}</td>
                                                    <td>{{ $collection->agency->name ?? '' }}</td>
                                                    <td>{{ $collection->status }}</td>
                                                    <td>{{ $collection->category_info->name ?? '' }}</td>
                                                    <td>{{ $collection->medical }}</td>
                                                    <td>{{ $collection->takamul }}</td>
                                                    <td>{{ $collection->pc }}</td>
                                                    <td>{{ $collection->dl }}</td>
                                                    <td>{{ $collection->final_status->name ?? '' }}</td>
                                                    <td>{{ $collection->company->name ?? '' }}</td>

                                                    <td>{{ $collection->s_entry }}</td>
                                                    <td>{{ $collection->entry_date ? \Carbon\Carbon::parse($collection->entry_date)->format('d-M-Y') : '' }}</td>
                                                    <td>{{ $collection->pic }}</td>
                                                    <td>{{ $collection->tasheer }}</td>
                                                    <td>{{ $collection->final_status->name ?? '' }}</td>

                                                    <td>{{ $collection->mofa_date ? \Carbon\Carbon::parse($collection->mofa_date)->format('d-M-Y') : '' }}</td>
                                                    <td>{{ $collection->mofa_status }}</td>
                                                    <td>{{ $collection->comments }}</td>

                                                    <td>{{ $collection->fcompany->name ?? '' }}</td>
                                                    <td>{{ $collection->sent_for_mofa_agency }}</td>
                                                    <td>{{ $collection->occupation }}</td>
                                                    <td>{{ $collection->visa_inport }}</td>
                                                    <td>{{ $collection->status_in_visa_section }}</td>
                                                    <td>{{ $collection->embassy_handover ? \Carbon\Carbon::parse($collection->embassy_handover)->format('d-M-Y h:i A') : '' }}</td>

                                                    <td>{{ $collection->stamping }}</td>

                                                    <td>{{ $collection->training }}</td>
                                                    <td>{{ $collection->finger }}</td>
                                                    <td>{{ $collection->man_p }}</td>

                                                    <td>{{ $collection->f_date_from ? \Carbon\Carbon::parse($collection->f_date_from)->format('d-M-Y') : '' }}</td>
                                                    <td>{{ $collection->exp_date ? \Carbon\Carbon::parse($collection->exp_date)->format('d-M-Y') : '' }}</td>

                                                    <td>{{ $collection->fit_card }}</td>
                                                    <td>{{ $collection->hand_over_to_visa_section }}</td>
                                                    <td>{{ $collection->delivery }}</td>
                                                    <td>{{ $collection->delivery_date ? \Carbon\Carbon::parse($collection->delivery_date)->format('d-M-Y') : '' }}</td>

                                                    <td>
                                                        <a href="{{ route('projects.collectionEntry.edit', $collection->id) }}" class="btn btn-sm btn-warning" title="Edit">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <form action="{{ route('projects.collectionEntry.destroy', $collection->id) }}" method="POST" class="d-inline" onsubmit="return confirm('আপনি কি নিশ্চিত এই রেকর্ড মুছে ফেলতে চান?');">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-danger" title="Delete">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="37" class="text-center">No records found.</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>

    </script>
@endsection
