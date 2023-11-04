function actualizarReloj() {
    const reloj = document.getElementById('reloj');
    const horas = document.getElementById('horas');
    const minutos = document.getElementById('minutos');
    const segundos = document.getElementById('segundos');
    
    const now = new Date();
    const hh = String(now.getHours()).padStart(2, '0');
    const mm = String(now.getMinutes()).padStart(2, '0');
    const ss = String(now.getSeconds()).padStart(2, '0');
    
    horas.textContent = hh;
    minutos.textContent = mm;
    segundos.textContent = ss;
  
    setTimeout(actualizarReloj, 1000);
  }
  
  document.addEventListener('DOMContentLoaded', function() {
    actualizarReloj();
  });
  