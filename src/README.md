# Php/src
Some php usefull scripts

# A Little Helper Snippet
Source file: `alittlehelpersnippet.php`

These snippets allows you to debug your php code to find bottlenecks easily.

#### How it works:
Inside the file there are 3 snippet of code, divided into 2 sections: **data getter code** and **data output code**.

##### Data getter code
Data getter code section contains 2 snippet of code, one generalized for any PHP environment, and one specified for use in a WordPress theme/plugin.
You need to insert this snippet at least 2 times in all of your PHP-included files. 
To get better results I suggest you to insert it at least every 5-10 function calls.

###### Generalized
```
/* A LITTLE HELPER SNIPPET GENERAL */
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
/* / A LITTLE HELPER SNIPPET GENERAL */
```

###### For WordPress
```
/* A LITTLE HELPER SNIPPET FOR WordPress */
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
/* / A LITTLE HELPER SNIPPET FOR WordPress */
```

##### Data output code
Data output code is the code needed in order to print out the debugging infos
```
global $memoryFUNC;
$precVal = 0;
foreach($memoryFUNC as $mem){
	$vars = isset($mem['vars']) ? $mem['vars'] : 'n.d.';
	echo $mem['file'].' - '.$mem['val'].' KB - differenza dal precedente: <b>'.($mem['val'] - $precVal).'</b>, vars: '.$vars.', time elapsed: '.$mem['time'].'<br />';
	$precVal = $mem['val'];
};
$memoryFUNC = null;
```

But if you haven't a test server, you can hide the output for common users and restrict it to your IP or behind a custom query string parameter
```
if(isset($_GET['outdebug'])){
	global $memoryFUNC;
	$precVal = 0;
	foreach($memoryFUNC as $mem){
		$vars = isset($mem['vars']) ? $mem['vars'] : 'n.d.';
		echo $mem['file'].' - '.$mem['val'].' KB - differenza dal precedente: <b>'.($mem['val'] - $precVal).'</b>, vars: '.$vars.', time elapsed: '.$mem['time'].'<br />';
		$precVal = $mem['val'];
	};
	$memoryFUNC = null;
}
```
