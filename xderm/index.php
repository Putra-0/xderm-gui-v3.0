<?php
 exec("ls login.php|awk 'NR==1'|awk -F '.' '{print $1}'",$clo);
  if ($clo[0]) {
include 'header.php';
ceklogin();
  };
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="shortcut icon" href="img/ico.png">
<link rel="stylesheet" href="css/style.css">
<script type="text/javascript" src="js/jquery-2.1.3.min.js"></script>
<meta charset="UTF-8"><title>Xderm Mini</title>
<script>
function shipping_calc() {
  var val = document.getElementById("idconf").value;
 if (val === "config1") {
   var data = document.getElementById("isi1").value;
   document.getElementById("isi").value= data;
 }
 if (val === "config2") {
   var data = document.getElementById("isi2").value;
   document.getElementById("isi").value= data;
 }
 if (val === "config3") {
   var data = document.getElementById("isi3").value;
   document.getElementById("isi").value= data;
 }
 if (val === "config4") {
   var data = document.getElementById("isi4").value;
   document.getElementById("isi").value= data;
 }
 if (val === "config5") {
   var data = document.getElementById("isi5").value;
   document.getElementById("isi").value= data;
 }
}
</script>
<script type="text/javascript">
    $(document).ready(function() {
        setInterval(function() {
            $.ajax({
                url: "screenlog.0",
		cache: false,
                success: function(result) {
		    $("#log").html(result);
                }
            });
        $(document).ready(function() {
                $.ajaxSetup({ cache: false });
                        });
                var textarea = document.getElementById("log");
                textarea.scrollTop = textarea.scrollHeight;
        }, 1000);
    });
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>
<body>
<div class="block moving-glow">
	<center>
		<a href="login.php" onClick="logout()">
		<img src="img/image.png" width: 100%></a>
	</center>
    <form method="post">
		<center>
			<table align="center"><tr><td class="col-butt">
				
				<button type="submit" name="button1" class="glow-on-hover"  id="strp"
					value="<?php echo exec('cat log/st') ?>"/><?php echo exec('cat log/st') ?>
				</button>
				<button type="submit" name="button3" class="glow-on-hover" id="logg"
					value="Log"/>Log
				</button>
				<button type="submit" name="button2" class="glow-on-hover" id="config"
					value="Config"/>Config
				</button>
				<button type="submit" name="button4" class="glow-on-hover" id"update"
					value="Update"/>Update
				</button>

				</td></tr>
			</table>
		</center>
<?php
  exec('cat /var/update.xderm',$z);
    if ($z[0]) {
 if ( $z[0] != '3.0' ){
echo '<pre><h3 style="color:lime">New versi GUI Detected, Please Update!!</h3></pre>';
};
    };
  if (isset($_POST['button1'])) {
  exec('cat log/st',$o);
if ( $o[0] == 'Start' ) {
 exec('killall -q xderm-mini');
 exec('echo > screenlog.0');
 exec('chmod +x xderm-mini');
 exec('screen -L -dmS gua ./xderm-mini start');
 exec('echo Stop > log/st');
echo '<script>
  document.getElementById("strp").value="Stop";
</script>';
 } else {
 exec('killall -q xderm-mini');
 exec('echo > screenlog.0');
 exec('chmod +x xderm-mini');
 exec('screen -L -dmS gu ./xderm-mini stop');
 exec('echo Start > log/st');
echo '<script>
  document.getElementById("strp").value="Start";
</script>';
}
  }
  if (isset($_POST['button2'])) {
  exec('echo > screenlog.0');
  }
  if (isset($_POST['button4'])) {
  exec('killall -q xderm-mini');
  exec('echo > screenlog.0');
  exec('chmod +x xderm-mini');
  exec('screen -L -dmS upd ./xderm-mini update');
  }
  if (isset($_POST['button3'])) {
  exec('cp log/log.txt screenlog.0 2>/dev/null');
  }
