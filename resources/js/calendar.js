import {Calendar} from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import timeGridPlugin from '@fullcalendar/timegrid';
import listPlugin from '@fullcalendar/list';

document.addEventListener('DOMContentLoaded', function () {
    const calendarEl = document.getElementById("calendar");

    if (calendarEl) {
        calendarEl.classList.add('bg-gray-100', 'text-gray-800', 'p-4', 'rounded');
        let calendar = new Calendar(calendarEl, {
            plugins: [dayGridPlugin, timeGridPlugin, listPlugin],
            initialView: 'listWeek',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'listWeek,listDay'
            },
            height: 'auto',
            allDayText: '',
            buttonText: {
                listWeek: 'Week View',
                listDay: 'Day View'

            },
            events: function (fetchInfo, successCallback, failureCallback) {
                fetch('/rentals/fetch')
                    .then(response => response.json())
                    .then(data => {
                        const events = data.map(event => ({
                            title: event.title,
                            start: event.start_date,
                            end: event.return_date
                        }));
                        console.log('Fetched Events:', events);
                        successCallback(events);
                    })
                    .catch(error => {
                        failureCallback(error);
                    });
            },
            eventContent: function (arg) {
                return {
                    html: '<div>' +
                        '<strong>Title:</strong> ' + arg.event.title + '<br>' +
                        '<strong>Start Date:</strong> ' + arg.event.start.toLocaleDateString() + '<br>' +
                        '<strong>End Date:</strong> ' + arg.event.end.toLocaleDateString() +
                        '</div>'
                };
            },
            eventDidMount: function (info) {
            }
        });

        calendar.setOption('eventDidMount', function (info) {
            const rootStyles = document.documentElement.style;
            rootStyles.setProperty('--fc-list-event-dot-width', '10px');
            rootStyles.setProperty('--fc-list-event-hover-bg-color', '#A9AFB9'); // Change to your desired hover background color
        });
        calendar.render();
    }
});
