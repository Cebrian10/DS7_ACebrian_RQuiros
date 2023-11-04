document.addEventListener('DOMContentLoaded', function() {
    const equipos = document.querySelectorAll('.eq img');

    equipos.forEach(function(equipo) {
        equipo.addEventListener('click', function() {
            const equipoId = equipo.id.split('-')[1]; 
            const form = document.createElement('form');
            form.method = 'post';
            form.action = '?op=reserva';
            
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'equipo_id';
            input.value = equipoId;
            
            form.appendChild(input);
            document.body.appendChild(form);
            form.submit();
        });
    });
    
});

document.addEventListener('DOMContentLoaded', function() {
    let equipos = document.querySelectorAll('.eq');

    equipos.forEach(function(equipo) {
        // Verifica el texto dentro del párrafo para determinar el estado
        if (equipo.querySelector('p').innerText === 'disponible') {
            equipo.classList.add('available'); //si el equipo esta disponible, añande la clase 'avaible'
        } else {
            equipo.classList.add('occupied');//si no, añade la clase 'occupied'
        }
    });
});



