<?php
/**
 * Template Name: Calendario de Contenidos
 * Template Post Type: page
 */
get_header();
?>

<div class="container mx-auto px-4 py-8">
    <h1 class="text-4xl font-bold text-gray-800 mb-8 text-center">🗓️ Calendario de Contenidos</h1>

    <div class="bg-white p-6 rounded-xl shadow-2xl">
        <!-- Controles del Calendario -->
        <div class="flex flex-wrap justify-between items-center mb-6 pb-4 border-b border-gray-200">
            <div class="flex items-center space-x-2 mb-4 sm:mb-0">
                <button id="prevMonthBtn" title="Mes Anterior" class="bg-indigo-500 hover:bg-indigo-600 text-white font-bold py-2 px-4 rounded-lg transition-colors duration-150">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                </button>
                <button id="nextMonthBtn" title="Mes Siguiente" class="bg-indigo-500 hover:bg-indigo-600 text-white font-bold py-2 px-4 rounded-lg transition-colors duration-150">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                    </svg>
                </button>
                 <button id="todayBtn" title="Hoy" class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold py-2 px-4 rounded-lg transition-colors duration-150 ml-2">Hoy</button>
            </div>
            <h2 id="currentMonthDisplay" class="text-2xl font-semibold text-indigo-700 order-first sm:order-none w-full sm:w-auto text-center mb-4 sm:mb-0">Febrero 2024</h2>
            <div class="flex items-center space-x-2">
                <!-- Podrían ir filtros aquí: Tipo de contenido, estado, etc. -->
                <select id="viewSelector" class="rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 p-2 text-sm">
                    <option value="month">Vista Mensual</option>
                    <option value="week" disabled>Vista Semanal (Próximamente)</option>
                </select>
            </div>
        </div>

        <!-- Calendario -->
        <div id="calendarGrid" class="grid grid-cols-7 gap-px border border-gray-200 bg-gray-200 rounded-lg overflow-hidden">
            <!-- Encabezados de días -->
            <div class="bg-gray-100 text-center font-semibold py-3 text-sm text-gray-600">LUN</div>
            <div class="bg-gray-100 text-center font-semibold py-3 text-sm text-gray-600">MAR</div>
            <div class="bg-gray-100 text-center font-semibold py-3 text-sm text-gray-600">MIÉ</div>
            <div class="bg-gray-100 text-center font-semibold py-3 text-sm text-gray-600">JUE</div>
            <div class="bg-gray-100 text-center font-semibold py-3 text-sm text-gray-600">VIE</div>
            <div class="bg-gray-100 text-center font-semibold py-3 text-sm text-gray-600">SÁB</div>
            <div class="bg-gray-100 text-center font-semibold py-3 text-sm text-gray-600">DOM</div>

            <?php
            // Simulación de días del mes para la estructura estática inicial.
            // JS poblará esto dinámicamente y manejará los eventos.
            $year = date('Y');
            $month = date('m');
            $days_in_month = cal_days_in_month(CAL_GREGORIAN, (int)$month, (int)$year);
            $first_day_of_month = date('N', strtotime("$year-$month-01")); // 1 (Mon) to 7 (Sun)
            $start_day_offset = $first_day_of_month - 1; // 0=Lun, ..., 6=Dom

            for ($i = 0; $i < $start_day_offset; $i++) {
                echo '<div class="bg-gray-50 p-2 h-32 min-h-[120px] overflow-y-auto"></div>'; // Celdas vacías
            }

            for ($day = 1; $day <= $days_in_month; $day++) {
                $is_today = (date('Y-m-d') == sprintf('%s-%s-%02d', $year, $month, $day));
                $day_class = $is_today ? 'bg-indigo-50' : 'bg-white';
                echo "<div class='{$day_class} p-2 h-32 min-h-[120px] overflow-y-auto relative group transition-all duration-150 hover:bg-sky-50'>";
                echo "<span class='text-sm font-medium " . ($is_today ? "text-indigo-600 font-bold" : "text-gray-700") . "'>{$day}</span>";
                echo "<div class='events-list mt-1 text-xs space-y-1' data-date='{$year}-{$month}-{$day}'>";
                // Eventos se cargarán aquí por JS
                if ($day == 5 && $month == date('m')) {
                     echo "<div class='bg-blue-500 text-white p-1.5 rounded-md truncate text-[11px] cursor-pointer hover:opacity-80' title='Ejemplo: Post Blog - Review Nuevas Zapatillas'>Post Blog - Review Nuevas Zapatillas</div>";
                }
                if ($day == 15 && $month == date('m')) {
                     echo "<div class='bg-green-500 text-white p-1.5 rounded-md truncate text-[11px] cursor-pointer hover:opacity-80' title='Ejemplo: Email - Newsletter Mensual'>Email - Newsletter Mensual</div>";
                }
                echo '</div>';
                // Botón para añadir evento (visible al hacer hover en la celda del día)
                echo "<button class='absolute top-1 right-1 bg-indigo-500 hover:bg-indigo-600 text-white w-5 h-5 rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-200 text-sm flex items-center justify-center' title='Añadir evento el día {$day}'>+</button>";
                echo '</div>';
            }

            $total_cells = $start_day_offset + $days_in_month;
            $remaining_cells = (7 - ($total_cells % 7)) % 7;
            for ($i = 0; $i < $remaining_cells; $i++) {
                 echo '<div class="bg-gray-50 p-2 h-32 min-h-[120px] overflow-y-auto"></div>'; // Celdas vacías
            }
            ?>
        </div>
        <div id="calendarLoadingState" class="text-center py-10 hidden">
            <p class="text-lg font-semibold text-indigo-600">Cargando eventos del calendario...</p>
            <svg class="animate-spin h-8 w-8 text-indigo-500 mx-auto mt-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
        </div>

        <!-- Modal o formulario para añadir/editar eventos (inicialmente oculto) -->
        <div id="eventModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
            <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
                <h3 class="text-lg font-medium leading-6 text-gray-900 mb-4" id="modalTitle">Añadir Nuevo Contenido</h3>
                <form id="eventForm">
                    <input type="hidden" id="eventDate" name="eventDate">
                    <div>
                        <label for="eventTitle" class="block text-sm font-medium text-gray-700">Título</label>
                        <input type="text" name="eventTitle" id="eventTitle" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm p-2">
                    </div>
                    <div class="mt-2">
                        <label for="eventType" class="block text-sm font-medium text-gray-700">Tipo</label>
                        <select name="eventType" id="eventType" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm p-2">
                            <option value="blog">Post de Blog</option>
                            <option value="social">Redes Sociales</option>
                            <option value="email">Email</option>
                            <option value="video">Video</option>
                            <option value="otro">Otro</option>
                        </select>
                    </div>
                    <div class="mt-4 flex justify-end space-x-2">
                        <button type="button" id="closeModalBtn" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300">Cancelar</option>
                        <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">Guardar</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>

<?php get_footer(); ?>
