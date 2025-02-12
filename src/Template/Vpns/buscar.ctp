<table class="table table-striped table-hover table-index">
                             <thead>
                                 <tr>
                                     <th><?= $this->Paginator->sort('vpn_id','No VPN') ?> <i
                                             class="fa fa-sort fa-1"></i></th>
                                     <th><?= $this->Paginator->sort('responsable') ?> <i class="fa fa-sort fa-1"></i>
                                     </th>
                                     <th><?= $this->Paginator->sort('fecha_entrega','Fecha de Entrega') ?> <i class="fa fa-sort fa-1"></i>
                                     </th>
                                     <th><?= $this->Paginator->sort('cat_institucione_id','Dependencia') ?> <i class="fa fa-sort fa-1"></i>
                                     </th>
                                     <th><?= $this->Paginator->sort('usuario','Usuario') ?> <i class="fa fa-sort fa-1"></i></th>
                                     <th><?= $this->Paginator->sort('pass','Contraseña') ?> <i class="fa fa-sort fa-1"></i></th>
                                     <th><?= $this->Paginator->sort('observaciones') ?> <i class="fa fa-sort fa-1"></i></th>
                                     <th><?= $this->Paginator->sort('co_user_id','Registró') ?> <i class="fa fa-sort fa-1"></i></th>
                    
                                     <th class="actions"><?= __('Acciones') ?></th>
                                 </tr>
                             </thead>
                             <tbody>
                                 <?php foreach ($vpns as $vpn): ?>
                                 <tr>
                                     <td><?= $this->Number->format($vpn->vpn_id) ?></td>
                                     <td><?= $vpn->responsable ?></td>
                                     <td><?= h(date_format($vpn->fecha_entrega,'Y-m-d')) ?></td>
                                     <td><?= $vpn->cat_institucione->nombre ?></td>
                                     <td><?= $vpn->usuario ?></td>
                                     <td><?= $vpn->pass ?></td>
                                     <td><?= $vpn->observaciones ?></td>
                                     <td class="actions">
                                         <?= $this->Html->link(__('<i class="fa fa-cogs" ></i>'), ['action' => 'view', $vpn->vpn_id], ['class' => 'btn btn-default btn-sm','rel' => 'tooltip','title'=>'Ver','escape' => false]) ?>
                                     </td>
                                 </tr>
                                 <?php endforeach; ?>
                             </tbody>
                         </table>
                     </div>