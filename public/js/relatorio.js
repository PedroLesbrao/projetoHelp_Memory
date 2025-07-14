function mascaraPeso(campoPeso){
    var peso = campoPeso.value;
    if (peso.length == 3){
        peso = peso + '';
        document.forms[0].peso.value = peso;
    }
}

function somentenumero(){
    var sDigitos = "0123456789,.-()";
    var cTecla = event.key;
    if(sDigitos.indexOf(cTecla)==-1){
        return false;
    }else{
        return true;
    }

}

function mascaraAltura(campoAltura){
    var altura = campoAltura.value;
    if (altura.length == 1){
        altura = altura + ',';
        document.forms[0].altura.value = altura;
    }
}

function mascaraData(campoData){
    var data = campoData.value;
    if (data.length == 2){
        data = data + '/';
        document.forms[0].data.value = data;
return true;              
    }
    if (data.length == 5){
        data = data + '/';
        document.forms[0].data.value = data;
        return true;
    }
}