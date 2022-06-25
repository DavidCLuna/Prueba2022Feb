<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Prueba2022Feb</title>

        <link rel="icon" href="https://www.garantiascomunitarias.com/wp-content/uploads/2021/02/cropped-fav-32x32.png" sizes="32x32">
        
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <link rel="stylesheet" href="{{ asset('assets/style.css') }}" />

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
        
        <!-- CSS only -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
        <!-- JavaScript Bundle with Popper -->
        
        <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.1/toastr.min.css" rel="stylesheet" media="all">
        
        
    </head>
    <body>
        <section class="section">
            <div class="container-fluid container-bg p-5">
                <!-- ========== title-wrapper start ========== -->
                <div class="title-wrapper pt-30">
                    <div class="row mb-3">
                        <div class="col-md-6 p-3">
                            <div class="ml-10">
                                <h5 class="fw-bold">Registro computadores</h5>
                            </div>
                        </div>
                        <!-- end col -->
                        <div class="col-md-6">
                            <img class="float-end" src="https://www.garantiascomunitarias.com/wp-content/uploads/2021/01/cropped-logo-gc.png" alt="" srcset="">
                        </div>
                        <!-- end col -->
                    </div>
                    <!-- end row -->
                </div>
                <form class="form-group" method="POST" id="form_agregar">
                    <div >
                        <div class="row">
                                <div class="col-4 mb-3">
                                    <input type="text" name="gce_nombre_equipo" id="gce_nombre_equipo" class="form-control" placeholder="Nombre del equipo"  required="true">
                                </div>
                                <div class="col-4 mb-3">
                                    <input type="text" name="gce_board" id="gce_board" class="form-control" placeholder="Board" required>
                                </div>
                                <div class="col-4 mb-3">
                                    <input type="text" name="gce_case" id="gce_case" class="form-control" placeholder="Case" required>
                                </div>
                                <div class="col-4 mb-3">
                                    <input type="text" name="gce_procesador" id="gce_procesador" class="form-control" placeholder="Procesador" required>
                                </div>
                                <div class="col-4 mb-3">
                                    <input type="text" name="gce_grafica" id="gce_grafica" class="form-control" placeholder="Gráfica" required>
                                </div>
                                <div class="col-4 mb-3">
                                    <input type="number" name="gce_ram" id="gce_ram" class="form-control" placeholder="Ram" required>
                                </div>
                                <div class="col-4 mb-3">
                                    <input type="text" name="gce_disco_duro" id="gce_disco_duro" class="form-control" placeholder="Disco" required>
                                </div>
                                <div class="col-4 mb-3">
                                    <input type="text" name="gce_teclado" id="gce_teclado" class="form-control" placeholder="Teclado" required>
                                </div>
                                <div class="col-4 mb-3">
                                    <input type="text" name="gce_mouse" id="gce_mouse" class="form-control" placeholder="Mouse" required>
                                </div>
                                <div class="col-6 mb-3">
                                    <input type="number" name="gce_pantalla" id="gce_pantalla" class="form-control" placeholder="Pantalla" required>
                                </div>
                                <div class="col-6 mb-3">
                                    <select name="gce_estado" id="gce_estado" class="form-control" placeholder="Estado">
                                        <option value="1">Activo</option>
                                        <option value="0">Inactivo</option>
                                    </select>
                                </div>
                                <div class="col-12 mt-2">
                                    <button type="submit" class="btn text-light btn-agregar w-100 fw-bold" id="btn_agregar">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 3h18v18H3zM12 8v8m-4-4h8" /></svg>
                                        Agregar
                                    </button>
                                </div>
                        </div>
                    </div>
                </form>

                <div class="tables-wraper">
                    <div class="row">
                        <div class="col-12">
                            <div class="card mt-5">
                                <div class="table-wrapper table-responsive p-3">
                                    <table class="table">
                                        <thead>
                                            <th><h6>Nombre</h6></th>
                                            <th><h6>Board</h6></th>
                                            <th><h6>Case</h6></th>
                                            <th><h6>Procesador</h6></th>
                                            <th><h6>Gráfica</h6></th>
                                            <th><h6>Ram</h6></th>
                                            <th><h6>Disco</h6></th>
                                            <th><h6>Teclado</h6></th>
                                            <th><h6>Mouse</h6></th>
                                            <th><h6>Pantalla</h6></th>
                                            <th class="text-center"><h6>Estado</h6></th>
                                            <th></th>
                                        </thead>
                                        <tbody id="tbody_table">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Editar start -->
            <div class="warning-modal">
                <div class="modal fade" id="ModalUpdate" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-xl modal-dialog-centered">
                        <div class="modal-content card-style">
                            <div class="modal-header p-3">
                                <h6 class="fw-bold">
                                    Editar Rol
                                </h6>
                            </div>
                            <div class="modal-body p-4">
                                <div class="content">
                                    <form method="post" id="form_update">
                                        <div class="row pt-2">
                                            <input type="hidden" name="id_update" id="id_update">
                                            <div class="col-4 mb-3">
                                                <input type="text" name="gce_nombre_equipo" id="gce_nombre_equipo_update" class="form-control" placeholder="Nombre del equipo">
                                            </div>
                                            <div class="col-4 mb-3">
                                                <input type="text" name="gce_board" id="gce_board_update" class="form-control" placeholder="Board">
                                            </div>
                                            <div class="col-4 mb-3">
                                                <input type="text" name="gce_case" id="gce_case_update" class="form-control" placeholder="Case">
                                            </div>
                                            <div class="col-4 mb-3">
                                                <input type="text" name="gce_procesador" id="gce_procesador_update" class="form-control" placeholder="Procesador">
                                            </div>
                                            <div class="col-4 mb-3">
                                                <input type="text" name="gce_grafica" id="gce_grafica_update" class="form-control" placeholder="Gráfica">
                                            </div>
                                            <div class="col-4 mb-3">
                                                <input type="text" name="gce_ram" id="gce_ram_update" class="form-control" placeholder="Ram">
                                            </div>
                                            <div class="col-4 mb-3">
                                                <input type="text" name="gce_disco_duro" id="gce_disco_duro_update" class="form-control" placeholder="Disco">
                                            </div>
                                            <div class="col-4 mb-3">
                                                <input type="text" name="gce_teclado" id="gce_teclado_update" class="form-control" placeholder="Teclado">
                                            </div>
                                            <div class="col-4 mb-3">
                                                <input type="text" name="gce_mouse" id="gce_mouse_update" class="form-control" placeholder="Mouse">
                                            </div>
                                            <div class="col-6 mb-3">
                                                <input type="text" name="gce_pantalla" id="gce_pantalla_update" class="form-control" placeholder="Pantalla">
                                            </div>
                                            <div class="col-6 mb-3">
                                                <select name="gce_estado" id="gce_estado_update" class="form-control" placeholder="Estado">
                                                    <option value="1">Activo</option>
                                                    <option value="0">Inactivo</option>
                                                </select>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="action d-flex flex-wrap justify-content-start mt-2">
                                    <button
                                        class="btn btn-guardar w-10 btn-hover m-1 text-light"
                                        type="submit"
                                        id="btn_update"
                                        >
                                        Guardar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <!-- ModalFour End -->
        </section>
        <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.1/toastr.min.js"></script>
        <script src= "{{ asset('assets/main.js') }}"></script> 
    </body>
</html>
