<?php if(!class_exists('raintpl')){exit;}?><!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<!-- fanKounter v <?php echo $version;?> - by LucLiscio (Italy) //-->
<!-- <?php echo $homepage;?> //-->
<!-- mailto:<?php echo $email;?> //-->
 
<html>
 	<head>
		<title><?php echo $title;?></title>
 		<meta name="description" content="fanKounter: uno script in PHP per creare e gestire contatori di visite con statistiche per pagine WEB" />
 		<meta name="keywords" content="accessi,contatore,counter,fanKounter,pagine,PHP,script,statistiche,stats,reload,unici,visitatori,visite,WEB" />
 		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
 		<base target="_top" />
 		<link type="text/css" rel="stylesheet" href="template/fanKounter_classic/stats.css" />
 	</head>
	<body>
 		<table cellspacing="0" cellpadding="0" style="width:100%;height:100%;">
 			<tr>
 				<td align="center">
					<div class="mask">
						<img src="template/fanKounter_classic/../../img/fankounter3.0.png" style="width:200px"><br/><br/>
 						<form method="post" action="<?php echo $action;?>">
	 						<p><?php echo $contatore;?></p>
	 						<p>
	 							<select name="id" size="1" class="counter">
									
								<?php $counter1=-1; if( isset($counters) && is_array($counters) && sizeof($counters) ) foreach( $counters as $key1 => $value1 ){ $counter1++; ?>

									<option value="<?php echo $key1;?>" <?php echo $value1;?>><?php echo $key1;?></option>	
        						<?php } ?>									
									
	 							</select>
	 						</p>
	 						<p><?php echo $password;?></p>
	 						<p><input type="password" name="passwd" class="passwd" /></p>
	 						<p><input type="submit" value="&gt;&gt;" class="enter" /></p>
 						</form>
 					</div>
 					<p class="credits">
						&copy;2021 <a href="https://www.hzknight.org">HZKnight</a> | &copy;2002 fanatiko
						<br/><a href="<?php echo $homepage;?>">fanKounter</a> a HZKnight Free PHP Script
					</p>
 					<script type="text/javascript" language="javascript">
 						try{
 							document.forms[0].passwd.focus();
 						} catch(_err){;}
 					</script>
 				</td>
 			</tr>
 		</table>
 	</body>
</html>