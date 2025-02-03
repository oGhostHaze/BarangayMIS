<div>
    <div id="calendar"></div>

    @push('scripts')
        <script type="module">
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                plugins: [dayGridPlugin, timeGridPlugin, interactionPlugin],
                initialView: 'dayGridMonth',
                events: @json($events),
                eventClick: function(info) {
                    alert('Event: ' + info.event.title);
                },
            });

            calendar.render();
        </script>
    @endpush
</div>
