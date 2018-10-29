function numero(z){
v = z.value;
v=v.replace(/\D/g,"") // permite digitar apenas numero
z.value = v;
}

function dataConta(c){
    if(c.value.length ==2){
        c.value += '/';
    }
    if(c.value.length==5){
        c.value += '/'; 
    }
}

function validasenha(s){
    var senha1 = document.getElementById('Senha').value;
    var senha2 = document.getElementById('Confirmar').value;
    
    if (senha1 != senha2) {
        alert("Senhas não conferem")
        document.getElementById('Senha').value = null;
        document.getElementById('Confirmar').value = null;
    }
}