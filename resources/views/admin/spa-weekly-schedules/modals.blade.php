{{-- Create Time Slot Modal --}}
<div id="spa-weekly-schedule-create-modal" class="modal fade" tabindex="-1" aria-hidden="true"
    @hidden.bs.modal="
        form.schedule_id = null;
        form.day_of_week = '';
        form.start_time = '';
        form.end_time = '';
    ">
    <div class="modal-dialog">
        <div class="modal-content rounded-3">
            <div class="modal-header bg-light">
                <h5 class="modal-title fw-semibold">
                    <i class="bi bi-plus-lg me-2"></i>Create Time Slot
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">

                <form :action="`{{ url('admin/spa-weekly-schedules') }}`" method="POST"
                    @submit.prevent="
                        if (loading) return;
                        loading = true;
                        $el.submit();
                    ">
                    @csrf

                    {{-- Day of Week --}}
                    <div class="mb-3">
                        <label class="form-label small">Day of Week</label>
                        <input type="text" readonly class="form-control rounded-3 small" x-model="form.day_of_week" name="day_of_week">
                    </div>

                    {{-- Start Time --}}
                    <div class="mb-3">
                        <label class="form-label small">Start Time</label>
                        <input type="time" class="form-control rounded-3 small" name="start_time" x-model="form.start_time">
                    </div>

                    {{-- End Time --}}
                    <div class="mb-3">
                        <label class="form-label small">End Time</label>
                        <input type="time" class="form-control rounded-3 small" name="end_time" x-model="form.end_time">
                    </div>

                    {{-- Submit --}}
                    <button type="submit" class="btn btn-primary w-100 rounded-3" :disabled="loading">
                        <span x-show="!loading">Save</span>
                        <span x-show="loading" class="spinner-border spinner-border-sm ms-2"></span>
                    </button>
                </form>

            </div>
        </div>
    </div>
</div>

{{-- Edit Time Slot Modal --}}
<div id="spa-weekly-schedule-edit-modal" class="modal fade" tabindex="-1" aria-hidden="true"
    @hidden.bs.modal="
        form.schedule_id = null;
        form.day_of_week = '';
        form.start_time = '';
        form.end_time = '';
    ">
    <div class="modal-dialog">
        <div class="modal-content rounded-3">
            <div class="modal-header bg-light">
                <h5 class="modal-title fw-semibold">
                    <i class="bi bi-pencil me-2"></i>Edit Time Slot
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">

                <form :action="`{{ url('admin/spa-weekly-schedules') }}/${form.schedule_id}`" method="POST"
                    @submit.prevent="
                        if (loading) return;
                        loading = true;
                        $el.submit();
                    ">
                    @csrf
                    @method('PUT')

                    {{-- Day of Week --}}
                    <div class="mb-3">
                        <label class="form-label small">Day of Week</label>
                        <input type="text" readonly class="form-control rounded-3 small" x-model="form.day_of_week" name="day_of_week">
                    </div>

                    {{-- Start Time --}}
                    <div class="mb-3">
                        <label class="form-label small">Start Time</label>
                        <input type="time" class="form-control rounded-3 small" x-model="form.start_time" name="start_time">
                    </div>

                    {{-- End Time --}}
                    <div class="mb-3">
                        <label class="form-label small">End Time</label>
                        <input type="time" class="form-control rounded-3 small" x-model="form.end_time" name="end_time">
                    </div>

                    {{-- Submit --}}
                    <button type="submit" class="btn btn-primary w-100 rounded-3" :disabled="loading">
                        <span x-show="!loading">Save</span>
                        <span x-show="loading" class="spinner-border spinner-border-sm ms-2"></span>
                    </button>
                </form>

            </div>
        </div>
    </div>
</div>
