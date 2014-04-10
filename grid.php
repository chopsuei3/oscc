<?php
function ImageGrid(&$im,$startx,$starty,$width,$height,$xcols,$yrows,&$color) {

for ( $x=0; $x < $xcols; $x++ ) {
   for ( $y=0; $y < $yrows; $y++ ) {
      $x1 = $startx + ($width * $x);
      $x2 = $startx + ($width * ($x+1));
      $y1 = $starty + ($height * $y);
      $y2 = $starty + ($height * ($y+1));
      ImageRectangle($im, $x1, $y1, $x2, $y2, $color);
   }
}

} // end function ImageGrid
?>