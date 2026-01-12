<div class="card border-0 mb-4 d-none d-lg-block">

    {{-- Header --}}
    <div class="card-header bg-white border-0 py-3 ps-2 pe-0 d-flex justify-content-between align-items-center">
        {{-- Total Row Count --}}
        <div class="small text-muted">{{ $totalEntityCount }} {{ $entityName }}</div>
        {{-- Search Input --}}
        <input type="text" class="form-control form-control-sm" placeholder="{{ $placeHolder }}" style="max-width: 220px;" aria-label="{{ $placeHolder }}">
    </div>

    {{-- Table --}}
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="small text-muted">
                    <tr class="text-uppercase fw-semibold">
                        {{ $thead }}
                    </tr>
                </thead>
                <tbody>
                    {{ $tbody }}
                </tbody>
            </table>
        </div>
    </div>

</div>