?>
<table align="center"><tr><td class="box_script"><div class="inline-block"><pre>
<?php
 if (isset($_POST['simpan'])) {
 $config=$_POST['configbox'];
 $conf=$_POST['profile'];
 $use_stunnel=$_POST['use_stunnel'];
 $use_gotun=$_POST['use_gotun'];
 $use_restfw=$_POST['use_restfw'];
 $use_waitmodem=$_POST['use_waitmodem'];
 $mode=$_POST['mode'];
 if ($use_stunnel <> 'yes' ){$use_stunnel='no';}
 if ($use_gotun <> 'yes' ){$use_gotun='no';}
 if ($use_restfw <> 'yes' ){$use_restfw='no';}
 if ($use_waitmodem <> 'yes' ){$use_waitmodem='no';}
 exec('echo "'.$mode.'" > config/mode.default');
 exec('echo "'.$config.'" > config/'.$conf);
 exec('sed -i \'/mode=/,+0 d\' config/'.$conf);
 exec('sed -i \'s/\r$//g\' config/'.$conf);
 exec('sed -i \':a;N;$!ba;s/\n\n//g\' config/'.$conf);
 exec('echo "'.$config.'" > config.txt');
 exec('sed -i \'s/\r$//g\' config.txt');
 exec('sed -i \':a;N;$!ba;s/\n\n//g\' config.txt');
 exec('echo "'.$use_stunnel.'" > config/stun');
 exec('echo "'.$use_gotun.'" > config/gotun');
 exec('echo "'.$use_restfw.'" > config/firewall');
 exec('echo "'.$use_waitmodem.'" > config/modem');
 exec('echo "'.$conf.'" > config/default');
 exec('echo "Config telah di update." > screenlog.0');
 exec('echo "\''.$conf.'\' Menjadi default Config. !" >> screenlog.0');
 $use_boot=$_POST['use_boot'];
if ($use_boot <> 'yes' ){ exec('./xderm-mini disable');
} else { exec('./xderm-mini enable'); }
 exec("cat config/default",$default);
 }
