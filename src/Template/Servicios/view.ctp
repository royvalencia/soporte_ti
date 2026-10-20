<script src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js" type="text/javascript"></script>
<link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.js"></script>

<!-- MODIFICACIÓN: evita que textos, imágenes, adjuntos y el editor desborden sus columnas. -->
<style>
    .mail-box-header,
    .mail-box,
    .mail-attachment,
    .attachment,
    .note-editor {
        max-width: 100%;
        min-width: 0;
    }

    .mail-box-header,
    .mail-attachment,
    .file-name {
        overflow-wrap: anywhere;
        word-break: break-word;
    }

    .mail-attachment img,
    .note-editable img {
        max-width: 100% !important;
        height: auto !important;
    }

    .attachment {
        overflow: hidden;
    }

    .file-box {
        max-width: 100%;
    }

    .file-name {
        white-space: normal;
    }

    #archivos input[type="file"] {
        display: block;
        max-width: 100%;
        margin-bottom: 8px;
    }

    @media (max-width: 991px) {
        .ticket-main-column,
        .ticket-side-column {
            width: 100%;
            float: none;
        }
    }
</style>
<script>
    $(document).ready(function() {
        $('#co-group-id').change(function() {

            var searchkey = $(this).val();
            searchTags(searchkey);
        });

        function searchTags(institucion) {
            var data = institucion;

            $.ajax({
                method: 'get',
                url: "<?php echo $this->Url->build(['controller' => 'Servicios', 'action' => 'ajaxproceso2']); ?>",
                data: {
                    institucion: data
                },
                success: function(response) {
                    $('#post1').html(response);
                }
            });
        };
    });
</script>
<?php echo $this->Html->script('eModal.min'); //AJAX MODAL ?>
<?php use Cake\Routing\Router; ?>
<?php
/*
 * MODIFICACIÓN: banderas para controlar la respuesta de tickets cerrados.
 * Estado cerrado = 6, agente = tipo 3 y usuario solicitante = tipo 4.
 */
