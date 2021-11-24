<?php
/**********************************************************
PJSIP Online Devices - Data
Author: Steve Hillin <stevehillin@gmail.com>
Disclaimer: The data displayed by this file could be 
considered a security risk.  It is imparative that you 
secure this page from public consumption.
**********************************************************/
$data = array();
$cmd = "asterisk -rx 'database show registrar/contact' | grep -v 'results'";
$results = shell_exec($cmd);
$array = explode(PHP_EOL, $results);
foreach($array as $a)
{
  preg_match('#\{(.*?)\}#', $a, $match);
  $json = json_decode($match[0], true);
  $data[] = array(
    "endpoint" => $json['endpoint'],
    "ip" => $json['via_addr'],
    "user_agent" => $json['user_agent'],
    "expiration_time" => date("Y-m-d H:i:s", $json['expiration_time'])
    );
}
// Sanitize
foreach($data as $k => $v)
{
  if($v['endpoint'] == "")
  {
    unset($data[$k]);
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
foreach($data as $k => $v)
{
  echo "<tr><td>";
  echo $v['endpoint'];
  echo "</td><td>";
  echo $v['ip'];
  echo "</td><td>";
  echo $v['user_agent'];
  echo "</td><td>";
  echo $v['expiration_time'];
  echo "</td></tr>";
}
?>
</tbody>
</table>

