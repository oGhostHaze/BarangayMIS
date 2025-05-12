<div class="container card">
    <div id="calendar" class="card-body"></div>

    @push('scripts')
        <script type="module">
            document.addEventListener('livewire:initialized', function() {
                var calendarEl = document.getElementById('calendar');

                if (!calendarEl.hasAttribute('data-calendar-initialized')) {
                    var calendar = new FullCalendar.Calendar(calendarEl, {
                        initialView: 'dayGridMonth',
                        events: @json($events),

                        // Use eventDidMount to add custom HTML/popover instead of eventClick
                        eventDidMount: function(info) {
                            // Create a Tabler-styled tooltip/popover
                            var tooltip = new bootstrap.Tooltip(info.el, {
                                title: 'Event: ' + info.event.title,
                                placement: 'top',
                                trigger: 'click',
                                container: 'body',
                                html: true,
                                template: '<div class="tooltip" role="tooltip"><div class="tooltip-arrow"></div><div class="p-2 text-white tooltip-inner bg-primary"></div></div>'
                            });

                            // Add click handler to toggle a custom view
                            info.el.addEventListener('click', function(e) {
                                e.preventDefault();
                                e.stopPropagation();

                                // Optional: you could toggle a class to show more details
                                // within the existing calendar cell instead of using a tooltip
                                // info.el.classList.toggle('event-expanded');
                            });
                        },

                        // Add a custom button to close any expanded views (if needed)
                        headerToolbar: {
                            left: 'prev,next today',
                            center: 'title',
                            right: 'dayGridMonth,timeGridWeek,timeGridDay'
                        }
                    });

                    calendar.render();
                    calendarEl.setAttribute('data-calendar-initialized', 'true');
                }
            });
        </script>
    @endpush

    <!-- Add custom CSS for event styling -->
    @push('styles')
        <style>
            /* Style for event items */
            .fc-event {
                cursor: pointer;
                transition: all 0.2s ease;
            }

            /* Optional: Style for expanded events if you use that approach */
            .event-expanded {
                height: auto !important;
                z-index: 10;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            }

            /* Make tooltip larger and more prominent */
            .tooltip-inner {
                max-width: 300px;
                padding: 10px !important;
                text-align: left;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            }
        </style>
    @endpush
</div>
