// document.addEventListener("DOMContentLoaded", function() {
//     const salonSelect = document.getElementById('salonSelect');
//     const equipos = document.querySelectorAll('.eq');

//     salonSelect.addEventListener('change', function() {
//         const selectedSalonId = salonSelect.value;

//         equipos.forEach(equipo => {
//             const id = equipo.classList[1]; // Obtén el id del equipo
//             if (id === 'eq' + selectedSalonId) {
//                 equipo.style.display = 'block'; // Mostrar el equipo si coincide
//             } else {
//                 equipo.style.display = 'none'; // Ocultar los demás equipos
//             }
//         });
//     });

//     // Oculta todas las computadoras al principio
//     equipos.forEach(equipo => {
//         equipo.style.display = 'none';
//     });

//     // Muestra las del salón predeterminado (si lo hay)
//     const selectedSalonId = salonSelect.value;
//     equipos.forEach(equipo => {
//         const id = equipo.classList[1];
//         if (id === 'eq' + selectedSalonId) {
//             equipo.style.display = 'block';
//         }
//     });
// });
