<?php

function dropdowna($intIdField, $strNameField, $strTableName, $strOrderField, $strNameOrdinal, $userid, $strMethod="asc") {

   //
   // PHP DYNAMIC DROP-DOWN BOX - HTML SELECT
   //
   // 2006-05, 2008-09, 2009-04 http://kimbriggs.com/computers/
   //
   // Function creates a drop-down box
   // by dynamically querying ID-Name pair from a lookup table.
   //
   // Parameters:
   // intIdField = Integer "ID" field of table, usually the primary key.
   // strMethod = Sort as asc=ascending (default) or desc for descending.
   // strNameField = Name field that user picks as a value.
   // strNameOrdinal = For multiple drop-downs to same table on same page (Ex: strNameField.$i)
   // strOrderField = Which field you want results sorted by.
   // strTableName = Name of MySQL table containing intIDField and strNameField.
   //
   // Returns:
   // HTML Drop-Down Box Mark-up Code
   //

   echo "<select name=\"$strNameOrdinal\">\n";
   echo "<option value=\"NULL\"></option>\n";

   $strQuery = "select $intIdField, $strNameField
               from $strTableName
			   where id = $userid";

   $rsrcResult = mysql_query($strQuery);

   while($arrayRow = mysql_fetch_assoc($rsrcResult)) {
      $strA = $arrayRow["$intIdField"];
      $strB = $arrayRow["$strNameField"];
      echo "<option value=\"$strA\">$strB</option>\n";
   }

   echo "</select>";
}

?>
