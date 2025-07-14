// function btnAbre(){
//     document.getElementById('menu').style.width = '250px';
//     document.getElementById('conteudo').style.marginLeft = '250px';
    
// }
// function FecharMenu(){
//     document.getElementById('menu').style.width ='0px';
//     document.getElementById('conteudo').style.marginLeft = '0px';

// }


var btnSignin = document.querySelector("#signin");
var btnSignup = document.querySelector("#signup");

var body = document.querySelector("body");

btnSignin.addEventListener("click", function () {
    body.className = "sign-in-js"; 
 });
 
 btnSignup.addEventListener("click", function () {
     body.className = "sign-up-js";
 });


function somentenumero(){
    var sDigitos = "0123456789,.-()";
    var cTecla = event.key;
    if(sDigitos.indexOf(cTecla)==-1){
        return false;
    }else{
        return true;
    }

}




// function testarSenha(){
    // var s1 = document.getElementById("senha");
//     var s2 = document.getElementById("confirmar");
//     //Precisa testar a mudança do campo saindo da senha direto para outro campo
//     if(s1==s2){ //} && s2.value!=""){
//         alert("Senhas conferem");
//     }else{
//         alert("Senhas diferentes");
//     }
// }


// function validate(item) {
//     var s1 = document.getElementById("senha");
//     var s2 = document.getElementById("confirmar");

//     item.setCustomValidity('');
//     item.checkValidity();

//     if(item == s2){
//         if(item.value === s1.value)item.setCustomValidity('');
//         else item.setCustomValidity('As senhas digitadas não são iguais. Verifique e corrija.');
//     }
// }


function mascTelefone(telefone){
telefone = telefone.replace(/\D/g,"");
telefone = telefone.replace(/^(\d{2})(\d)/g,"($1)$2");
telefone = telefone.replace(/(\d)(\d{4})$/,"$1-$2");
return telefone;

}

function mascCPF(cpf){
    cpf=cpf.replace(/\D/g,"");
    cpf=cpf.replace(/(\d{3})(\d)/,"$1.$2");
    cpf=cpf.replace(/(\d{3})(\d)/,"$1.$2");
    cpf=cpf.replace(/(\d{3})(\d{1,2})$/,"$1-$2");
    return cpf;
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
    this.document.getElementById("telefones").onkeyup=function(){mascara(this,mascTelefone)}
    this.document.getElementById("cpf").onkeyup=function(){mascara(this,mascCPF)}
    // this.document.getElementById("dataNasc").onkeyup=function(){mascara(this,mascData)}      
    }


// function mascara(obj,func){
// v_obj=obj;
// v_fun=func;
// setTimeout("executamascara()",1);
// }
// function executamascara(){
//  v_obj.value=v_fun(v_obj.value);
// }
// window.onload=function(){
// this.document.getElementById("telefones").onkeyup=function(){mascara(this,mascTelefone)}
// this.document.getElementById("cpf").onkeyup=function(){mascara(this,mascCPF)}
// }

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

