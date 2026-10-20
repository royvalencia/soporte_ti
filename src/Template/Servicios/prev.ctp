<script src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js" type="text/javascript"></script>
<link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.js"></script>
<?= $this->Html->css('inspinia/plugins/iCheck/custom'); ?>
<?= $this->Html->css('inspinia/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox'); ?>

<style>
    .ibox {
        min-height: 400px;
        display: flex;
        flex-direction: column;
    }

    .ibox-content {
        flex-grow: 1;
    }


    < !-- CSS personalizado: skin guinda para iCheck (poner después de cargar custom.css) --><style>

    /* color guinda */
    :root {
        --guinda: #7b003b;
    }

    /* iCheck suele crear .icheckbox_* y .iradio_* con elementos interiores > i */
    .icheckbox_guinda,
    .iradio_guinda {
        border-color: var(--guinda) !important;
    }

    /* estado seleccionado */
    .icheckbox_guinda.checked,
    .iradio_guinda.checked {
        background-color: var(--guinda) !important;
        border-color: var(--guinda) !important;
    }

    /* marca interna (i) — forzar que se vea guinda */
    .icheckbox_guinda>i,
    .iradio_guinda>i {
        box-shadow: none !important;
    }

    /* cuando está marcado, el pseudo-elemento antes/after que iCheck usa */
    .icheckbox_guinda.checked>i:before,
    .iradio_guinda.checked>i:before {
        background: var(--guinda) !important;
        border-color: var(--guinda) !important;
    }

    /* opcional: hover/focus */
    .icheckbox_guinda:hover,
    .iradio_guinda:hover {
        border-color: var(--guinda) !important;
    }

    .ibox-content table.table,
    .ibox-content table.table tr,
    .ibox-content table.table td {
        border: none !important;
    }

    .ibox-content table.table td {
        padding: 6px 4px !important;
        vertical-align: middle;
    }

    .ibox-content table.table td {
        padding: 2px 0px !important;
        /* más compacto */
        vertical-align: middle !important;
    }

    .ibox-content table.table tr {
        line-height: 1 !important;
    }

    /* Para evitar espacio extra que agrega Bootstrap */
    .ibox-content table.table {
        margin-bottom: 0 !important;
    }
</style>


</style>


<script>
    $('document').ready(function() {
        var tipo = $("#tipo").val();
        $('#co-group-id').change(function() {
            var searchkey = $(this).val();
            searchTags(searchkey);
        });

        function searchTags(institucion) {
            var data = institucion;

            if (tipo == 4) {
                $.ajax({
                    method: 'get',
                    url: "<?php echo $this->Url->build(['controller' => 'Servicios', 'action' => 'ajaxproceso3']); ?>",
                    data: {
                        institucion: data
                    },
                    success: function(response) {
                        $('#post1').html(response);
                    }
                });
            } else {
                $.ajax({
                    method: 'get',
                    url: "<?php echo $this->Url->build(['controller' => 'Servicios', 'action' => 'ajaxproceso']); ?>",
                    data: {
                        institucion: data
                    },
                    success: function(response) {
                        $('#post1').html(response);
                    }
                });
            }

        };
    });
</script>

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2><?= __('Servicios'); ?></h2>
    </div>
    <div class="col-lg-2"> </div>
</div>

<?= $this->Form->create(null, ['url' => ['action' => 'procesar_solicitud']]) ?>









