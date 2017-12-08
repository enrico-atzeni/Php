<?php
/*

	-	SECTION 1: data getter code
	-	SECTION 2: data output code




	************************************************************
	************************************************************
	*****************		SECTION 1		********************
	************************************************************
	************************************************************


	DEBUG CODE:
		paste it in separate sections of your template

*/
?>


<?php /* A LITTLE HELPER SNIPPET GENERAL */
global $memoryFUNC,$microTimePre;
if(!$memoryFUNC)
	$memoryFUNC = array();
$SUPER_DEBUG_CONT = isset($SUPER_DEBUG_CONT) ? $SUPER_DEBUG_CONT+1 : 0;
$thisVal = array('file' => __FILE__.':'.$SUPER_DEBUG_CONT, 'val' => (memory_get_peak_usage(true) / 1024),'vars'=>count(array_keys(get_defined_vars())));
$microTimePost = round(microtime(true) *1000);
if(isset($microTimePre)){
	$thisVal['time'] = ($microTimePost-$microTimePre);
	$microTimePre = $microTimePost;
}else $microTimePre = $microTimePost;
array_push($memoryFUNC, $thisVal);
/* / A LITTLE HELPER SNIPPET GENERAL */ ?>





<?php /* A LITTLE HELPER SNIPPET FOR WordPress */
global $memoryFUNC,$microTimePre;
if(!$memoryFUNC)
	$memoryFUNC = array();
$SUPER_DEBUG_CONT = isset($SUPER_DEBUG_CONT) ? $SUPER_DEBUG_CONT+1 : 0;
$thisVal = array('file' => str_replace(ABSPATH,'',__FILE__).':'.$SUPER_DEBUG_CONT, 'val' => (memory_get_peak_usage(true) / 1024),'vars'=>count(array_keys(get_defined_vars())));
$microTimePost = round(microtime(true) *1000);
if(isset($microTimePre)){
	$thisVal['time'] = ($microTimePost-$microTimePre);
	$microTimePre = $microTimePost;
}else $microTimePre = $microTimePost;
array_push($memoryFUNC, $thisVal);
/* / A LITTLE HELPER SNIPPET FOR WordPress */ ?>





<?php
/*







	************************************************************
	************************************************************
	*****************		SECTION 2		********************
	************************************************************
	************************************************************


	OUTPUT RESULTS:
		paste it in the very end of your template (ex: footer.php)
		I used $_GET['debug'] to print it only when i pass the "debug" querystring to the url, like adding ?debug

*/
?>


<?php if(isset($_GET['debug'])){
	global $memoryFUNC;
	$precVal = 0;
	foreach($memoryFUNC as $mem){
		$vars = isset($mem['vars']) ? $mem['vars'] : 'n.d.';
		echo $mem['file'].' - '.$mem['val'].' KB - differenza dal precedente: <b>'.($mem['val'] - $precVal).'</b>, vars: '.$vars.', time elapsed: '.$mem['time'].'<br />';
		$precVal = $mem['val'];
	};
	$memoryFUNC = null;
} ?>

