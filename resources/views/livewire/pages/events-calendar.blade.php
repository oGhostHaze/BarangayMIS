<div class="container card">
    <div id="calendar" class="card-body"></div>

    @push('scripts')
        <script type="module">
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
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