<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">

            <div class="ibox-title">
                <b>Selecciona la categoría que mejor describa tu solicitud.</b>
                Esto nos permitirá canalizar tu caso al equipo adecuado y brindarte una atención más rápida.
            </div>
        </div>
    </div>



    <div class="row" style="margin-top:20px;">
        <div class="col-lg-3">
            <div class="ibox">
                <div class="ibox-title">
                    <div class="team-members"><a href="#"><img alt="member" class="img-circle" src="/upload/avatar/rompecabezas.png"></a></div>
                    <p style="font-size: 1.3em; font-weight: bold; margin: 10px 0;">
                        Sistemas de información administrados por la SEFIPLAN
                    </p>

                </div>
                <div class="ibox-content">

                    <table class="table">
                        <tbody>
                            <tr>
                                <td style="width: 35px;">
                                    <div class="i-checks">
                                        <label>
                                            <input type="radio" name="servicio" value="4|0">
                                            <i></i>
                                        </label>
                                    </div>
                                </td>
                                <td>Error o solicitud de mejora a los sistemas</td>
                            </tr>
                            <tr>
                                <td style="width: 35px;">
                                    <div class="i-checks">
                                        <label>
                                            <input type="radio" name="servicio" value="4|0">
                                            <i></i>
                                        </label>
                                    </div>
                                </td>
                                <td>Alta / baja / gestión de usuarios de los sistemas</td>
                            </tr>
                            <tr>
                                <td style="width: 35px;">
                                    <div class="i-checks">
                                        <label>
                                            <input type="radio" name="servicio" value="4|0">
                                            <i></i>
                                        </label>
                                    </div>
                                </td>
                                <td>Todo lo relacionado a OperGob, sistemas de RH, página web oficial y sistemas administrados por la sefiplan.</td>
                            </tr>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>




        <div class="col-lg-3">
            <div class="ibox">
                <div class="ibox-title">
                    <div class="team-members"><a href="#"><img alt="member" class="img-circle" src="/upload/avatar/laptop.jpg"></a></div>
                    <p style="font-size: 1.3em; font-weight: bold; margin: 10px 0;">
                        Problemas con mi equipo
                    </p>
                </div>
                <div class="ibox-content">

                    <table class="table">
                        <tbody>

                            <tr>
                                <td style="width: 35px;">
                                    <div class="i-checks">
                                        <label>
                                            <input type="radio" name="servicio" value="3|69">
                                            <i></i>
                                        </label>
                                    </div>
                                </td>
                                <td>Incidencias con computadoras</td>
                            </tr>
                            <tr>
                                <td style="width: 35px;">
                                    <div class="i-checks">
                                        <label>
                                            <input type="radio" name="servicio" value="3|54">
                                            <i></i>
                                        </label>
                                    </div>
                                </td>
                                <td>Incidencias con impresoras o periféricos</td>
                            </tr>
                            <tr>
                                <td style="width: 35px;">
                                    <div class="i-checks">
                                        <label>
                                            <input type="radio" name="servicio" value="3|53">
                                            <i></i>
                                        </label>
                                    </div>
                                </td>
                                <td>Problemas con internet</td>
                            </tr>
                            <tr>
                                <td style="width: 35px;">
                                    <div class="i-checks">
                                        <label>
                                            <input type="radio" name="servicio" value="3|66">
                                            <i></i>
                                        </label>
                                    </div>
                                </td>
                                <td>Problemas de conectividad en la red</td>
                            </tr>
                            <tr>
                                <td style="width: 35px;">
                                    <div class="i-checks">
                                        <label>
                                            <input type="radio" name="servicio" value="3|77">
                                            <i></i>
                                        </label>
                                    </div>
                                </td>
                                <td>Modificación de infraestructura física de la red de voz y datos </td>
                            </tr>

                            <tr>
                                <td style="width: 35px;">
                                    <div class="i-checks">
                                        <label>
                                            <input type="radio" name="servicio" value="3|55">
                                            <i></i>
                                        </label>
                                    </div>
                                </td>
                                <td>Instalación o actualización de software</td>
                            </tr>

                            <tr>
                                <td style="width: 35px;">
                                    <div class="i-checks">
                                        <label>
                                            <input type="radio" name="servicio" value="3|56">
                                            <i></i>
                                        </label>
                                    </div>
                                </td>
                                <td> Mantenimiento preventivo</td>
                            </tr>
                            <tr>
                                <td style="width: 35px;">
                                    <div class="i-checks">
                                        <label>
                                            <input type="radio" name="servicio" value="3|67">
                                            <i></i>
                                        </label>
                                    </div>
                                </td>
                                <td> Ataque de ciberseguridad</td>
                            </tr>
                            <tr>
                                <td style="width: 35px;">
                                    <div class="i-checks">
                                        <label>
                                            <input type="radio" name="servicio" value="3|68">
                                            <i></i>
                                        </label>
                                    </div>
                                </td>
                                <td> Asesoría de nube</td>
                            </tr>
                        </tbody>
                    </table>


                </div>
            </div>
        </div>


        <div class="col-lg-3">
            <div class="ibox">
                <div class="ibox-title">
                    <div class="team-members"><a href="#"><img alt="member" class="img-circle" src="/upload/avatar/email.jpg"></a></div>
                    <p style="font-size: 1.3em; font-weight: bold; margin: 10px 0;">
                        Servicios tecnológicos institucionales
                    </p>
                </div>
                <div class="ibox-content">

                    <table class="table">
                        <tbody>

                            <tr>
                                <td style="width: 35px;">
                                    <div class="i-checks">
                                        <label>
                                            <input type="radio" name="servicio" value="6|57">
                                            <i></i>
                                        </label>
                                    </div>
                                </td>
                                <td>Solicitud de instalación de redes</td>
                            </tr>
                            <tr>
                                <td style="width: 35px;">
                                    <div class="i-checks">
                                        <label>
                                            <input type="radio" name="servicio" value="6|58">
                                            <i></i>
                                        </label>
                                    </div>
                                </td>
                                <td>Soporte correo institucional</td>
                            </tr>
                            <tr>
                                <td style="width: 35px;">
                                    <div class="i-checks">
                                        <label>
                                            <input type="radio" name="servicio" value="6|59">
                                            <i></i>
                                        </label>
                                    </div>
                                </td>
                                <td>Soporte telefonía</td>
                            </tr>
                            <tr>
                                <td style="width: 35px;">
                                    <div class="i-checks">
                                        <label>
                                            <input type="radio" name="servicio" value="6|60">
                                            <i></i>
                                        </label>
                                    </div>
                                </td>
                                <td>Solicitud de videoconferencias</td>
                            </tr>
                            <tr>
                                <td style="width: 35px;">
                                    <div class="i-checks">
                                        <label>
                                            <input type="radio" name="servicio" value="6|61">
                                            <i></i>
                                        </label>
                                    </div>
                                </td>
                                <td>Apoyo de servicios de internet a eventos de dependencias</td>
                            </tr>
                        </tbody>
                    </table>




                </div>
            </div>
        </div>


        <div class="col-lg-3">
            <div class="ibox">
                <div class="ibox-title">
                    <div class="team-members"><a href="#"><img alt="member" class="img-circle" src="/upload/avatar/servidor.avif"></a></div>
                    <p style="font-size: 1.3em; font-weight: bold; margin: 10px 0;">
                        Centro de Datos
                    </p>
                </div>
                <div class="ibox-content">

                    <table class="table">
                        <tbody>

                            <tr>
                                <td style="width: 35px;">
                                    <div class="i-checks">
                                        <label>
                                            <input type="radio" name="servicio" value="3|62">
                                            <i></i>
                                        </label>
                                    </div>
                                </td>
                                <td>Gestión de servidores</td>
                            </tr>
                              <tr>
                                <td style="width: 35px;">
                                    <div class="i-checks">
                                        <label>
                                            <input type="radio" name="servicio" value="3|63">
                                            <i></i>
                                        </label>
                                    </div>
                                </td>
                                <td>Solicitud de subdominios</td>
                            </tr>
                              <tr>
                                <td style="width: 35px;">
                                    <div class="i-checks">
                                        <label>
                                            <input type="radio" name="servicio" value="3|64">
                                            <i></i>
                                        </label>
                                    </div>
                                </td>
                                <td>VPN´s</td>
                            </tr>
                        </tbody>
                    </table>

                   



                </div>
            </div>
        </div>


    <div class="row">
        <div class="col-lg-12 text-center" style="margin-top:10px;">
            <button type="submit" class="btn btn-primary">Siguiente</button>
        </div>
    </div>
        

        <?= $this->Form->end() ?>

    </div>
