<?php
namespace App\Model\Table;

use Cake\ORM\Table;

class Dependencias2Table extends Table
{
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('dependencias2'); // Nombre exacto de la tabla en la BD
        $this->setPrimaryKey('id'); // Cambia 'id' si tu PK tiene otro nombre
        $this->setDisplayField('nombre'); // Cambia 'nombre' por el campo que quieres mostrar
    }
}