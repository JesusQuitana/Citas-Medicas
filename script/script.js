const hoy = new Date().toISOString().split('T')[0];

const today = new Date();
const max_Td= today.getDate();
const max_Tm= today.getMonth()+2;
const max_Ty= today.getFullYear();
const max_T= `${max_Ty}-0${max_Tm}-${max_Td}`;

const agendar_fecha = document.querySelector(".agendar-fecha");

agendar_fecha.setAttribute('min', hoy);
agendar_fecha.setAttribute('max', max_T);
