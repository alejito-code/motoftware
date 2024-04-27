

document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
  
    var calendar = new FullCalendar.Calendar(calendarEl, {
      plugins: ['dayGrid'],
      locale: 'es',
      dateClick: function(info) {
        var today = new Date();
        if (info.date < today) {
          alert('No puedes agendar citas en fechas pasadas.');
        } else {
          // Aquí puedes abrir un formulario para agendar la cita en la fecha seleccionada
          alert('Agendar cita el ' + info.dateStr);
        }
      }
    });
  
    calendar.render();
  });
  