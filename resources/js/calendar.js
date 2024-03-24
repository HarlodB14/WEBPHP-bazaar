import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import timeGridPlugin from '@fullcalendar/timegrid';
import listPlugin from '@fullcalendar/list';

document.addEventListener('DOMContentLoaded', function() {
    const calendarEl = document.getElementById("calendar");

    let calendar = new Calendar(calendarEl, {
        plugins: [ dayGridPlugin, timeGridPlugin, listPlugin ],
        initialView: 'listWeek',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'listWeek,listDay'
        },
        height: 'auto',
        buttonText: {
            listWeek: 'Week View',
            listDay: 'Day View'
        }
    });

    calendar.render();
});
