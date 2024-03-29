import {Calendar} from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import listPlugin from '@fullcalendar/list';

document.addEventListener('DOMContentLoaded', function () {
    const calendarEl = document.getElementById("calendar");

    if (calendarEl) {
        calendarEl.classList.add('bg-gray-100', 'text-gray-800', 'p-4', 'rounded');
        let calendar = new Calendar(calendarEl, {
            plugins: [dayGridPlugin, listPlugin],
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
                let url = '/rentals/fetch'; // Default URL for fetching events

                if (window.location.pathname === '/advertisements/agenda') {
                    url = '/advertisements/fetch';
                }

                fetch(url)
                    .then(response => response.json())
                    .then(data => {
                        const events = data.map(event => {
                            if (event.start_date && event.return_date) {
                                // Rentals
                                return {
                                    title: event.title,
                                    start: event.start_date,
                                    end: event.return_date,
                                    isRental: true,
                                    displayEventTime: false
                                };
                            } else {
                                // Advertisements
                                return {
                                    title: event.title,
                                    start: event.created_at,
                                    end: event.expiration_date,
                                    isRental: false,
                                    displayEventTime: false
                                };
                            }
                        });
                        successCallback(events);
                    })
                    .catch(error => {
                        failureCallback(error);
                    });
            },
            // View content
            eventContent: function (arg) {
                let content = '<div>' +
                    '<strong>Title:</strong> ' + arg.event.title + '<br>';

                content += '<style>.fc-list-event-time { display: none; }</style>';

                // Rental
                if (arg.event.extendedProps && arg.event.extendedProps.isRental) {
                    content += '<strong>Start Date:</strong> ' + arg.event.start.toLocaleDateString() + '<br>' +
                        '<strong>Return Date:</strong> ' + arg.event.end.toLocaleDateString();
                } else {
                    // Advertisement
                    content += '<strong>Creation Date:</strong> ' + arg.event.start.toLocaleDateString() + '<br>' +
                        '<strong>Expiration Date:</strong> ' + arg.event.end.toLocaleDateString();
                }

                content += '</div>';

                return {
                    html: content
                };
            },
            eventDidMount: function (info) {
                const rootStyles = document.documentElement.style;
                rootStyles.setProperty('--fc-list-event-dot-width', '10px');
                rootStyles.setProperty('--fc-list-event-hover-bg-color', '#A9AFB9');
            }
        });
        calendar.render();
    }
});
