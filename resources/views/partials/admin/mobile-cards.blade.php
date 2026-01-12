<div class="d-lg-none">
@forelse ($clients as $client)
    <div class="card shadow-sm rounded-3 mb-3">
        <div class="card-body p-3">
            <div class="d-flex justify-content-between align-items-start mb-2">
                <div class="fw-semibold text-dark small">{{ $client->name }}</div>

                <div class="dropdown position-relative">
                    <button class="btn btn-sm btn-light border rounded-3" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="bi bi-three-dots"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 rounded-3">
                        <li>
                            <a href="#" class="dropdown-item small">
                                <i class="bi bi-eye me-2"></i>View
                            </a>
                        </li>
                        @if(!$client->email_verified_at)
                            <li>
                                <form action="#" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="dropdown-item text-success small"
                                        onclick="return confirm('Approve this client?');">
                                        <i class="bi bi-check-circle me-2"></i>Approve
                                    </button>
                                </form>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>

            <div class="small text-muted mb-1">Email</div>
            <div class="small mb-2">{{ $client->email }}</div>

            <div>
                @if ($client->email_verified_at)
                    <span class="badge bg-success-subtle text-success small">Verified</span>
                @else
                    <span class="badge bg-secondary-subtle text-muted small">Unverified</span>
                @endif
            </div>
        </div>
    </div>
@empty
    <div class="text-center text-muted py-5 small">
        <i class="bi bi-people fs-4 d-block mb-2"></i>
        No clients found
        <div class="mt-1">Clients will appear here once they register.</div>
    </div>
@endforelse
</div>

@endsection
