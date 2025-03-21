

                    <br>
    <!-- ****************************************** -->
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5><i class="fa fa-th"></i> <?= __('Detalle del Usuario'); ?> </h5>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="btn-toolbar" role="toolbar">



                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="">
                        <table class="table table-striped table-detalle" style="width: 100%;">
                            <tbody>
                                <tr>
                                    <td class="field"><?= __('Nombre') ?></td>
                                    <td><?= h($coUser->nombre) ?></td>
                                </tr>
                                <tr>
                                    <td class="field"><?= __('Email') ?></td>
                                    <td><?= h($coUser->email) ?></td>
                                </tr>
                                <tr>
                                    <td class="field"><?= __('Teléfono') ?></td>
                                    <td><?= h($coUser->telefono) ?></td>
                                </tr>
                                <tr>
                                    <td class="field"><?= __('Dependencia') ?></td>
                                    <td><?= h($coUser->dependencia->nombre) ?></td>
                                </tr>
                                <tr>
                                    <td class="field"><?= __('Dirección') ?></td>
                                    <td><?= h($coUser->direccione->nombre) ?></td>
                                </tr>
                                <tr>
                                    <td class="field"><?= __('Edificio') ?></td>
                                    <td><?= h($coUser->edificio) ?></td>
                                </tr>
                                <tr>
                                    <td class="field"><?= __('Ubicacion Fisica') ?></td>
                                    <td><?= h($coUser->ubicacion_fisica) ?></td>
                                </tr>
                                <tr>
                                    <td class="field"><?= __('Ult. inicio de sesión') ?></td>
                                    <td><?= h($coUser->last_login) ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>

        </div>
    </div>
    <!-- ****************************************** -->



