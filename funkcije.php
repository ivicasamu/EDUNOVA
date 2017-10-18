<?php  
function provjeraLogin(){
	if(!isset($_SESSION["logiran"])){
		header("location: " . $GLOBALS["putanjaAPP"] ."javno/prijava.php?nemateOvlasti");
		exit;
	}
}

function provjeraUloga($uloga){
	if(!(isset($_SESSION["logiran"]) && $_SESSION["logiran"]->uloga===$uloga)){
		header("location:" .$GLOBALS["putanjaAPP"] . "privatno/nadzornaPloca.php");
		exit;
	}
}

function dohvatiOIB(){
	/* Use internal libxml errors -- turn on in production, off for debugging */
	libxml_use_internal_errors(true);
	/* Createa a new DomDocument object */
	$dom = new DomDocument;
	/* Load the HTML */
	$dom->loadHTMLFile("http://oib.itcentrala.com/oib-generator/");
	/* Create a new XPath object */
	$xpath = new DomXPath($dom);
	/* Query all <td> nodes containing specified class name */
	$nodes = $xpath->query("/html/body/div[1]/div[1]/text()");
	/* Traverse the DOMNodeList object to output each DomNode's nodeValue */
	foreach ($nodes as $i => $node) {
		return  $node->nodeValue;
	}
}

?>