if($_POST['button2']){
exec("cat config/mode.list|awk 'NR==1'",$adamode);
$adamode=$adamode[0];
if (!$adamode) {
exec("echo SSH. >> config/mode.list");
exec("echo Vmess. >> config/mode.list");
exec("echo Trojan. >> config/mode.list");
exec("echo Multi. >> config/mode.list"); }

exec("cat config/config.list|awk 'NR==1'",$ada);
$ada=$ada[0];
if ($ada) {
exec("cat config/default",$default);
$default=$default[0];
 if ($default) {
echo "<h4><center><b>profile that is active now: $default</b></center></h4>";
$data = file_get_contents("config/$default");
echo "<textarea name='configbox' id='isi' placeholder='Masukkan config disini' rows='9' cols='50'>$data</textarea>";
 } else {
$data = file_get_contents("config.txt");
echo "<textarea name='configbox' id='isi' placeholder='Masukkan config disini' rows='9' cols='50'>$data</textarea>";
 }
$data1 = file_get_contents("config/config1");
echo "<textarea name='configbox1' id='isi1' rows='3' cols='10' style='display:none;'>$data1</textarea>";
$data2 = file_get_contents("config/config2");
echo "<textarea name='configbox2' id='isi2' rows='3' cols='10' style='display:none;'>$data2</textarea>";
$data3 = file_get_contents("config/config3");
echo "<textarea name='configbox3' id='isi3' rows='3' cols='10' style='display:none;'>$data3</textarea>";
$data4 = file_get_contents("config/config4");
echo "<textarea name='configbox4' id='isi4' rows='3' cols='10' style='display:none;'>$data4</textarea>";
$data5 = file_get_contents("config/config5");
echo "<textarea name='configbox5' id='isi5' rows='3' cols='10' style='display:none;'>$data5</textarea>";
} else {
exec("mkdir -p config;touch config/config.list config/config1 config/config2");
exec("touch config/config3 config/config4 config/config5 config/mode.list");
exec("echo config1 >> config/config.list");
exec("echo config2 >> config/config.list");
exec("echo config3 >> config/config.list");
exec("echo config4 >> config/config.list");
exec("echo config5 >> config/config.list");
exec("echo config1 >> config/default");
$data = file_get_contents("config.txt");
echo "<textarea name='configbox' id='isi' rows='9' cols='50'>$data</textarea>";
$config=$_POST['configbox'];
$conf=$_POST['profile'];
exec('echo "'.$config.'" > config/'.$conf);
exec('sed -i \'s/\r$//g\' config/'.$conf);
exec('sed -i \':a;N;$!ba;s/\n\n//g\' config/'.$conf);
};
echo '<div class="form-box">';
echo '<select name="profile" id="idconf" onchange="shipping_calc()">';
exec("cat config/config.list",$list);
exec("cat config/default",$default);
$default=$default[0];
$x=0;
while($x<count($list)){
if ( $default == $list[$x] ){
echo "<option value=\"$list[$x]\" selected>$list[$x]</option>";
} else {
echo "<option value=\"$list[$x]\">$list[$x]</option>";}
  $x++;}
echo '<form method="post"'>
exec("cat config/stun|awk 'NR==1'",$stun);
  if (!$stun[0]) { exec("echo yes > config/stun"); }
 if ( $stun[0] == "yes"){
echo '<input type="checkbox" name="use_stunnel" value="yes" checked>stunnel'; }
else {
echo '<input type="checkbox" name="use_stunnel" value="yes">stunnel'; }
exec("touch /etc/rc.local");
exec("cat /etc/rc.local 2>/dev/null|grep xderm|grep button|awk '{print $2}'|awk 'NR==1'",$boot);

exec("cat config/gotun|awk 'NR==1'",$gotun);
  if (!$gotun[0]) { exec("echo no > config/gotun"); }
 if ( $gotun[0] == "yes"){
echo '<input type="checkbox" name="use_gotun" value="yes" checked>go-tun2socks'; }
else {
echo '<input type="checkbox" name="use_gotun" value="yes">go-tun2socks'; }

exec("cat config/firewall|awk 'NR==1'",$restfw);
  if (!$restfw[0]) { exec("echo no > config/firewall"); }
 if ( $restfw[0] == "yes"){
echo '<input type="checkbox" name="use_restfw" value="yes" checked>Restart Firewall<br>'; }
else {
echo '<input type="checkbox" name="use_restfw" value="yes">Restart Firewall<br>'; }

echo '<select name="mode" id="idmode">';
exec("cat config/mode.list",$modelist);
exec("cat config/mode.default",$modedefault);
$modedefault=$modedefault[0];
$u=0;
while($u<count($modelist)){
if ( $modedefault == $modelist[$u] ){
echo "<option value=\"$modelist[$u]\" selected>$modelist[$u]</option>";
} else {
echo "<option value=\"$modelist[$u]\">$modelist[$u]</option>";}
  $u++;}

exec("cat config/modem|awk 'NR==1'",$modem);
  if (!$modem[0]) { exec("echo no > config/modem"); }
 if ( $modem[0] == "yes"){
echo '<input type="checkbox" name="use_waitmodem" value="yes" checked>Waiting Modem '; }
else {
echo '<input type="checkbox" name="use_waitmodem" value="yes">Waiting Modem '; }

 if ($boot[0]) {
echo '<input type="checkbox" name="use_boot" value="yes" checked>ON-Boot'; }
else {
echo '<input type="checkbox" name="use_boot" value="yes">ON-Boot'; }
echo '<input type="submit" name="simpan" class="glow-on-hover" value="Simpan"/></form></div>';
} else {
echo '<div id="log" class="scroll"></div></pre></div>';
}
?>
</td></tr>
</table></head>
<center><br>
	<div class="nganu slide" style="height:54px">
        Xderm GUI V.3.0<br>
		&copy Design by Adi Putra<br>
		Copyright &copy Ryan Fauzi
    </div><br></center></div>
</html>
