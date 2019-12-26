 <!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
 <!-- fanKounter v {$version} - by LucLiscio (Italy) //-->
 <!-- {$homepage} //-->
 <!-- mailto:{$email} //-->
 
 <html>
 	<head>
		<title>{$title}</title>
 		<meta name="description" content="fanKounter: uno script in PHP per creare e gestire contatori di visite con statistiche per pagine WEB" />
 		<meta name="keywords" content="accessi,contatore,counter,fanKounter,pagine,PHP,script,statistiche,stats,reload,unici,visitatori,visite,WEB" />
 		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
 		<base target="_top" />
 		<link type="text/css" rel="stylesheet" href="stats.css" />
 	</head>
	<body>
 		<table cellspacing="0" cellpadding="0" style="width:100%;height:100%;">
 			<tr>
 				<td align="center">
					<div class="mask">
						<img src="../../img/fk_newlogo.png" style="width:200px"><br/><br/>
 						<form method="post" action="{$action}">
	 						<p>{$contatore}</p>
	 						<p>
	 							<select name="id" size="1" class="counter">
									
								{loop="$counters"}
									<option value="{$key}" {$value}>{$key}</option>	
        						{/loop}									
									
	 							</select>
	 						</p>
	 						<p>{$password}</p>
	 						<p><input type="password" name="passwd" class="passwd" /></p>
	 						<p><input type="submit" value="&gt;&gt;" class="enter" /></p>
 						</form>
 					</div>
 					<p class="credits">
 						&copy;2018 HZKnight | &copy;2002 fanatiko
 						<br/><a href="{$homepage}">fanKounter</a> a Free PHP Script
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