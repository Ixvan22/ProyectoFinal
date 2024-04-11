const btnWorkday = document.getElementById('btn-workday');
let btnValue = document.getElementById('btn-workday-value');

btnWorkday.addEventListener('click', e => {
    btnValue = document.getElementById('btn-workday-value');
    console.log(btnValue);
    e.preventDefault();

    if (btnValue.value = 'start') {
        btnWorkday.classList.remove('btn-success');
        btnWorkday.classList.add('btn-danger');
        
        btnWorkday.innerHTML = "Finalizar";
        btnValue.setAttribute('value', 'stop');
    }
    else if (btnValue.value = 'stop') {
        btnWorkday.classList.remove('btn-danger');
        btnValue.classList.add('btn-success');
     }
});

console.log(btnValue);