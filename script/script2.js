const select_ = document.querySelector('#doctorSelect').addEventListener('change', function() {
var doctor = this.value;
var xhr = new XMLHttpRequest();
xhr.open('GET', 'obtener_fechas1.php?doctor=' + doctor, true);
xhr.onload = function() {
	if(xhr.status == 200) {
		document.querySelector('#fechaDisponible').max = xhr.responseText;
	} else {
		console.error('Error al obtener fechas disponibles');
	}
}
xhr.send();
});