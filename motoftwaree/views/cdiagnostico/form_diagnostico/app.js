document.addEventListener("DOMContentLoaded", function () {
  const preguntas = [
    {
      pregunta:
        "¿Hace cuanto no le hace un mantenimiento Preventivo a su moto?",
      opciones: [
        "Hace 6 meses",
        "Desde que la compré",
        "Hace dos años",
        "Hace tres meses",
      ],
    },
    {
      pregunta: "¿Cada cuanto le cambia el Aceite a su moto?",
      opciones: ["Cada 3.000 Km", "Cada 2.8000km", "Cada 3.2000km"],
    },
    {
      pregunta: "¿Cada cuanto le cambia la batería a su Moto?",
      opciones: [
        "Cada año",
        "Cada dos años y medio",
        "Cada dos años",
        "Cada tres años",
      ],
    },
    {
      pregunta:
        "¿Cuándo fue la última vez que le hizo un cambio de Disco de freno a su moto?",
      opciones: ["Hace 8 meses", "Hace 12 meses", "Hace 24 meses"],
    },
    {
      pregunta:
        "¿Ha tenido alguna colisión o accidente reciente con su motocicleta?",
      opciones: ["Si", "No"],
    },
    {
      pregunta:
        "¿Cuando enciende el switch de su moto a esta le enciende el tablero?",
      opciones: ["Si", "No"],
    },
    {
      pregunta:
        "¿Si la moto está encendida siente algún sonido raro en el motor?",
      opciones: ["Si", "No"],
    },
    {
      pregunta: "¿Cada cuanto le cambia las pastas del Clutch a su moto?",
      opciones: [
        "Cada cuatro meses",
        "Cada cinco meses",
        "Cada seis meses",
        "Más tiempo",
      ],
    },
    {
      pregunta: "¿La moto es de concesionario o de segunda?",
      opciones: ["Concesionario", "Segunda"],
    },
    {
      pregunta: "¿Qué tanto hace uso de su moto?",
      opciones: ["Diario", "Frecuentemente", "Ocasionalmente", "Muy poco uso"],
    },
  ];

  const formPage1 = document.getElementById("form-page1");
  const formPage2 = document.getElementById("form-page2");

  // Función para ocultar página 1 y mostrar página 2
  function mostrarPagina2() {
    formPage1.style.display = "none";
    formPage2.style.display = "block";
  }

  function mostrarPagina1() {
    formPage1.style.display = "block";
    formPage2.style.display = "none";
  }

  //mostramos la primera pagina con sus preguntas
  preguntas.slice(0, 5).forEach((pregunta, index) => {
    const divPregunta = document.createElement("div");
    const labelPregunta = document.createElement("label");
    labelPregunta.textContent = pregunta.pregunta;
    const selectRespuesta = document.createElement("select");
    selectRespuesta.name = `q${index + 1}`;
    pregunta.opciones.forEach((opcion) => {
      const option = document.createElement("option");
      option.value = opcion;
      option.textContent = opcion;
      selectRespuesta.appendChild(option);
    });
    divPregunta.appendChild(labelPregunta);
    divPregunta.appendChild(selectRespuesta);
    formPage1.appendChild(divPregunta);
  });

  // mostramos la segunda pagina
  preguntas.slice(5).forEach((pregunta, index) => {
    const divPregunta = document.createElement("div");
    const labelPregunta = document.createElement("label");
    labelPregunta.textContent = pregunta.pregunta;
    const selectRespuesta = document.createElement("select");
    selectRespuesta.name = `q${index + 6}`;
    pregunta.opciones.forEach((opcion) => {
      const option = document.createElement("option");
      option.value = opcion;
      option.textContent = opcion;
      selectRespuesta.appendChild(option);
    });
    divPregunta.appendChild(labelPregunta);
    divPregunta.appendChild(selectRespuesta);
    formPage2.appendChild(divPregunta);
  });

  // evento al boton siguiente
  const nextPageBtn = document.getElementById("next-page-btn");
  nextPageBtn.addEventListener("click", function () {
    mostrarPagina2();
  });

  const antPageBtn = document.getElementById("atras-page-btn");
  antPageBtn.addEventListener("click", function () {
    console.log("Estamos clikeadno");
    mostrarPagina1();
  });

  // evento al boton enviar datos
  const submitBtn = document.getElementById("submit-btn");
  submitBtn.addEventListener("click", function () {
    // manejamos la respuestas
    const respuestas = {};
    preguntas.forEach((pregunta, index) => {
      const selectRespuesta = document.querySelector(
        `select[name='q${index + 1}']`
      );
      respuestas[pregunta.pregunta] = selectRespuesta.value;
    });

    // Mostramos las respuestas en la consola como prueba
    console.log(respuestas);

    // redirigimos a resultado html con las respuestas y la opcion descargar contenido
    window.location.href = `resultado.html?${new URLSearchParams(
      respuestas
    ).toString()}`;
  });
});
