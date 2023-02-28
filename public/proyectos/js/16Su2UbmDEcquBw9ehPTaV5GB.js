// VARIABLES
const textoInput = document.getElementById("input");
const contadorCaracteres = document.getElementById("texto");

const maximoCaracteres = 250;

// PROGRAMA
contadorCaracteres.innerHTML = `${textoInput.value.length}/${maximoCaracteres}`;
textoInput.addEventListener("input", function () {
    const longitudTexto = textoInput.value.length;
    contadorCaracteres.textContent = `${longitudTexto}/${maximoCaracteres}`;

    if (longitudTexto >= maximoCaracteres-1) {
        textoInput.value = textoInput.value.slice(0, maximoCaracteres-1);
    }
});