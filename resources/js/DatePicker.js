import DateRangePicker from 'flowbite-datepicker/Datepicker';

document.addEventListener('DOMContentLoaded', function() {
    const dateRangePickerEl = document.getElementById('dateRangePickerId');

    if (dateRangePickerEl) {
        new DateRangePicker(dateRangePickerEl, {
            // Specify your options here
        });
    }
});
