const { createApp } = Vue;
const app = createApp({
  data() {
    return {
      usuarios: {},
      todo: {
        idUsuario: 0,
        nombreUsuario: "",
        sexoUsuario: "",
        edadUsuario: "",
      },

      formAdd: false,
      formUpdate: false,
      showListUser: false,
    };
  },
  methods: {
    async listUsers() {
      try {
        let res = await axios("../../controllers/userController.php", {
          method: "POST",
          data: {
            tipoPeticion: "listUsers",
          },
        });
        let resultado = res.data;
        if (resultado[0] == "success") {
          this.usuarios = resultado[1];
        } else if (resultado[0] == "error") {
          console.log(resultado[1]);
        } else {
          console.error(resultado);
        }
      } catch (error) {
        console.error(error);
      }
    },
    aplicarDatables() {
      $("#tablaUsuarios").DataTable({
        lengthMenu: [
          [5, 20, 50, -1],
          [5, 20, 50, "Todos"],
        ],
        order: [[0, "asc"]],
        responsive: "true",
        /*columnDefs: [
            {
                targets: [0],
                visible: false,
                searchable: true
            }, {
                targets: [3],
                visible: false,
                searchable: true
            }, {
                targets: [5],
                visible: false,
                searchable: true
            },
        ],*/
        language: {
          sProcessing: "Procesando...",
          sLengthMenu: "Mostrar _MENU_ registros",
          sZeroRecords: "No se encontraron resultados",
          sEmptyTable: "Ningún dato disponible en esta tabla",
          sInfo:
            "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
          sInfoEmpty:
            "Mostrando registros del 0 al 0 de un total de 0 registros",
          sInfoFiltered: "(filtrado de un total de _MAX_ registros)",
          sInfoPostFix: "",
          sSearch: "Buscar:",
          sUrl: "",
          sInfoThousands: ",",
          sLoadingRecords: "Cargando...",
          oPaginate: {
            sFirst: "Primero",
            sLast: "Último",
            sNext: "Siguiente",
            sPrevious: "Anterior",
          },
          aria: {
            SortAscending:
              ": Activar para ordenar la columna de manera ascendente",
            SortDescending:
              ": Activar para ordenar la columna de manera descendente",
          },
        },
      });
    },
    limpiarDatos() {
      this.todo = {
        idUsuario: "",
        nombreUsuario: "",
        sexoUsuario: "",
        edadUsuario: "",
      };
    },
    async addUser() {
      try {
        let res = await axios("../../controllers/userController.php", {
          method: "POST",
          data: {
            tipoPeticion: "addUser",
            nombreUsuario: this.todo.nombreUsuario,
            sexoUsuario: this.todo.sexoUsuario,
            edadUsuario: this.todo.edadUsuario,
          },
        });
        let resultado = res.data;
        console.log(res.data);
        if (resultado[0] == "success") {
          swal({
            title: resultado[1],
            text: "Presione Ok !",
            icon: "success",
          });
          this.listUsers();
          this.formAdd = false;
        } else if (resultado[0] == "error") {
          swal({
            title: resultado[1],
            text: "Presione Ok !",
            icon: "error",
          });
        } else {
          console.warn("respuesta no definida " + resultado);
        }
      } catch (error) {}
    },
    async peticionEliminar(idUsuario) {
      try {
        let res = await axios("../../controllers/userController.php", {
          method: "POST",
          data: {
            tipoPeticion: "deleteUser",
            idUsuario: idUsuario,
          },
        });
        let resultado = res.data;
        console.log(resultado);
        if (resultado[0] == "success") {
          swal({
            title: resultado[1],
            text: "Presione Ok !",
            icon: "success",
          });
          this.listUsers();
        } else if (resultado[0] == "error") {
          swal({
            title: resultado[1],
            text: "Presione Ok !",
            icon: "error",
          });
        } else {
          console.error("resultado no definido " + resultado);
        }
      } catch (error) {
        console.error(error);
      }
    },
    deleteUser(idUsuario) {
      swal({
        title: "Eliminando usuario...",
        text: "¿Esta seguro de eliminar este usuario con el id " + idUsuario,
        icon: "warning",
        buttons: true,
        dangerMode: true,
      }).then((willDelete) => {
        if (willDelete) {
          this.peticionEliminar(idUsuario);
        } else {
          swal("Cancelado !");
        }
      });
    },
    userInformation(idUsuario, nombreUsuario, sexoUsuario, edadUsuario) {
      this.todo = {
        idUsuario: idUsuario,
        nombreUsuario: nombreUsuario,
        sexoUsuario: sexoUsuario,
        edadUsuario: edadUsuario,
      };
    },
    async updateUser() {
      try {
        let res = await axios("../../controllers/userController.php", {
          method: "POST",
          data: {
            tipoPeticion: "updateUser",
            idUsuario: this.todo.idUsuario,
            nombreUsuario: this.todo.nombreUsuario,
            sexoUsuario: this.todo.sexoUsuario,
            edadUsuario: this.todo.edadUsuario,
          },
        });
        let resultado = res.data;
        if (resultado[0] == "success") {
          swal({
            title: resultado[1],
            text: "Presione Ok !",
            icon: "success",
          });
          this.listUsers();
        } else if (resultado[0] == "error") {
          swal({
            title: resultado[1],
            text: "Presione Ok !",
            icon: "error",
          });
        } else {
          console.log("respuesta no definida " + resultado);
        }
      } catch (error) {
        console.log(error);
      }
    },
  },
  mounted() {
    this.listUsers().then(() => {
      this.aplicarDatables();
    });
  },
});
app.mount("#app");
