<?php if(!class_exists('raintpl')){exit;}?><!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<!-- fanKounter v <?php echo $version;?> - by LucLiscio (Italy) //-->
<!-- <?php echo $homepage;?> //-->
<!-- mailto:<?php echo $email;?> //-->

<html>
    <head>
        <title><?php echo $title;?></title>
        <meta name="description" content="fanKounter: uno script in PHP per creare e gestire contatori di visite con statistiche per pagine WEB." />
        <meta name="keywords" content="accessi,contatore,counter,fanKounter,pagine,PHP,script,statistiche,stats,reload,unici,visitatori,visite,WEB\" />
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <base target="_top" />
        <link type="text/css" rel="stylesheet" href="template/fanKounter_classic/stats.css" />
    </head>
    <body>
        <div align="center">
            <img src="template/fanKounter_classic/../../img/fk_newlogo.png" style="width:200px"><br/><br/>
            <table cellspacing="0" cellpadding="0" class="conteiner">
                <tr>
                    <td align="center">
                        <table cellspacing="0" cellpadding="0">
                            <tr>

                            <?php $counter1=-1; if( isset($menus) && is_array($menus) && sizeof($menus) ) foreach( $menus as $key1 => $value1 ){ $counter1++; ?>
								<td valign="bottom">
                                    <form method="post" action="<?php echo $action;?>">
                                        <input type="hidden" name="id" value="<?php echo $value1->id;?>"/>
                                        <input type="hidden" name="panel" value="<?php echo $value1->panel;?>"/>
                                        <?php echo $value1->tab_header;?>
                                    </form>
                                </td>
        					<?php } ?>	

                                <td valign="bottom">
                                    <form method="post" action="<?php echo $action;?>">
                                        <input type="submit" value="<?php echo $exit;?>" onmouseover="javascript:this.className='menuq_up';" onmouseout="javascript:this.className='menuq';" class="menuq" />
                                    </form>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td class="conteiner">
                        <p class="header"><?php echo $header;?></p>
                        <?php echo $content;?>
                        <p class="top"><a href="javascript:scroll(0,0);"><?php echo $top;?></a></p>
                    </td>
                </tr>
            </table>
            <p class="credits">
                &copy;2017 HZKnight | &copy;2002 fanatiko
                <br/><a href="<?php echo $homepage;?>">fanKounter</a> a Free PHP Script
            </p>
        </div>
    </body>
</html>