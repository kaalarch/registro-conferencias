$(document).ready(function(){
    json.forEach(element => {    
        renderEvento(element);
    });

    jsonMisEventos.forEach(element => {    
        renderMiEvento(element);
    });
});

function renderEvento(evento) {
	let eventosList = document.querySelector("#list-disponibles");

    let li = document.createElement("li");
    li.setAttribute("onclick", "agregar(\"" + evento[0] + "\")");

	li.className = "liUA"

	let nombre = document.createElement("span");
	nombre.style.fontWeight = "bold";
	let fecha = document.createElement("span");
	let lugar = document.createElement("span");
	let capacidad = document.createElement("span");
	let ocupados = document.createElement("span");

	nombre.textContent = evento[1]; 
	fecha.textContent = evento[2];
	lugar.textContent = evento[3];
	capacidad.textContent = "Capacidad: " + evento[4];
	ocupados.textContent = "Ocupados: " + evento[5];

	li.appendChild(nombre);
	li.appendChild(fecha);
	li.appendChild(lugar);
	li.appendChild(capacidad);
	li.appendChild(ocupados);
	eventosList.appendChild(li);
}

function renderMiEvento(evento) {
	let eventosList = document.querySelector("#list-miseventos");

    let li = document.createElement("li");
    li.setAttribute("onclick", "agregar(\"" + evento[0] + "\")");

	li.className = "liUA"

	let nombre = document.createElement("span");
	nombre.style.fontWeight = "bold";
	let fecha = document.createElement("span");
	let lugar = document.createElement("span");

	nombre.textContent = evento[1]; 
	fecha.textContent = evento[2];
	lugar.textContent = evento[3];

	li.appendChild(nombre);
	li.appendChild(fecha);
	li.appendChild(lugar);
	eventosList.appendChild(li);
}

function agregar(id){
    $("#txtOpcion").val(id);
    if(confirm("¿Seguro desea agregar este evento?")){
        document.getElementById("opcion-form").submit();
    }
}

function cerrarSesion(){
    $("#txtOpcion").val("close");
    document.getElementById("opcion-form").submit();
}