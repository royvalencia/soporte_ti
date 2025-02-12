<%
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.1.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
use Cake\Utility\Inflector;

$associations += ['BelongsTo' => [], 'HasOne' => [], 'HasMany' => [], 'BelongsToMany' => []];
$immediateAssociations = $associations['BelongsTo'];
$associationFields = collection($fields)
    ->map(function($field) use ($immediateAssociations) {
        foreach ($immediateAssociations as $alias => $details) {
            if ($field === $details['foreignKey']) {
                return [$field => $details];
            }
        }
    })
    ->filter()
    ->reduce(function($fields, $value) {
        return $fields + $value;
    }, []);

$groupedFields = collection($fields)
    ->filter(function($field) use ($schema) {
        return $schema->columnType($field) !== 'binary';
    })
    ->groupBy(function($field) use ($schema, $associationFields) {
        $type = $schema->columnType($field);
        if (isset($associationFields[$field])) {
            return 'string';
        }
        if (in_array($type, ['integer', 'float', 'decimal', 'biginteger'])) {
            return 'number';
        }
        if (in_array($type, ['date', 'time', 'datetime', 'timestamp'])) {
            return 'date';
        }
        return in_array($type, ['text', 'boolean']) ? $type : 'string';
    })
    ->toArray();

$groupedFields += ['number' => [], 'string' => [], 'boolean' => [], 'date' => [], 'text' => []];
$pk = "\$$singularVar->{$primaryKey[0]}";
%>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2><?= __('<%= $pluralHumanName %>') ?></h2>                     
    </div>
    <div class="col-lg-2"> </div>
 </div>
 <div class="wrapper wrapper-content animated fadeInRight">     
    <div class="row">
        <div class="col-lg-12">
          <div class="ibox float-e-margins">
               <div class="ibox-title">
                 <h5><i class="fa fa-th"></i> <?= __('Detalle de  <%= $singularHumanName %>');?> </h5>                    
               </div>               
            <div class="ibox-content">   
               <div class="row">
                <div class="col-md-12">
                  <div class="btn-toolbar" role="toolbar">
                    <div class="btn-group pull-right"> 
                       
                        <?php echo $this->Html->link('<i class="fa fa-edit"></i>', array('action' => 'edit', <%= $pk %>), array('class' => 'btn btn-default','rel' => 'tooltip','title' => 'Editar','escape' => false)); ?>
                        <?php echo $this->Form->postLink('<i class="fa fa-trash-o"></i>', array('action' => 'delete',<%= $pk %>), array('class' => 'btn btn-default','rel' => 'tooltip','title' => 'Eliminar','escape' => false), __('¿Seguro que desea eliminar el registro # %s?', <%= $pk %>)); ?> 
                        <?php echo $this->Html->link('<i class="fa fa-plus" ></i>', array('action' => 'add'), array('class' => 'btn btn-default','rel' => 'tooltip','title'=>'Agregar','escape' => false)); ?>
                        <?php echo $this->Html->link('<i class="fa fa-list" ></i>', array('action' => 'index'), array('class' => 'btn btn-default','rel' => 'tooltip','title'=>'Lista de <%= $pluralHumanName %>','escape' => false)); ?> 
                     </div>
<%
                        $done = array();
                        foreach ($associations as $type => $data) {
                            foreach ($data as $alias => $details) {
                                if ($details['controller'] != $this->name && !in_array($details['controller'], $done)) {
                           %>
                             <div class="btn-group pull-right">                                                                   
                                  <?php
                                    echo $this->Html->link( '<i class="fa fa-list-ul"></i>', array('controller' => '<%= $details['controller'] %>', 'action' => 'index'), array('class' => 'btn btn-default','escape'=>false,'rel'=>'tooltip', 'title'=>'Lista de <%= $this->_pluralHumanName($alias) %>'));
                                    echo $this->Html->link( '<i class="fa fa-plus-circle"></i>', array('controller' => '<%= $details['controller'] %>', 'action' => 'add'), array('class' => 'btn btn-default','escape'=>false,'rel'=>'tooltip', 'title'=>'Nuevo <%= Inflector::humanize(Inflector::singularize(Inflector::underscore($alias))) %> '));
                                   
                                 ?>                               
                              </div>    
                           <%    
                               $done[] = $details['controller'];  
                                }
                            }
                        }
