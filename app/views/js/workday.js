const btnWorkday = document.getElementById('btn-workday');

const workdayStart = document.getElementById('workday-start');
const workdayEnd = document.getElementById('workday-end');

let data = [];

btnWorkday.addEventListener('click', e => {
    e.preventDefault();
    let date = new Date();

    if (btnWorkday.value == 'start') {
        escribirFecha(date, workdayStart);
        workdayEnd.innerHTML = '--:--:--';
        botonIniciar();

        data.push([date.toLocaleDateString(), date.toLocaleTimeString()]);
        localStorage.setItem('workday', JSON.stringify(data));
    }
    else if (btnWorkday.value == 'stop') {
        escribirFecha(date, workdayEnd);
        botonFinalizar();

        // Enviar datos a php
        data = JSON.parse(localStorage.getItem('workday'));
        data.push([date.toLocaleDateString(), date.toLocaleTimeString()]);
        data = JSON.stringify(data);
        enviarDatos(data);
        localStorage.removeItem('workday');
     }
});

// Si entramos a la web y ya hemos fichado la entrada guardar la hora
document.addEventListener('DOMContentLoaded', () => {
    if (localStorage.getItem('workday')) {
        let date = JSON.parse(localStorage.getItem('workday'))[0];
        
        const [dateString, timeString] = date;
        const [day, month, year] = dateString.split('/');
        const [hour, minute, second] = timeString.split(':');
        const fechaStart = new Date(year, month - 1, day, hour, minute, second);
        
        escribirFecha(fechaStart, workdayStart);
        botonIniciar();

    }
})

function escribirFecha(date, html) {
        html.innerHTML = date.getHours().toString().padStart(2, '0') + ':' + date.getMinutes().toString().padStart(2, '0') +
                        ':' + date.getSeconds().toString().padStart(2, '0');
}

function botonIniciar() {
    btnWorkday.classList.remove('btn-success');
    btnWorkday.classList.add('btn-danger');
    
    btnWorkday.innerHTML = 'Finalizar';
    btnWorkday.value = 'stop';
}

function botonFinalizar() {
    btnWorkday.classList.remove('btn-danger');
    btnWorkday.classList.add('btn-success');

    btnWorkday.innerHTML = 'Iniciar';
    btnWorkday.value = 'start';
}


function enviarDatos(data) {
    
    const headers = new Headers();

    const config = {
        method: "post",
        headers: headers,
        mode: 'cors',
        cache: 'no-cache',
        body: data
    }

    // DA FALLO PORQUE ESTA ESPERANDO PASAR A JSON LA RESPUESTA EN PHP, PERO AUN NO ESTA IMPLEMENTADO EL PHP
    fetch('fichero.php', config)
        .then(respuesta => respuesta.json())
        .then(respuesta => {
            // Implementar que hacer con la respuesta, enviar alerta de success
        });
}