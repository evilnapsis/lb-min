<?php
/**
@author: evilnapsis
@brief: Funcion para automatizar codigo de twitter bootstrap
**/

class Bs {
	// funcion para crear campos en los formularios
	public static function fginput($label,$value,$type,$name_id,$required,$cl='form-control'){
       $html="";
       $html.= '<div class="form-group">';
       if($type!='hidden'){

       $html.='<label for="'.$name_id.'">'.$label.'</label>';
       }
       $html.='<input type="'.$type.'" required name="'.$name_id.'" value="'.$value.'" class="'.$cl.'" id="'.$name_id.'" placeholder="'.$label.'">';
       $html.='</div>';
       return $html;
   }

   // funcion para crear botones
   public static function button($title,$t,$btn='default',$size='md'){
   	return '<button type="'.$t.'" class="btn btn-'.$btn.' btn-'.$size.'">'.$title.'</button>';
   }
   public static function a($title,$href,$btn='default',$size='md'){
   	return '<a href="'.$href.'" class="btn btn-'.$btn.' btn-'.$size.'">'.$title.'</a>';
   }

   public static function render_new($schema,$action="add"){
		foreach($schema as $su=>$sub){
      if(in_array($action, explode(",", $sub["actions"]))){
			 echo Bs::fginput($sub["label"],"",$sub["form"],$su,$sub["required"]);
      }
		}
   }

   public static function render_edit($schema,$datamodel,$action="edit"){
    foreach($schema as $su=>$sub){
      if(in_array($action, explode(",", $sub["actions"]))){
        echo Bs::fginput($sub["label"],$datamodel->{$su},$sub["form"],$su,$sub["required"]);
      }
    }
   }

}

?>