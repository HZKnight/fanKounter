<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<!-- fanKounter v {$version} - by LucLiscio (Italy) //-->
<!-- {$homepage} //-->
<!-- mailto:{$email} //-->

<html>
    <head>
        <title>{$title}</title>
        <meta name="description" content="fanKounter: uno script in PHP per creare e gestire contatori di visite con statistiche per pagine WEB." />
        <meta name="keywords" content="accessi,contatore,counter,fanKounter,pagine,PHP,script,statistiche,stats,reload,unici,visitatori,visite,WEB\" />
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <base target="_top" />
        <link type="text/css" rel="stylesheet" href="stats.css" />
    </head>
    <body>
        <div align="center">
            <table cellspacing="0" cellpadding="0" class="conteiner">
                <tr>
                    <td align="center">
                        <table cellspacing="0" cellpadding="0">
                            <tr>

foreach(array(_strlan_(LAN_MENU1,TRUE)=>0,_strlan_(LAN_MENU2,TRUE)=>1,_strlan_(LAN_MENU3,TRUE)=>2,_strlan_(LAN_MENU4,TRUE)=>3,_strlan_(LAN_MENU5,TRUE)=>4,_strlan_(LAN_MENU6,TRUE)=>5) as $__name=>$__panel){
 echo"<td valign=\"bottom\">";
 echo"<form method=\"post\" action=\"".$_SERVER["PHP_SELF"]."\">";
 echo"<input type=\"hidden\" name=\"id\" value=\"".$par__id."\" />";
 echo"<input type=\"hidden\" name=\"panel\" value=\"".$__panel."\" />";
 echo ($par__panel===$__panel)?("<input type=\"submit\" value=\"".$__name."\" class=\"menu_hi\" />"):("<input type=\"submit\" value=\"".$__name."\" onmouseover=\"javascript:this.className=&quot;menu_up&quot;;\" onmouseout=\"javascript:this.className=&quot;menu&quot;;\" class=\"menu\" />");
 echo"</form>";
 echo"</td>";
}

                                <td valign="bottom">
                                    <form method="post" action="{{$_SERVER["PHP_SELF"]}}>
                                        <input type="submit" value="{{_strlan_(LAN_MENU7,TRUE)}}" onmouseover="javascript:this.className='menuq_up';" onmouseout="javascript:this.className='menuq';" class="menuq" />
                                    </form>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td class="conteiner">
                        <p class="header">{{_strlan_(LAN_HEADER,FALSE,$par__id,_strdate_($aux__now,"d"),date("G:i",$aux__now),_strdate_($aux__now,"w"))}}</p>
                        {{eval("_panel".$par__panel."_();");}}
                        <p class="top"><a href="javascript:scroll(0,0);">{{_strlan_(LAN_TOP,TRUE)}}</a></p>
                    </td>
                </tr>
            </table>
            <p class="credits">
                &copy;2017 HZKnight | &copy;2002 fanatiko
                <br/><a href="{$homepage}">fanKounter</a> a Free PHP Script
            </p>
        </div>
    </body>
</html>