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