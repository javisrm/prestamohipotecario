function calcularHipoteca(e) {
    e.preventDefault();
  let cuota = document.forms["fhipoteca"]["fcuota"].value;
  let valortotal = document.forms["fhipoteca"]["fvalortotal"].value;
  let interes = document.forms["fhipoteca"]["finteres"].value;
  let plazoAnio = document.forms["fhipoteca"]["fplazo"].value;
  const MES_ON_ANIO = 12;
  //console.log("plazo Anio",plazoAnio)
  const hipoteca = {
    totalPrestamo: 0,
    totalInteres: 0,
    cuotaMensual: 0,
  };

  hipoteca.totalPrestamo = valortotal - cuota;

  hipoteca.totalInteres = hipoteca.totalPrestamo * interes / 100;
  hipoteca.cuotaMensual = 
  (hipoteca.totalPrestamo + hipoteca.totalInteres) / (plazoAnio * MES_ON_ANIO);
 outputHipoteca(hipoteca)
}

function outputHipoteca(hipotecaFinal){
    document.getElementById('omontoprestamo').innerHTML= valorDolar(hipotecaFinal.totalPrestamo);
    console.log("cuotaMensual",hipotecaFinal.cuotaMensual)
    document.getElementById('ocuota').innerHTML= valorDolar (hipotecaFinal.cuotaMensual);
}
function limpiarFormulario(){
    document.forms['fhipoteca'].reset();
}
// formatear los valores 
    function valorDolar(valor){
        const dolar= new Intl.NumberFormat('en-US',{style:'currency',currency:'USD',minimumFractionDigits:2});
    return dolar.format(valor);
}
 