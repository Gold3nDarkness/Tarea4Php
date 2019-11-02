<?php

class Utilities
{

    public $carrera = [1 => "Redes", 2=>"Software",3=>"Multimedia",4=>"Mecatronica",5=>"Seguridad Informatica"];

    public function getLastElement($list)
    {
        $countList = count($list);
        $lastElement = $list[$countList - 1];

        return $lastElement;
    }

    public function searchProperty($list, $property, $value)
    {
        $filter = [];

        foreach ($list as $item) {

            if ($item->$property == $value) {
                array_push($filter, $item);
            }
        }

        return $filter;
    }

    public function getIndexElement($list, $property, $value)
    {
        $index = 0;
      
        foreach ($list as $key => $item) {

            if ($item->$property == $value) {
                $index = $key;
                break;
            }           
        }
        return $index;
    }

    public function uploadImage($directory, $name, $tmpFile, $type, $size)
    {
        $isSuccess = false;
        if ((($type == "image/gif")
                || ($type == "image/jpeg")
                || ($type == "image/png")
                || ($type == "image/jpg")
                || ($type == "image/JPG")
                || ($type == "image/pjpeg"))
            && ($size < 1000000)
        ) {
            if (!file_exists($directory)) {
                mkdir($directory, 0777, true);
                if (file_exists($directory)) {
                    if (file_exists($name)) {
                        unlink($name);
                    }
                    move_uploaded_file($tmpFile,  $name);
                    $isSuccess = true;
                }
            } else {
                if (file_exists($name)) {
                    unlink($name);
                }
                move_uploaded_file($tmpFile, $name);
                $isSuccess = true;
            }
        } else {
            $isSuccess = false;
        }
        return $isSuccess;
    }
    function Carrera($estudiante){
        if($estudiante->carrera==1){
            return "Redes";
        }
        else if($estudiante->carrera==2){
            return "Software";
        }
        else if($estudiante->carrera==3){
            return "Multimedia";
        }
        else if($estudiante->carrera==4){
            return "Mecatronica";
        }
        else if($estudiante->carrera==5){
            return "Seguridad Informatica";
        }
        else{
            return "nbsp;";
        }
        }
}
