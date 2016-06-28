<?php

function Renombrar($dni,$directorio)
{

    require_once 'clsConexion.php';
    $obj= new Conexion();
    
    $sql="select id_person from person where num_doc='".$dni."' limit 1";
    
    $resul=$obj->Consultar($sql);
    if($reg=$resul->fetch())
    {    
        $dni=getcwd()."/photos/".$dni.".jpg";
        $aux=getcwd()."/photos/".$reg['id_person'].".jpg";

        echo getcwd()."/photos/";

        rename($dni,$aux);
        echo $dni." --> ". $aux ."<br>";
    }else{
        echo $dni. '<br>';
    }
}

function UpdateNombre($cod_person)
{    
    require_once 'clsConexion.php';
    $obj= new Conexion();

    $sql="update person set photo_url="."'1'"." where id_person=".$cod_person;
    
    $reg=$obj->Consultar($sql);
    if($reg!=null)
    {
        echo"<br>Actualizado: ". $cod_person;
    }else{

        echo $cod_person;
    }

}

function BuscaIdPerson()
{

    //ruta actual 
    $directorio = opendir("./photos2/"); 
    $count=0;
    //obtenemos un archivo y luego otro sucesivamente
    while ($archivo = readdir($directorio)) 
    {
        if (is_dir($archivo))//verificamos si es o no un directorio
         {
            #echo "[".$archivo ."]<br />"; //de ser un directorio lo envolvemos entre corchetes
         }
        else
        { 
            $archivo2=array_values(explode(".",$archivo))[0];
            $extension=array_values(explode(".",$archivo))[1];
              
            if ($extension=='jpg')
            {
               #Renombrar($archivo2,$directorio);                
               UpdateNombre($archivo2);
            }

        }
       
    }
}

BuscaIdPerson();

?>