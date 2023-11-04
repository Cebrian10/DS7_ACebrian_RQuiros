document.addEventListener("DOMContentLoaded", function () {
    const salonSelect = document.getElementById('salonSelect');
    const equipos = document.querySelectorAll('.eq');
    const lineas = document.querySelectorAll('.linea');

    salonSelect.addEventListener('change', function () {
        const selectedSalonId = salonSelect.value;

        // Ocultar todas las líneas al principio
        lineas.forEach(linea => {
            linea.style.display = 'none';
        });

        equipos.forEach(equipo => {
            const salonId = equipo.getAttribute('data-salon-id'); // Obtén el valor del atributo personalizado 'data-salon-id'
            if (salonId === selectedSalonId) {
                equipo.style.display = 'flex'; // Mostrar el equipo si coincide

                // Mostrar la línea que contiene el equipo
                const linea = equipo.closest('.linea');
                linea.style.display = 'flex';
            } else {
                equipo.style.display = 'none'; // Ocultar los demás equipos
            }
        });

    });

    // Ocultar todas las computadoras y líneas al principio
    equipos.forEach(equipo => {
        equipo.style.display = 'none';
    });

    lineas.forEach(linea => {
        linea.style.display = 'none';
    });

    // Mostrar las del salón predeterminado (si lo hay)
    const selectedSalonId = salonSelect.value;
    equipos.forEach(equipo => {
        const salonId = equipo.getAttribute('data-salon-id'); // Obtén el valor del atributo personalizado 'data-salon-id'
        if (salonId === selectedSalonId) {
            equipo.style.display = 'flex'; // Mostrar el equipo si coincide

            // Mostrar la línea que contiene el equipo
            const linea = equipo.closest('.linea');
            linea.style.display = 'flex';
        } else {
            equipo.style.display = 'none'; // Ocultar los demás equipos
        }
    });

});
