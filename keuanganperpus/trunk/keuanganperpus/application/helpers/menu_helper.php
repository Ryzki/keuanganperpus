<?php
 function setul($xidCSS,$xIsi){
   return '<ul id= "'.$xidCSS.'">'.$xIsi.'</ul>';
 }

function setli($xhref,$xIsi,$xSub=''){
   return '<li> <a href = "'.$xhref.'" title = "'.$xIsi.'" >'.$xIsi.'</a>'.$xSub.'</li>';
 }


 
function setlionclick($xFunction,$xIsi,$xSub=''){
   return '<li> <a href = "#" onclick="'.$xFunction.'" title = "'.$xIsi.'" >'.$xIsi.'</a>'.$xSub.'</li>';
 } 
  
 function setultree($xidCSS,$xIsi){
   return "\n".'<ul '.$xidCSS.'>'.$xIsi.'</ul>'."\n";
 }

 function setlitree($xhref,$xIsi,$xSub=''){
   //return '<li> <a href ="">'.$xIsi.'</a>'.$xSub.'</li>';
   return '<li class="closed"> '.$xIsi.''.$xSub.'</li>';
 }

 function setlitreechk($id,$xIsi,$xSub=''){
  // return '<li> <input type="checkbox" name="mn'.$id.'" value="'.$id.'" id="mn'.$id.'">'.$xIsi.''.$xSub.'</li>  ';
   return '<li> <input type="checkbox" name="mn'.$id.'" value="'.$id.'" />'.$xIsi.''.$xSub.'</li>'."\n";
 }
?>
