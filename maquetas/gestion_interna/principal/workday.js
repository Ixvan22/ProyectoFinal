const btnWorkday = document.getElementById('btn-workday');

let data = [];

btnWorkday.addEventListener('click', e => {
    e.preventDefault();
    let date = new Date();

    if (btnWorkday.value == 'start') {
        btnWorkday.classList.remove('btn-success');
        btnWorkday.classList.add('btn-danger');
        
        btnWorkday.innerHTML = 'Finalizar';
        btnWorkday.value = 'stop';

        data.push([date.toLocaleDateString(), date.toLocaleTimeString()]);
        localStorage.setItem('workday', JSON.stringify(data));
    }
    else if (btnWorkday.value == 'stop') {
        btnWorkday.classList.remove('btn-danger');
        btnWorkday.classList.add('btn-success');

        btnWorkday.innerHTML = 'Iniciar';
        btnWorkday.value = 'start';

        // Enviar datos a php
        data = JSON.parse(localStorage.getItem('workday'));
        data.push([date.toLocaleDateString(), date.toLocaleTimeString()]);
        data = JSON.stringify(data);
        enviarDatos(data);
        localStorage.removeItem('workday');
     }
});


function enviarDatos(data) {
    
    const headers = new Headers();

    const config = {
        method: "post",
        headers: headers,
        mode: 'cors',
        cache: 'no-cache',
        body: data
    }

    fetch('fichero.php', config)
        .then(respuesta => respuesta.json())
        .then(respuesta => {
            // Implementar que hacer con la respuesta, enviar alerta de success
        });
}
