document.addEventListener("DOMContentLoaded", function () {
  var btnConstancias = document.getElementById("constancias");
  var btncierre = document.getElementById("cierre");
  var cuadroGrande = document.getElementById("cuadro-grande");

  btnConstancias.addEventListener("click", function () {
    cuadroGrande.classList.toggle("active");
  });

  btncierre.addEventListener("click", function () {
    cuadroGrande.classList.remove("active");
  });

  document.getElementById("contenido").addEventListener("click", function () {
    const table = document.getElementById("tablaDatos");

    // Texto de advertencia
    const warningText =
      "Advertencias y datos importantes a tener en cuenta:\n\n" +
      "Los tiempos y precios están sujetos a la disponibilidad del mecánico y del taller en el momento de la cita. " +
      "La página no garantiza la exactitud de esta información. " +
      "Gracias por utilizar nuestros servicios.\n\n";

    const upcomingAppointments = "Próximas citas:\n\n";

    const contentDiv = document.createElement("div");

    const warningParagraph = document.createElement("p");
    warningParagraph.textContent = warningText;
    warningParagraph.style.color = "#333333";
    warningParagraph.style.fontFamily = "Arial, sans-serif";
    warningParagraph.style.fontSize = "18px";
    contentDiv.appendChild(warningParagraph);

    const upcomingAppointmentsParagraph = document.createElement("p");
    upcomingAppointmentsParagraph.textContent = upcomingAppointments;
    upcomingAppointmentsParagraph.style.color = "#333333";
    upcomingAppointmentsParagraph.style.fontFamily = "Arial, sans-serif";
    upcomingAppointmentsParagraph.style.fontSize = "18px";
    contentDiv.appendChild(upcomingAppointmentsParagraph);

    // Agregar la tabla
    contentDiv.appendChild(table.cloneNode(true));

    // Generar el PDF con html2pdf
    html2pdf().from(contentDiv).save();
  });
});
