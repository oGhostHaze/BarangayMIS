<div class="mt-4 container-fluid">
    <div class="shadow card">
        <div class="card-header">
            <h4>Issued Certificates</h4>
        </div>

        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Resident</th>
                        <th>Certificate Type</th>
                        <th>Purpose</th>
                        <th>Status</th>
                        <th>Approved At</th>
                        <th>Released At</th>
                        <th>Processed By</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($issuedRequests as $request)
                        <tr>
                            <td>{{ $request->resident->first_name }} {{ $request->resident->last_name }}</td>
                            <td>{{ $request->certificate_type }}</td>
                            <td>{{ $request->purpose }}</td>
                            <td><span
                                    class="badge text-white bg-{{ $request->status == 'Released' ? 'success' : 'warning' }}">{{ $request->status }}</span>
                            </td>
                            <td>{{ $request->approved_at ? $request->approved_at->format('M d, Y') : '-' }}</td>
                            <td>{{ $request->released_at ? $request->released_at->format('M d, Y') : '-' }}</td>
                            <td>{{ $request->processedBy ? $request->processedBy->name : 'N/A' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div>{{ $issuedRequests->links() }}</div>
        </div>
    </div>
</div>
