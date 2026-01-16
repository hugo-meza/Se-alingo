document.addEventListener('DOMContentLoaded', function () {
    const calificacion = document.getElementById('calificacion');
    const abejas = calificacion.querySelectorAll('.abeja');
    console.log(calif);
    resaltarAbejas(calif);
    abejas.forEach(function (abeja, index) {
        abeja.addEventListener('click', function () {
            resetearAbejas();
            const valor = this.getAttribute('data-valor');
            resaltarAbejas(valor);
        });

        abeja.addEventListener('mouseover', function () {
            const valor = this.getAttribute('data-valor');
            resetearAbejas();
            resaltarAbejas(valor);
        });
    });

    function resetearAbejas() {
        abejas.forEach(function (abeja) {
            abeja.classList.remove('active');
        });
    }

    function resaltarAbejas(valor) {
        for (let i = 0; i < valor; i++) {
            abejas[i].classList.add('active');
        }
    }
});

