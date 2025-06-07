document.addEventListener('DOMContentLoaded', function() {
    const calendarGrid = document.getElementById('calendarGrid');
    const currentMonthDisplay = document.getElementById('currentMonthDisplay');
    const prevMonthBtn = document.getElementById('prevMonthBtn');
    const nextMonthBtn = document.getElementById('nextMonthBtn');
    const todayBtn = document.getElementById('todayBtn');
    const calendarLoadingState = document.getElementById('calendarLoadingState');

    // Modal elements (basic setup)
    const eventModal = document.getElementById('eventModal');
    const closeModalBtn = document.getElementById('closeModalBtn');
    const eventForm = document.getElementById('eventForm');
    const modalTitle = document.getElementById('modalTitle');
    const eventDateInput = document.getElementById('eventDate');

    let currentDate = new Date();

    const monthNames = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio",
                        "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];

    function renderCalendarGrid(year, month) {
        // month is 0-indexed (0 for January, 11 for December)
        currentMonthDisplay.textContent = `${monthNames[month]} ${year}`;

        // Clear existing day cells except headers
        const dayHeaders = calendarGrid.querySelectorAll('.grid > div:nth-child(-n+7)'); // Keep first 7 (headers)
        calendarGrid.innerHTML = ''; // Clear all
        dayHeaders.forEach(header => calendarGrid.appendChild(header.cloneNode(true))); // Add headers back

        const daysInMonth = new Date(year, month + 1, 0).getDate();
        const firstDayOfMonth = new Date(year, month, 1).getDay(); // 0 (Sun) to 6 (Sat)
        // Adjust to make Monday the first day (0 for Monday, 6 for Sunday)
        const startDayOffset = (firstDayOfMonth === 0) ? 6 : firstDayOfMonth - 1;

        // Add empty cells for days before the first of the month
        for (let i = 0; i < startDayOffset; i++) {
            calendarGrid.insertAdjacentHTML('beforeend', '<div class="bg-gray-50 p-2 h-32 min-h-[120px] overflow-y-auto"></div>');
        }

        // Add cells for each day of the month
        for (let day = 1; day <= daysInMonth; day++) {
            const dateStr = `${year}-${String(month + 1).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
            const isToday = new Date().toDateString() === new Date(year, month, day).toDateString();
            let dayCellHTML = `
                <div class="${isToday ? 'bg-indigo-50' : 'bg-white'} p-2 h-32 min-h-[120px] overflow-y-auto relative group transition-all duration-150 hover:bg-sky-50" data-date-full="${dateStr}">
                    <span class="text-sm font-medium ${isToday ? 'text-indigo-600 font-bold' : 'text-gray-700'}">${day}</span>
                    <div class="events-list mt-1 text-xs space-y-1" data-date="${dateStr}">
                        <!-- Events will be loaded here -->
                    </div>
                    <button class="add-event-btn absolute top-1 right-1 bg-indigo-500 hover:bg-indigo-600 text-white w-6 h-6 rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-200 text-sm flex items-center justify-center" title="Añadir evento el día ${day}" data-day="${day}" data-month="${month+1}" data-year="${year}">+</button>
                </div>`;
            calendarGrid.insertAdjacentHTML('beforeend', dayCellHTML);
        }

        // Add empty cells for days after the end of the month to complete the grid
        const totalCells = startDayOffset + daysInMonth;
        const remainingCells = (7 - (totalCells % 7)) % 7;
        if (remainingCells > 0) {
            for (let i = 0; i < remainingCells; i++) {
                calendarGrid.insertAdjacentHTML('beforeend', '<div class="bg-gray-50 p-2 h-32 min-h-[120px] overflow-y-auto"></div>');
            }
        }
        attachEventListenersToDayCells();
    }

    function attachEventListenersToDayCells() {
        document.querySelectorAll('.add-event-btn').forEach(button => {
            button.addEventListener('click', function() {
                const day = this.dataset.day;
                const month = this.dataset.month; // Month is 1-indexed from dataset
                const year = this.dataset.year;
                const fullDate = `${year}-${String(month).padStart(2,'0')}-${String(day).padStart(2,'0')}`;

                modalTitle.textContent = `Añadir Contenido para el ${day}/${month}/${year}`;
                eventDateInput.value = fullDate;
                eventForm.reset(); // Clear previous form data
                eventModal.classList.remove('hidden');
            });
        });
    }

    function showLoadingState(isLoading) {
        calendarLoadingState.classList.toggle('hidden', !isLoading);
    }

    function fetchEventsForMonth(year, month_actual) { // month_actual is 1-indexed (1 for Jan, 12 for Dec)
        showLoadingState(true);
        document.querySelectorAll('#calendarGrid .events-list').forEach(list => list.innerHTML = ''); // Clear previous events

        // Adaptación para AJAX (Paso 3)
        console.log('Preparado para llamar a AJAX para cargar eventos del calendario:');
        if (typeof jacoboCalendar !== 'undefined') { // Check if localized object exists
            console.log('URL:', jacoboCalendar.ajax_url);
            console.log('Nonce:', jacoboCalendar.nonce);
            console.log('Acción:', jacoboCalendar.load_events_action);
            console.log('Datos a enviar (ejemplo):', { year: year, month: month_actual });
             // Aquí iría la llamada fetch() o $.ajax()
        } else {
            console.error('jacoboCalendar no está definido. Asegúrate de que wp_localize_script funciona correctamente.');
        }

        // Mantener la simulación visual con setTimeout por ahora
        setTimeout(() => {
            const sampleEvents = { // Sample events keyed by YYYY-MM-DD
                [`${year}-${String(month_actual).padStart(2, '0')}-05`]: [{ title: 'Post Simulado: Review Zapatillas', type: 'blog' }],
                [`${year}-${String(month_actual).padStart(2, '0')}-12`]: [
                    { title: 'Email Simulado: Nuevo Descuento', type: 'email' },
                    { title: 'Tweet Simulado: #OfertaEspecial', type: 'social' }
                ],
                [`${year}-${String(month_actual).padStart(2, '0')}-20`]: [{ title: 'Video Simulado: Unboxing Producto X', type: 'video' }],
            };

            for (const dateKey in sampleEvents) {
                if (sampleEvents.hasOwnProperty(dateKey)) {
                    const eventsOnDate = sampleEvents[dateKey];
                    const eventCell = calendarGrid.querySelector(`.events-list[data-date='${dateKey}']`);
                    if (eventCell) {
                        eventsOnDate.forEach(event => {
                            const eventDiv = document.createElement('div');
                            let bgColor = 'bg-purple-500'; // Default
                            if (event.type === 'blog') bgColor = 'bg-blue-500';
                            else if (event.type === 'email') bgColor = 'bg-green-500';
                            else if (event.type === 'social') bgColor = 'bg-teal-500';
                            else if (event.type === 'video') bgColor = 'bg-red-500';
                            eventDiv.className = `p-1.5 rounded-md text-white text-[11px] cursor-pointer hover:opacity-80 truncate ${bgColor}`;
                            eventDiv.textContent = event.title;
                            eventDiv.title = event.title;
                            eventCell.appendChild(eventDiv);
                        });
                    }
                }
            }
            showLoadingState(false);
        }, 1200);
    }

    function updateCalendar() {
        const year = currentDate.getFullYear();
        const month = currentDate.getMonth(); // 0-indexed
        renderCalendarGrid(year, month);
        fetchEventsForMonth(year, month + 1); // month + 1 for 1-indexed month for API/logic
    }

    if (prevMonthBtn) {
        prevMonthBtn.addEventListener('click', () => {
            currentDate.setMonth(currentDate.getMonth() - 1);
            updateCalendar();
        });
    }

    if (nextMonthBtn) {
        nextMonthBtn.addEventListener('click', () => {
            currentDate.setMonth(currentDate.getMonth() + 1);
            updateCalendar();
        });
    }

    if (todayBtn) {
        todayBtn.addEventListener('click', () => {
            currentDate = new Date(); // Reset to today
            updateCalendar();
        });
    }

    // Modal listeners
    if (closeModalBtn) {
        closeModalBtn.addEventListener('click', () => {
            eventModal.classList.add('hidden');
        });
    }

    if (eventForm) {
        eventForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const title = document.getElementById('eventTitle').value;
            const type = document.getElementById('eventType').value;
            const date = document.getElementById('eventDate').value; // YYYY-MM-DD
            const eventData = { title, type, date };

            // Adaptación para AJAX (Paso 3)
            console.log('Preparado para llamar a AJAX para guardar evento:');
            if (typeof jacoboCalendar !== 'undefined') {
                console.log('URL:', jacoboCalendar.ajax_url);
                console.log('Nonce:', jacoboCalendar.nonce);
                console.log('Acción:', jacoboCalendar.save_event_action);
                console.log('Datos del evento:', eventData);
                // Aquí iría la llamada fetch() o $.ajax()
            } else {
                console.error('jacoboCalendar no está definido.');
            }

            // Mantener simulación visual por ahora
            console.log('Evento Guardado (simulado en UI):', eventData);
            const eventCell = calendarGrid.querySelector(`.events-list[data-date='${date}']`);
            if (eventCell) {
                let bgColor = 'bg-purple-500';
                if (type === 'blog') bgColor = 'bg-blue-500';
                else if (type === 'email') bgColor = 'bg-green-500';
                else if (type === 'social') bgColor = 'bg-teal-500';
                else if (type === 'video') bgColor = 'bg-red-500';
                eventCell.insertAdjacentHTML('beforeend', `<div class="p-1.5 rounded-md text-white text-[11px] cursor-pointer hover:opacity-80 truncate ${bgColor}" title="${title}">${title}</div>`);
            }
            eventModal.classList.add('hidden');
        });
    }

    // Initial Render
    if (calendarGrid && currentMonthDisplay) { // Ensure we are on the calendar page
         updateCalendar();
    }
});