</div>





<?= $this->Form->end() ?>

<!-- SUMMERNOTE -->
<script>
    $(document).ready(function() {

        $('.summernote').summernote({
            height: 235,
            placeholder: 'Describe tu Solicitud lo más detallado posible.',
            toolbar: [
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough']],
                ['fontsize', ['fontsize']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']]
            ]
        });

    });
</script>
<script>
    // Función para crear un nuevo campo de archivo automáticamente
    function agregarCampo() {
        var contenedorArchivos = document.getElementById("archivos");
        var input = document.createElement("input");
        input.type = "file";
        input.title = "seleccione un archivo para complementar su solicitud";
        input.name = "archivos[]"; // Enviar los archivos como un arreglo
        input.accept = 'application/pdf,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel,text/comma-separated-values, text/csv, application/csv, .doc,.docx,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document, image/*';
        input.addEventListener('change', agregarCampo); // Agregar el evento para agregar más campos
        contenedorArchivos.appendChild(input);
        contenedorArchivos.appendChild(document.createElement("br")); // Añadir salto de línea
    }

    // Función inicial que agrega el primer campo y asigna el evento de cambio
    window.onload = function() {
        agregarCampo();
    };
</script>

<?= $this->Html->script('inspinia/plugins/iCheck/icheck.min'); ?>
<script>
    $(document).ready(function() {
        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green',
        });
    });
</script>