$ticketCerrado = ((int)$servicio->statu_id === 6);
$usuarioNoPuedeResponder = ($ticketCerrado && (int)$tipo === 4);
$agenteNotaPrivadaObligatoria = ($ticketCerrado && (int)$tipo === 3);
?>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2><?= __('Servicios') ?></h2>
    </div>
    <div class="col-lg-2"> </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <?php if ($tipo == 4) { ?>
            <div class="col-lg-12 ticket-main-column">
            <?php } else {  ?>
                <div class="col-lg-9 ticket-main-column">
                <?php } ?>
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5><i class="fa fa-th"></i> <?= __('Detalle de  Servicio'); ?> </h5>
                    </div>
                    <div class="ibox-content">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="btn-toolbar" role="toolbar">
                                    <div class="btn-group pull-right">
                                        <?php if ($tipo == 4) {
                                        } else { ?>
                                            <?php //echo $this->Html->link('<i class="fa fa-yahoo" ></i>', array('action' => 'fusionar/' . $servicio->servicio_id), array('class' => 'btn btn-default', 'rel' => 'tooltip', 'title' => 'Fusionar', 'escape' => false)); 
                                            ?>
                                        <?php } ?>
                                        

                                        <?php
                                        echo $this->Html->link(
                                            '<i class="fa fa-print"></i>',
                                            '#', // si no quieres que cambie de página
                                            [
                                                'class' => 'btn btn-default',
                                                'rel' => 'tooltip',
                                                'title' => 'Imprimir',
                                                'escape' => false,
                                                'onclick' => 'printBlocks(); return false;'
                                            ]
                                        );
                                        ?>


                                        <?php echo $this->Html->link('<i class="fa fa-list" ></i>', array('action' => 'index'), array('class' => 'btn btn-default', 'rel' => 'tooltip', 'title' => 'Lista de Servicios', 'escape' => false)); ?>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <br>


                        <div class="">
                            <!-- aqui va todo-->



                            <div class="mail-box-header" id="primero">
                                <h2>
                                    <B>
                                        <?php echo "#" . $servicio->servicio_id; ?>
                                    </B>
                                </h2>
                                <div class="mail-tools tooltip-demo m-t-md">


                                    <h3>
                                        <?= h($servicio->asunto) ?>
                                    </h3>
                                    <?php echo date_format($servicio->created, "d-m-Y h:i A"); ?>
                                    <h5>
                                        <font color="blue">

                                            <?php
                                            if ($tipo != 4) { ?>
                                                <a href="#" onclick="ajaxRequestDocumentos(<?= $servicio->co_user_id ?>)"><?= $servicio->co_user->nombre ?></a>
                                            <?php echo $this->Html->link('<i class="fa fa-pencil" ></i>', array('action' => 'edit', $servicio->servicio_id), array('class' => 'btn btn-default', 'rel' => 'tooltip', 'title' => 'Editar Solicitante', 'escape' => false));
                                            } else {
                                                echo h($servicio->co_user->nombre);
                                            }
                                            ?>

                                        </font>
                                    </h5>
                                </div>
                            </div>
                            <div class="mail-box">
                                <!--<div class="mail-body">-->
                                <div class="mail-attachment" id="segundo">
                                    <?php echo  html_entity_decode(h($servicio->descripcion)) ?>
                                    <!--</div>-->

                                    <div class="attachment">
                                        <?php foreach ($adjuntos as $adjunto):
                                            if ($adjunto->comentario_id == 0) {
                                                $esimagen = explode(".", basename($adjunto->archivo));
                                                //$rutaDestino = 'upload/archivos/' . $adjunto->servicio_id . '/' . basename($adjunto->archivo);
                                                $rutaDestino = RUTA_PRINCIPAL . 'upload/archivos/' . $adjunto->servicio_id . '/' . basename($adjunto->archivo);
                                        ?>
                                                <div class="file-box">
                                                    <div class="file">
                                                        <a href="<?= $rutaDestino ?>" target="_blank" rel="noopener noreferrer">
                                                            <span class="corner"></span>

                                                            <!-- AQUI-->
                                                            <?php
                                                            if (end($esimagen) == 'png' || end($esimagen) == 'jpg') { ?>
                                                                <div class="image">
                                                                    <img alt="image" class="img-fluid" src="<?= $rutaDestino ?>">
                                                                </div>
                                                            <?php
                                                            } else { ?>
                                                                <div class="icon">
                                                                    <i style="color:tomato" class="fa fa-file"></i>
                                                                </div>
                                                            <?php }
                                                            ?>


                                                            <div class="file-name">
                                                                <?= $adjunto->archivo ?>

                                                            </div>
                                                        </a>
                                                    </div>

                                                </div>
                                        <?php
                                            }
                                        endforeach;
                                        ?>


                                        <div class="clearfix"></div>
                                    </div>
                                </div>

                                <div id="tercero">
                                    <?php foreach ($comentarios as $comentario): ?>
                                        <!--<div class="mail-body">-->
                                        <?php if ($tipo != 4 || $comentario->tipo == 1) { ?>
                                            <div class="mail-attachment">
                                                <?php echo date_format($comentario->created, "d-m-Y h:i A"); ?>
                                                <h5>
                                                    <font color="blue">
                                                        <?php 
                                                        if ($tipo != 4) {
                                                        echo h($comentario->co_user->nombre);
                                                        }else{
                                                            if ($comentario->co_user->co_group_id==2){
                                                                echo h($comentario->co_user->nombre);
                                                            }else{
                                                                echo h("Soporte TIC");
                                                            }
                                                            
                                                        }
                                                         ?>
                                                    </font>
                                                    <?php if ($comentario->tipo == 2) { ?>
                                                        <font color="grey">
                                                            <?php echo "[Nota Privada]" ?>
                                                        </font>
                                                    <?php } ?>
                                                </h5>
                                                <?php echo  html_entity_decode(h($comentario->texto)) ?>


                                                <div class="attachment">
                                                    <?php foreach ($adjuntos as $adjunto):
                                                        if ($adjunto->comentario_id == $comentario->comentario_id) {
                                                            $esimagen = explode(".", basename($adjunto->archivo));
                                                            //$rutaDestino = 'upload/archivos/' . $adjunto->servicio_id . '/' . basename($adjunto->archivo);
                                                            $rutaDestino = RUTA_PRINCIPAL . 'upload/archivos/' . $adjunto->servicio_id . '/' . basename($adjunto->archivo);
                                                    ?>
                                                            <div class="file-box">
                                                                <div class="file">
                                                                    <a href="<?= $rutaDestino ?>" target="_blank" rel="noopener noreferrer">
                                                                        <span class="corner"></span>

                                                                        <!-- AQUI-->
                                                                        <?php
                                                                        if (end($esimagen) == 'png' || end($esimagen) == 'jpg') { ?>
                                                                            <div class="image">
                                                                                <img alt="image" class="img-fluid" src="<?= $rutaDestino ?>">
                                                                            </div>
                                                                        <?php
                                                                        } else { ?>
                                                                            <div class="icon">
                                                                                <i style="color:tomato" class="fa fa-file"></i>
                                                                            </div>
                                                                        <?php }
                                                                        ?>


                                                                        <div class="file-name">
                                                                            <?= $adjunto->archivo ?>

                                                                        </div>
                                                                    </a>
                                                                </div>

                                                            </div>
                                                    <?php
                                                        }
                                                    endforeach;
                                                    ?>


                                                    <div class="clearfix"></div>
                                                </div>


                                            </div>
                                    <?php
                                        }
                                    endforeach; ?>
                                </div>
                                <?php
                                /*$myTemplates = [
                                'formStart' => '<form{{attrs}} class="form-horizontal">',
                                'inputContainer' => '<div class="form-group {{type}}{{required}}">{{content}}</div>',
                                'input' => '<div class="col-sm-9"><input type="{{type}}" name="{{name}}" class="form-control" {{attrs}}/></div>',
                                'label' => '<label  class="col-sm-3 control-label" {{attrs}}>{{text}}</label>',
                                'select' => '<div class="col-sm-9"><select name="{{name}}"{{attrs}} class="form-control">{{content}}</select></div>',
                                'selectMultiple' => '<div class="col-sm-9"><select name="{{name}}[]" multiple="multiple"{{attrs}} class="form-control">{{content}}</select></div>',
                                'textarea' => '<div class="col-sm-9"><textarea name="{{name}}"{{attrs}} class="form-control">{{value}}</textarea></div>',
                                'checkbox' => '<div class="col-sm-9 checkbox-div"><input type="checkbox" name="{{name}}"  value="{{value}}"{{attrs}}  ></div>',
                                'nestingLabel' => '<label class="col-sm-3 control-label checkbox-label" {{attrs}}>{{text}}</label>{{hidden}}{{input}}'
                            ];
                            $this->Form->templates($myTemplates);*/
                                ?>
                                <?php if ($usuarioNoPuedeResponder) { ?>
                                    <!--
                                        MODIFICACIÓN: un usuario solicitante no puede responder
                                        cuando el ticket tiene el estado cerrado (statu_id = 6).
                                        No se crea el formulario para evitar etiquetas abiertas y
                                        desbordamientos en la cuadrícula de Bootstrap.
                                    -->
                                    <div class="alert alert-warning m-t-md" role="alert">
                                        <i class="fa fa-lock"></i>
                                        Este ticket está cerrado y ya no permite enviar mensajes.
                                    </div>
                                <?php } else { ?>
                                    <?= $this->Form->create($comentarios, ['type' => 'file']) ?>

                                    <!-- MODIFICACIÓN: las columnas se agrupan dentro de una fila Bootstrap. -->
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <p>&nbsp;</p>
                                            <textarea name="texto" id="texto" class="summernote"></textarea>
                                        </div>

                                        <?php
                                        // Los identificadores reales se vuelven a validar y asignar en el controlador.
                                        echo $this->Form->hidden('servicio_id', ['value' => $servicio->servicio_id]);
                                        echo $this->Form->hidden('co_user_id', ['value' => $user]);
                                        echo $this->Form->hidden('usuario_notificar', ['value' => 1]);
                                        $ahora = date('Y-m-d H:i:s');
                                        echo $this->Form->hidden('fecha_creacion', ['value' => $ahora]);

                                        if ($agenteNotaPrivadaObligatoria) {
                                            // MODIFICACIÓN: el agente sólo puede enviar nota privada en un ticket cerrado.
                                            echo $this->Form->hidden('tipo', ['value' => 2, 'id' => 'tipo-comentario']);
                                        } else {
                                            echo $this->Form->hidden('tipo', ['value' => 1, 'id' => 'tipo-comentario']);
                                        }
                                        ?>

                                        <div class="col-sm-12">
                                            <div id="archivos">
                                                <!-- El primer campo se agrega automáticamente por JavaScript. -->
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mail-body text-right tooltip-demo">
                                        <?php if ((int)$tipo !== 4) { ?>
                                            <?php if ($agenteNotaPrivadaObligatoria) { ?>
                                                <!-- MODIFICACIÓN: marcada y bloqueada sólo como indicador visual. -->
                                                <input type="checkbox" id="nota-privada-bloqueada" checked="checked" disabled="disabled" />
                                                <label for="nota-privada-bloqueada">Nota Privada</label>
                                            <?php } else { ?>
                                                <input type="checkbox" id="nota-privada" name="tipo" value="2" />
                                                <label for="nota-privada">Nota Privada</label>
                                            <?php } ?>
                                        <?php } ?>

                                        <button
                                            title=""
                                            data-placement="top"
                                            data-toggle="tooltip"
                                            type="submit"
                                            name="Responder"
                                            data-original-title="Responder"
                                            class="btn btn-sm btn-white"
                                        >
                                            <i class="fa fa-reply"></i> Responder
                                        </button>
                                    </div>

                                    <?= $this->Form->end(); ?>
                                <?php } ?>





                            </div>



                        </div>

                    </div>
                </div>

                </div>
                <?php if ($tipo != 4) { ?>
                    <div class="col-lg-3 ticket-side-column">
                        <div class="ibox float-e-margins">

                            <div class="ibox-content">

                                <br>
                                <div class="">
                                    <!-- aqui va todo-->
                                    <?php
                                    $myTemplates = [
                                        'formStart' => '<form{{attrs}} class="form-horizontal">',
                                        'inputContainer' => '<div class="form-group {{type}}{{required}}">{{content}}</div>',
                                        'input' => '<div class="col-sm-12"><input type="{{type}}" name="{{name}}" class="form-control" {{attrs}}/></div>',
                                        'label' => '<label  class="col-sm-3 control-label" {{attrs}}>{{text}}</label>',
                                        'select' => '<div class="col-sm-12"><select name="{{name}}"{{attrs}} class="form-control">{{content}}</select></div>',
                                        'selectMultiple' => '<div class="col-sm-9"><select name="{{name}}[]" multiple="multiple"{{attrs}} class="form-control">{{content}}</select></div>',
                                        'textarea' => '<div class="col-sm-9"><textarea name="{{name}}"{{attrs}} class="form-control">{{value}}</textarea></div>',
                                        'checkbox' => '<div class="col-sm-9 checkbox-div"><input type="checkbox" name="{{name}}"  value="{{value}}"{{attrs}}  ></div>',
                                        'nestingLabel' => '<label class="col-sm-3 control-label checkbox-label" {{attrs}}>{{text}}</label>{{hidden}}{{input}}'
                                    ];
                                    $this->Form->templates($myTemplates);
                                    ?>
                                    <?= $this->Form->create($servicio) ?>



                                    <?php
                                    echo $this->Form->input('statu_id', ['label' => 'Estado', 'options' => $status]);
                                    echo $this->Form->input('prioridade_id', ['label' => 'Prioridad', 'options' => $prioridades]);
                                    echo $this->Form->input('tipo_incidencia_id', ['label' => 'Tipo', 'options' => $tipoIncidencias]);


                                    echo $this->Form->input('dependencia_id', ['options' => $dependencias]);
                                    echo $this->Form->input('direccione_id', ['label' => 'Dirección', 'options' => $direcciones]);
                                    //echo $this->Form->input('solicitante_id', ['options' => $solicitantes]);
                                    echo $this->Form->input('co_group_id', ['label' => 'Grupo', 'empty' => 'Seleccionar...', 'options' => $coGroups]); ?>
                                    <div id="post1">
                                        <?php
                                        echo $this->Form->input('agente', ['options' => $agentes]);
                                        echo $this->Form->input('grupo_id', ['label' => 'Módulo', 'options' => $grupos]);

                                        //echo $this->Form->input('agente',array('label'=>array('text'=>'Agente'),'options'=>array('text'=>'Seleccionar...')));
                                        ?>
                                    </div>

                                    <?php
                                    echo $this->Form->input('referencia', ['label' => 'Ticket OperGob']);


                                    //echo $this->Form->hidden('fuente',['value'=>1]);
                                    //echo $this->Form->hidden('fecha_creacion',['value'=>date("Y-m-d H:i:s")]);
                                    //echo $this->Form->hidden('co_user_id', ['value'=>$user]);
                                    //echo $this->Form->hidden('agente', ['options' => $agentes]);
                                    ?>
                                    <div class="form-group">
                                        <div class="col-sm-offset-3 col-sm-9">
                                            <?php echo $this->Form->button(__('<i class="fa fa-check-circle"></i> Actualizar'), array('type' => 'submit', 'class' => 'btn btn-primary', 'div' => false, 'escape' => false, 'name' => 'GuardarE')); ?>
                                        </div>
                                    </div>
                                    <?= $this->Form->end(); ?>

                                    <?php if (!empty($puedeVerBitacora)) { ?>
                                        <div class="text-center" style="margin-top: 18px;">
                                            <a href="#"
                                               data-toggle="modal"
                                               data-target="#modalBitacoraServicio"
                                               title="Consultar historial de cambios">
                                                <i class="fa fa-history"></i> Ver bitácora
                                            </a>
                                        </div>
                                    <?php } ?>
                                </div>

                            </div>
                        </div>

                    </div>
                <?php } ?>
            </div>
    </div>

    <?php if ($tipo != 4 && !empty($puedeVerBitacora)) { ?>
        <div class="modal fade" id="modalBitacoraServicio" tabindex="-1" role="dialog" aria-labelledby="tituloBitacoraServicio">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title" id="tituloBitacoraServicio">
                            <i class="fa fa-history"></i>
                            Bitácora del servicio #<?= h($servicio->servicio_id) ?>
                        </h4>
                    </div>

                    <div class="modal-body">
                        <?php if (!empty($detalleBitacora)) { ?>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Fecha</th>
                                            <th>Usuario</th>
                                            <th>Campo modificado</th>
                                            <th>Valor anterior</th>
                                            <th>Valor nuevo</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($detalleBitacora as $movimiento) { ?>
                                            <tr>
                                                <td><?= h($movimiento['fecha']) ?></td>
                                                <td>
                                                    <strong><?= h($movimiento['usuario']) ?></strong>
                                                    <?php if (!empty($movimiento['login']) && $movimiento['login'] !== $movimiento['usuario']) { ?>
                                                        <br>
                                                        <small class="text-muted"><?= h($movimiento['login']) ?></small>
                                                    <?php } ?>
                                                </td>
                                                <td><?= h($movimiento['campo']) ?></td>
                                                <td><?= h($movimiento['anterior']) ?></td>
                                                <td><?= h($movimiento['nuevo']) ?></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php } else { ?>
                            <div class="alert alert-info" style="margin-bottom: 0;">
                                No hay cambios registrados en la bitácora para este servicio.
                            </div>
                        <?php } ?>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">
                            Cerrar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>

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

            // MODIFICACIÓN: en tickets cerrados para usuario no existe formulario de respuesta.
            if (!contenedorArchivos) {
                return;
            }

            var input = document.createElement("input");
            input.type = "file";
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
    <script type="text/javascript">
        function ajaxRequestDocumentos(id) {

            eModal.ajax({
                method: "GET",
                size: 'md',
                url: "<?php echo Router::url(array('controller' => 'coUsers', 'action' => 'view_centro')) ?>" + "/" + id,
                buttons: [{
                    text: "Cerrar",
                    close: true,
                    style: "danger"
                }]
            }, "Usuarios");
        }

        function hola() {
            alert("prueba");
        }

        // MODIFICACIÓN: esta función debe permanecer dentro de la etiqueta <script>.
        function printBlocks() {

            // Bloques a imprimir (agrega los que quieras)
            var bloques = [
                "#primero",
                "#segundo",
                "#tercero"
            ];

            // Crear contenedor temporal
            var printContent = document.createElement("div");

            bloques.forEach(function(bloque) {
                var elemento = document.querySelector(bloque);
                if (elemento) {
                    var clone = elemento.cloneNode(true);
                    clone.style.marginBottom = "20px";
                    printContent.appendChild(clone);
                }
            });

            // Abrir ventana de impresión
            var ventana = window.open("", "", "width=900,height=700");
            ventana.document.write(`
        <html>
        <head>
            <title>Impresión</title>
            <link rel="stylesheet" href="/css/bootstrap.min.css">
            <link rel="stylesheet" href="/css/style.css">
        </head>
        <body>${printContent.innerHTML}</body>
        </html>
    `);
            ventana.document.close();
            ventana.focus();

            ventana.onload = function() {
                ventana.print();
                ventana.close();
            };
        }
    </script>
