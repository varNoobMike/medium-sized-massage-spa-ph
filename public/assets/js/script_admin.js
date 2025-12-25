pass_data_spa_weekly_schedule_modal()


/* --------------------------------------------------------------------------------------- */
function pass_data_spa_weekly_schedule_modal() {
    document.addEventListener('DOMContentLoaded', function () {
        const editModal = document.getElementById('spa-weekly-schedule-edit-modal');

        editModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;

            const dayOfWeek = button.getAttribute('data-dow');
            const openTime = button.getAttribute('data-ot');
            const closeTime = button.getAttribute('data-ct');

            document.querySelector(`[name="day_of_week"] option[value=${dayOfWeek}]`).selected = true;
            document.querySelector('[name="open_time"]').value = openTime;
            document.querySelector('[name="close_time"]').value = closeTime;

        });

    });
}