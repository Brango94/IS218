<?php

$qname=$_POST["qname"];
$qbody=$_POST["qbody"];
$qskill=$_POST["qskill"];
$skillarr=explode(",", $qskill);

if ($qname==""){
    echo "Question name is empty<br>";
}

elseif (strlen($qname)<3){
    echo "Need at least 3 characters<br>";
}

else {
	echo "Your question is $qname<br>";
}

if ($qbody==""){
    echo "Question body is empty<br>";
}

elseif (strlen($qbody)>=500){
    echo "Needs to be less than 500 characters<br>";
}

else {
	echo "Your Question Body is $qbody<br>";
}

if (count($skillarr)>=2){
	print_r($skillarr);
}

else {
	echo "Enter at least 2 skills";
}

?>