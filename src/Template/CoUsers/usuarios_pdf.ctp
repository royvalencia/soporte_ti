<?php
//define('FPDF_FONTPATH',APP.'Vendor/pdf/font/');
//Importamos los PDF de esta forma, ya no hay Vendors
require_once(ROOT .DS. 'vendor' . DS  . 'fpdf' . DS  . 'fpdf_table.php'); 
require_once(ROOT .DS. 'vendor' . DS  . 'fpdf' . DS  . 'table_def.php');
$this->layout = false; //Desactivamos el layout para enviar directo al navegador
 
 $table_def = new fpdf_table_def(); //Definiciones
 
 

 $fpdf = new FPDF_TABLE('L','mm','Letter'); //270 mm mide de alto la hoja t carta
//$fpdf->init();
      $fpdf->AddPage();
     // $fpdf->FPDF("P");
    $fpdf->SetFont('Arial','B',14);
  //  $fpdf->Cell(40,10,$data);
    
      $columns = 7; //(Columnas de la tabla) //Informacion del reporte
        //we initialize the table class
        $fpdf->Table_Init($columns, true, true); //Inicializamos la tabla
        $table_subtype = $table_def->table_default_table_type; //Formato de la tabla en gral
        $fpdf->Set_Table_Type($table_subtype);
       
        //TABLE HEADER SETTINGS
        $header_subtype = $table_def->table_default_header_type; //Formato del encabezado
        for($i=0; $i<$columns; $i++) $header_type[$i] = $table_def->table_default_header_type;
        $header_type[0]['WIDTH'] = 10;   //Tamanio de la celda mm
        $header_type[1]['WIDTH'] = 30;
        $header_type[2]['WIDTH'] = 50;
        $header_type[3]['WIDTH'] = 50;
        $header_type[4]['WIDTH'] = 40;
        $header_type[5]['WIDTH'] = 20;
        $header_type[6]['WIDTH'] = 30;

        //Contenido del Encabezado
        $header_type[0]['TEXT'] = "ID";        
        $header_type[1]['TEXT'] = "Login";
        $header_type[2]['TEXT'] = "Nombre";        
        $header_type[3]['TEXT'] = "Email";
        $header_type[4]['TEXT'] = "Grupo";
        $header_type[5]['TEXT'] = "Activo";
        $header_type[6]['TEXT'] = "Utl. Acceso";

   
        //set the header type
           $fpdf->Set_Header_Type($header_type);
        $fpdf->Draw_Header();
        
        //TABLE DATA SETTINGS- DATOS DE LA TABLA (CONTENIDO)
      //  $table_def->table_default_data_type['T_SIZE']=7;
        $data_subtype = $table_def->table_default_data_type; //Formato de los datos
        $data_type = Array();//reset the array
        for ($i=0; $i<$columns; $i++) $data_type[$i] = $data_subtype;
        $fpdf->Set_Data_Type($data_type);
        
     foreach ($usuarios as $usuario){  
                $data = Array();
                     $data[0]['TEXT'] = $usuario->co_user_id;                     
                     $data[1]['TEXT'] = $usuario->login;
                     $data[2]['TEXT'] = $usuario->nombre;
                     $data[3]['TEXT'] = $usuario->email;
                     $data[4]['TEXT'] = $usuario->co_group->name;
                     $data[5]['TEXT'] = $usuario->active;
                     $data[6]['TEXT'] = $usuario->last_login;
                     // $data[0]['T_SIZE']='24';
                  //$data[0]['LN_SIZE']='24';
                  //$data[0]['COLSPAN']    =$columns;        
                  $fpdf->Draw_Data($data); //Agregamos cada arregl  de datos (Filas de la tabla)
      }
                 
     $fpdf->Draw_Table_Border(); //Dibujamos el borde (LA TABLA) 
    $fpdf->Output('Prueba.pdf','D');
?>

          
	
