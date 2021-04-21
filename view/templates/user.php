<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <title>CRUD USUARIOS</title>
</head>

<body>
    <div id="app">
        <div class="container-fluid m-0 my-5">
            <div class="row">
                <div class="col-10 text-center">
                    <h5>CRUD USUARIOS</h5>
                </div>
                <div class="col-2 text-center">
                    <a @click="limpiarDatos()"><i class="fas fa-user-plus text-success" data-bs-toggle="modal" data-bs-target="#exampleModal1"></i></a>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <table class="table table-light scrollable text-center" id="tablaUsuarios">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Sexo</th>
                                <th scope="col">Edad</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-if="usuarios.length == 0">
                                <th colspan="5" class="text-danger text-center">No hay registros existentes</th>
                            </tr>
                            <tr v-for="usuario in usuarios">
                                <th scope="row">{{usuario.id}}</th>
                                <td v-if="usuario.nombre">{{usuario.nombre}}</td>
                                <td>{{usuario.sexo}}</td>
                                <td>{{usuario.edad}}</td>
                                <td>
                                    <a data-bs-toggle="modal" data-bs-target="#exampleModa2" @click="userInformation(usuario.id, usuario.nombre, usuario.sexo, usuario.edad)"><i class="fas fa-user-edit text-info"></i></a>
                                    <a @click="deleteUser(usuario.id)"><i class="fas fa-user-times text-danger"></i></a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- MODAL USER -->
        <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" v-show="formAdd = true">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Agregar usuario</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="usuariosForm">
                            <div class="container-fluid m-0">
                                <div class="row">
                                    <div class="col-12">
                                        <input type="hidden" v-model="todo.idUsuario">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">Nombre</span>
                                            <input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1" v-model="todo.nombreUsuario" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">Sexo</span>
                                            <select class="form-select" aria-label="Default select example" v-model="todo.sexoUsuario" required>
                                                <option selected disabled value="=">?</option>
                                                <option value="H">Hombre</option>
                                                <option value="M">Mujer</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">Edad</span>
                                            <input type="number" class="form-control" placeholder="Edad" aria-label="Username" aria-describedby="basic-addon1" v-model="todo.edadUsuario" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success" data-bs-dismiss="modal" @click="addUser()">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- UPDATE USER-->
        <div class="modal fade" id="exampleModa2" tabindex="-1" aria-labelledby="exampleModalLabel2" aria-hidden="true">
            <div class="modal-dialog" v-show="formAdd = true">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel2">Actualizar usuario</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="usuariosEdit">
                            <div class="container-fluid m-0">
                                <div class="row">
                                    <div class="col-12">
                                        <input type="hidden" v-model="todo.idUsuario">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">Nombre</span>
                                            <input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1" v-model="todo.nombreUsuario">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">Sexo</span>
                                            <select class="form-select" aria-label="Default select example" v-model="todo.sexoUsuario">
                                                <option selected>?</option>
                                                <option value="H">Hombre</option>
                                                <option value="M">Mujer</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">Edad</span>
                                            <input type="number" class="form-control" placeholder="Edad" aria-label="Username" aria-describedby="basic-addon1" v-model="todo.edadUsuario">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-success" @click="updateUser()">Save changes</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="../static/fontawesome/js/all.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="https://unpkg.com/vue@next"></script>
    <script src="./js/user.js"></script>
</body>

</html>