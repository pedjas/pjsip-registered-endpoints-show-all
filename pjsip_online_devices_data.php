<?php
/**********************************************************
PJSIP Online Devices - Data
Author: Steve Hillin <stevehillin@gmail.com>
Disclaimer: The data displayed by this file could be 
considered a security risk.  It is imparative that you 
secure this page from public consumption.
----

Updated by Predrag Supurovic <pedja@supurovic.net> to
allow listing all extensions regardles if online or not

**********************************************************/

define('SHOW_ALL', true); // set to false to show only online extensions

$cmd2 = "asterisk -rx 'database show AMPUSER'";
$resultsAMPUSER = shell_exec($cmd2);
$resultsAMPUSERClean = str_replace ('/AMPUSER/', '', $resultsAMPUSER);

$array2 = explode(PHP_EOL, $resultsAMPUSERClean);

$extensions = array();
foreach ($array2 as $item => $value) {
  $itemarray = explode('/', $value);
  if (! empty($itemarray[0]) and is_numeric ($itemarray[0])) {
    if (! isset ($extensions[$itemarray[0]]['extension']['number'])) {
      $extensions[$itemarray[0]]['extension']['number'] = $itemarray[0];
    }
    $arrayvalue = explode(':', $itemarray[1]);

    $extensions[$itemarray[0]]['extension'][trim($arrayvalue[0])] = $arrayvalue[1];
    
    //$extensions[$itemarray[0]]['online']['ip'] = '';
    //$extensions[$itemarray[0]]['online']['user_agent'] = '';
    //$extensions[$itemarray[0]]['online']['expiration_time'] = '';

  }

}



$cmd = "asterisk -rx 'database show registrar/contact' | grep -v 'results'";
$results = shell_exec($cmd);

$array = explode(PHP_EOL, $results);
foreach($array as $a) {
  preg_match('#\{(.*?)\}#', $a, $match);
  $json = json_decode($match[0], true);

  if (! empty ($json['endpoint'])) {
    $extensions[$json['endpoint']]['online'] = $json;
    $extensions[$json['endpoint']]['online']['expiration_time'] = date("Y-m-d H:i:s", $json['expiration_time']);
  }
  
}



?>
<table class="table table-bordered">
<thead>
<tr>
<th scope="col">Extension</th>
<th scope="col">IP</th>
<th scope="col">User-Agent</th>
<th scope="col">Expiration Time</th>
</tr>
</thead>
<tbody>

<?php
foreach($extensions as $k => $v) {
  if (SHOW_ALL or (!SHOW_ALL and isset ($v['online']))) {
?>
<tr>
<td>
<?php echo $k; ?>
</td>
<td>
<?php echo (isset ($v['online']) ? $v['online']['via_addr'] : ''); ?>
</td>
<td>
<?php echo (isset ($v['online']) ? $v['online']['user_agent'] : ''); ?>
</td>
<td>
<?php echo (isset ($v['online']) ? $v['online']['expiration_time'] : ''); ?>
</td>
</tr>
<?php
  }
}
?>


</tbody>
</table>
