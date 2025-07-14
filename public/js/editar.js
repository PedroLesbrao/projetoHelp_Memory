
function somentenumero(){
    var sDigitos = "0123456789,.-()";
    var cTecla = event.key;
    if(sDigitos.indexOf(cTecla)==-1){
        return false;
    }else{
        return true;
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

function mascTelefone(telefone){
    telefone = telefone.replace(/\D/g,"");
    telefone = telefone.replace(/^(\d{2})(\d)/g,"($1)$2");
    telefone = telefone.replace(/(\d)(\d{4})$/,"$1-$2");
    return telefone;
    
    }

    function mascara(obj,func){
        v_obj=obj;
        v_fun=func;
        setTimeout("executamascara()",1);
         }
        function executamascara(){
        v_obj.value=v_fun(v_obj.value);
         }
         
        window.onload=function(){
        this.document.getElementById("telefone").onkeyup=function(){mascara(this,mascTelefone)}
        }