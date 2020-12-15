new Vue({
    el:'#nuevareceta',
    data:{
        rut: "",
        url: "http://localhost:8080/optica_2020/",
        cliente: {},
        esta: false,
        id_material_cristal: "",
        materiales: [],
        id_tipo_cristal: "",
        tipos: [],
        id_armazon: '',
        armazones: [],
        base_sel: '',
        clienteexiste: false,
        rutCliente:"",
        rutClienteSeleccionado:"",
        tipo_lentes:'',
        esfeizq:'',
        cilizq:'',
        ejeizq:'',
        esfeder:'',
        cilder:'',
        ejeder:'',
        material_sel: '',
        tipo_sel: '',
        base_sel:'',
        armazon_sel: '',
        prisma:'',
        fecha_e:'',
        fecha_r:'',
        nombremed:'',
        rutmed:'',
        obs:'',
        precio:'',
        pupilar:'',
    },
    methods:{
        buscar: async function(){
            const recurso = "controllers/BuscarClienteController.php";
            var form = new FormData();
            form.append("rut", this.rut);
            try {
                const res = await fetch(this.url + recurso, {
                    method: "post",
                    body: form,
                });
                const data = await res.json();
                console.log(data);
                if(data == null){
                    M.toast({html:'Rut No Encontrado'});
                    this.esta = false;
                    this.cliente = {};
                    this.rutClienteSeleccionado = "";
                    
                } else {
                    this.cliente = data;
                    this.rutClienteSeleccionado = data["rut_cliente"];
                    this.esta = true;
                }
            } catch (error) {
                console.log(error);
            }
        },
        cargaMateriales: async function(){
            try {
                var recurso = "controllers/GetMaterialCristal.php";
                const res = await fetch(this.url + recurso);
                const data = await res.json();
                this.materiales = data;
                console.log(data);
            } catch (error) {
                console.log(error);
            }
        },
        cargaTipos: async function(){
            try {
                var recurso = "controllers/GetTipoCristal.php";
                const res = await fetch(this.url + recurso);
                const data = await res.json();
                this.tipos = data;
                console.log(data);
            } catch (error) {
                console.log(error);
            }
        },
        cargaArmazon: async function(){
            try {
                var recurso = "controllers/GetArmazon.php";
                const res = await fetch(this.url + recurso);
                const data = await res.json();
                this.armazones = data;
                console.log(data);
            } catch (error) {
                console.log(error);
            }
        },
        crearR: async function () {
            if (this.rutClienteSeleccionado != ""){
              this.fecha_e = M.Datepicker.getInstance(fechaentrega);
              this.fecha_r = M.Datepicker.getInstance(fecharetiro);
    
              const recurso = "controllers/ControlRecetaCrear.php";
              var form = new FormData();
              form.append("tipo_lente", this.tipo_lentes);
              form.append("esfera_oi", this.esfeizq);
              form.append("esfera_od", this.esfeder);
              form.append("cilindro_oi", this.cilizq);
              form.append("cilindro_od", this.cilder);
              form.append("eje_oi", this.ejeizq);
              form.append("eje_od", this.ejeder);
              form.append("prisma", this.prisma);
              form.append("base", this.base_sel);
              form.append("armazon", this.id_armazon);
              form.append("material_cristal", this.id_material_cristal);
              form.append("tipo_cristal", this.id_tipo_cristal);
              form.append("distancia_pupilar", this.pupilar);
              form.append("valor_lente", this.precio);
              form.append("fecha_entrega", this.fecha_e);
              form.append("fecha_retiro", this.fecha_r);
              form.append("observacion", this.obs);
              form.append("rut_cliente", this.rutClienteSeleccionado);
              form.append("rut_medico", this.rutmed);
              form.append("nombre_medico", this.nombremed);
              try {
                  const res = await fetch(this.url + recurso, {
                  method: "post",
                  body: form,
                
              });
              const data = await res.json();
                for (i in data) {
                  M.toast({html: data[i]})
                  if (data["msg"] == "receta creada") {
                    this.tipo_lentes = "";
                    this.esfeizq = "";
                    this.esfeder = "";
                    this.cilizq = "";
                    this.cilder = "";
                    this.ejeizq = "";
                    this.ejeder = "";
                    this.prisma = "";
                    this.base_sel = "";
                    this.id_armazon = "";
                    this.id_material_cristal = "";
                    this.id_tipo_cristal = "";
                    this.pupilar = "";;
                    this.precio = "";
                    this.fecha_e = "";
                    this.fecha_r = "";
                    this.obs = "";
                    this.rutmed = "";
                    this.nombremed = "";
                  }
                }                       
              } catch (error) {
                  console.log(error);
                  M.toast({html: 'hubo un error'})
              }  
            } else {
              M.toast({html: 'seleccione un cliente valido'})
            }
    
          },

    },
    created(){
        this.cargaMateriales();
        this.cargaTipos();
        this.cargaArmazon();
    }
});