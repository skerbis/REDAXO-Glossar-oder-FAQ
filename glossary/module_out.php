<?php
// REDAXO Glossary or FAQ for yform
// Creator: Thomas Skerbis, KLXM Crossmedia GmbH
// Version: 1.0 
// License: Public domain 

$db_table = "rex_glossar";
$sql = rex_sql::factory();
$sql->setDebug(false); //Ausgabe Query true oder false
$query = "SELECT * FROM $db_table  ORDER BY Begriff ";
$sql->setQuery($query, array($id));
$counter = $bcounter = 1;
if (count($sql)) {
// Wenn Datensätze im $sql vorliegen 
foreach($sql as $row)
{
 $id = $row->getValue("id");
 $begriff = $row->getValue("Begriff");
 $char = strtoupper(substr($begriff,0,1)); // Erster Buchstabe
 $beschreibung = $row->getValue("beschreibung");
 # $beschreibung = nl2br($beschreibung); // wenn nur eine Textarea ohne WYSIWYG verwendet wird
 $counter++;
 // Ausgabe des Buchstabens, wenn in $dummy nicht bereits vorhanden. 
 if ($char != $dummy) { 
    $bcounter++;   
    $buchstabe ='<h2 id="buchstabe'.$char.'">'.$char. '</h2>'; 
    $index .= '<a type="button" class="btn btn-default" href="#buchstabe'.$char.'">'.$char. '</a>';
    // Erstellt Links für das Alphabet am Anfang 
 } 
 else {$buchstabe = "";}
// Ausgabe als Bootstrap Panel
$out .= $buchstabe.' 
<div class="panel panel-default">
            <div class="panel-heading">
              <a data-toggle="collapse" data-parent="#accordionREX_SLICE_ID" href="#collapse'.$counter.'">'.$begriff.'</a>
            </div>
            <div id="collapse'.$counter.'" class="panel-collapse collapse">
                <div class="panel-body">'.$beschreibung.'
                </div>
            </div>
        </div>';
//dummy nimmt den aktuellen Buchstaben auf. 
$dummy = $char;

 } 
echo $index; // gibt Schnellinks als Alphabet aus
echo $out; // Ausgabe der Panels und Überschriften
}
?>
