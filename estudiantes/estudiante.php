<?php

class Estudiante{

    public $id;
    public $name;
    public $apellido;
    public $carrera;
    public $status;
    public $materiaFavorita;
    public $profilePhoto;

    function __construct($id,$name,$apellido,$carrera,$status,$materiaFavorita)
    {
        
        $this->id = $id;
        $this->name = $name;
        $this->apellido=$apellido;
        $this->carrera = $carrera;
        $this->status = $status;
        $this->materiaFavorita = $materiaFavorita;

    }

    public function getTextCarrera(){

        $utilities = new Utilities();

        if($this->carrera != 0 && $this->carrera !=null){
            return $utilities->carrera[$this->carrera];
        }else{
            return "";       
        }
    }

    public function getTextMateriaFavorita(){       

        if( !empty($this->materiaFavorita) && $this->materiaFavorita !=null){
            return implode(",",$this->materiaFavorita);
        }

        return "";      

    }
   
}

?>