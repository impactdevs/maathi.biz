@extends('layouts.pages.index')
@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Application Logs</h1>
    <p class="mb-4">This section will show a list of activities taking place in this application.</p>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Logs</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>User</th>
                            <th>Event</th>
                            <th>Model</th>
                            <th>Old Data</th>
                            <th>New Data</th>
                            <th>IP Address</th>
                            <th>Timestamp</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($logs as $log)
                            <tr>
                                <td>{{ $log->user->name ?? 'Unknown' }}</td>
                                <td>{{ ucfirst($log->event) }}</td>
                                <td>{{ $log->model }}</td>
                                <td>
                                    @if (!empty($log->old_data))
                                        <div>
                                            @foreach (json_decode($log->old_data, true) as $key => $value)
                                                <span><strong>{{ ucfirst($key) }}:</strong> {{ is_array($value) ? implode(', ', $value) : $value }}</span>,
                                            @endforeach
                                        </div>
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td>
                                    @if (!empty($log->new_data))
                                        <div>
                                            @foreach (json_decode($log->new_data, true) as $key => $value)
                                                <span class="ms-1"><strong>{{ ucfirst($key) }}:</strong> {{ is_array($value) ? implode(', ', $value) : $value }}</span>,
                                            @endforeach
                                        </div>
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td>{{ $log->ip_address ?? 'N/A' }}</td>
                                <td>{{ $log->created_at->format('F j, Y, g:i A') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <!-- Page level plugins -->
    <script src="{{ asset('assets/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('assets/js/demo/datatables-demo.js') }}"></script>
@endpush