%>                      
                   </div> 
                </div>
            </div>
            <br>      
             <div class="">
                 <table class="table table-striped table-detalle" style="width: 100%;">
                  <tbody>
<% foreach ($fields as $field) : %>
<% if (isset($associationFields[$field])) :
            $details = $associationFields[$field];
            %>
                    <tr>
                        <td class="field"><?= __('<%= Inflector::humanize($details['property']) %>') ?></td>
                        <td><?= $<%= $singularVar %>->has('<%= $details['property'] %>') ? $this->Html->link($<%= $singularVar %>-><%= $details['property'] %>-><%= $details['displayField'] %>, ['controller' => '<%= $details['controller'] %>', 'action' => 'view', $<%= $singularVar %>-><%= $details['property'] %>-><%= $details['primaryKey'][0] %>]) : '' ?></td>
                    </tr>
            <% else : %>
                    <tr>
                        <td class="field"><?= __('<%= Inflector::humanize($field) %>') ?></td>
                        <td><?= h($<%= $singularVar %>-><%= $field %>) ?></td>
                    </tr>
<% endif; %>
<% endforeach; %>
<% if ($associations['HasOne']) : %>
    <%- foreach ($associations['HasOne'] as $alias => $details) : %>
                <tr>
                    <td class="field"><?= __('<%= Inflector::humanize(Inflector::singularize(Inflector::underscore($alias))) %>') ?></td>
                    <td><?= $<%= $singularVar %>->has('<%= $details['property'] %>') ? $this->Html->link($<%= $singularVar %>-><%= $details['property'] %>-><%= $details['displayField'] %>, ['controller' => '<%= $details['controller'] %>', 'action' => 'view', $<%= $singularVar %>-><%= $details['property'] %>-><%= $details['primaryKey'][0] %>]) : '' ?></td>
                </tr>
    <%- endforeach; %>
<% endif; %>
              </tbody>  
            </table>
             </div>
<%
$relations = $associations['HasMany'] + $associations['BelongsToMany'];
foreach ($relations as $alias => $details):
    $otherSingularVar = Inflector::variable($alias);
    $otherPluralHumanName = Inflector::humanize(Inflector::underscore($details['controller']));
    %>
      <div class="row">
        <div class="related col-sm-10 col-sm-offset-2">
            <h3><?= __('Related <%= $otherPluralHumanName %>') ?></h3>
            <?php if (!empty($<%= $singularVar %>-><%= $details['property'] %>)): ?>
            <table class="table" cellpadding="0" cellspacing="0">
                <tr>
    <% foreach ($details['fields'] as $field): %>
                    <th><?= __('<%= Inflector::humanize($field) %>') ?></th>
    <% endforeach; %>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
                <?php foreach ($<%= $singularVar %>-><%= $details['property'] %> as $<%= $otherSingularVar %>): ?>
                <tr>
                <%- foreach ($details['fields'] as $field): %>
                    <td><?= h($<%= $otherSingularVar %>-><%= $field %>) ?></td>
                <%- endforeach; %>
                <%- $otherPk = "\${$otherSingularVar}->{$details['primaryKey'][0]}"; %>
                    <td class="actions">
                       <div class="btn-toolbar">
                          <div class="btn-group">
                            <?= $this->Html->link(__('Ver'), ['controller' => '<%= $details['controller'] %>', 'action' => 'view', <%= $otherPk %>],['class' => 'btn btn-default btn-sm']) ?>
                            <?= $this->Html->link(__('Editar'), ['controller' => '<%= $details['controller'] %>', 'action' => 'edit', <%= $otherPk %>],['class' => 'btn btn-default btn-sm']) ?>
                            <?= $this->Form->postLink(__('Eliminar'), ['controller' => '<%= $details['controller'] %>', 'action' => 'delete', <%= $otherPk %>], ['class' => 'btn btn-default btn-sm','confirm' => __('¿Seguro que desea eliminar el registro # {0}?', <%= $otherPk %>)]) ?>
                          </div>  
                       </div> 
                    </td>
                </tr>
                <?php endforeach; ?>
            </table>
            <?php endif; ?>
        </div>
       </div> 
    <% endforeach; %>

             </div>
          </div>
               
        </div>
    </div>
</div>    