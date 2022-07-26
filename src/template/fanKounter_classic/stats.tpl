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
            <img src="../../img/fankounter3.0.png" style="width:200px"><br/><br/>
            <table cellspacing="0" cellpadding="0" class="conteiner">
                <tr>
                    <td align="center">
                        <table cellspacing="0" cellpadding="0">
                            <tr>

                            {loop="$menus"}
								<td valign="bottom">
                                    <form method="post" action="{$action}">
                                        <input type="hidden" name="id" value="{$value->id}"/>
                                        <input type="hidden" name="panel" value="{$value->panel}"/>
                                        {$value->tab_header}
                                    </form>
                                </td>
        					{/loop}	

                                <td valign="bottom">
                                    <form method="post" action="{$action}">
                                        <input type="submit" value="{$exit}" onmouseover="javascript:this.className='menuq_up';" onmouseout="javascript:this.className='menuq';" class="menuq" />
                                    </form>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td class="conteiner">
                        <p class="header">{$header}</p>
                        {$content}
                        <p class="top"><a href="javascript:scroll(0,0);">{$top}</a></p>
                    </td>
                </tr>
            </table>
            <p class="credits">
                <a href="{$homepage}">fanKounter</a> a HZKnight Free PHP Script<br/>
                &copy;2022 <a href="https://www.hzknight.org">HZKnight</a> | &copy;2002 fanatiko
            </p>
        </div>
    </body>
</html>