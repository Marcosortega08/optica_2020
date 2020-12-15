new  Vue ( {
    el :'#app',
    data : {
        rutina : "" ,
        url : "http://localhost:8080/optica_2020/" ,
        cliente :{},
        esta:false,
    } ,
    methods : {
        buscar : async function () {
            const  recurso= "controladores/BuscarClienteController.php";
            var  form  =  new  FormData () ;
            form.append ("rutina", this.rutina) ;
            try {
                const  res = await  fetch (this.url + recurso, {
                    method : "publicar" ,
                    body : form,
                } ) ;
                const datos   =  await  res.json();
                console.log(datos);
                if (datos== null) {
                    M.toast ( {html:'rutina no encontrada' } ) ;
                    this.esta  =  false ;
                    this.cliente  =  {} ;
                }else  {
                    this.cliente  =  datos ;
                    this.esta = true;
                }
            }  catch  (error){
                console.log(error) ;
            }
        }
    },
    created(){

    }
} ) ;