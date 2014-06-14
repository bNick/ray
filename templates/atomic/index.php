<?php



$session =JFactory::getSession();


$ts= $session->get( 'ts');
//echo $ts;
//print_r($ts.' = ts <br>');
//print_r(JRequest::getVar( 'TYPESITE' ).' = TYPESITE <br>');

if($ts > '')
{
	if(JRequest::getVar( 'TYPESITE' ) > '')
	{
		if(JRequest::getVar( 'TYPESITE' ) != $ts)
		{	
//echo '99999999999';
	//if( JRequest::getVar( 'view' ) != 'servis'){	
	
//echo '88888888';
			//JRequest::setVar( 'TYPESITE', 1 );
            if(JRequest::getVar( 'TYPESITE' ) == 1)
                JRequest::setVar( 'TYPESITE', $ts );
            else            
                $session->set( 'ts', JRequest::getVar( 'TYPESITE' ));
			//}
      //JRequest::setVar( 'TYPESITE', $ts );
		}
	}
	else
	{
	
	//echo '00000';
      JRequest::setVar( 'TYPESITE', $ts );
	}
	

}
else
{
if(JRequest::getVar( 'TYPESITE' ) > '')
	{
	
	//echo '77777';
$session->set( 'ts', JRequest::getVar( 'TYPESITE' ));
	}
	else
	{
	//echo '6666666';
$session->set( 'ts', 1);
	}
}



if($_GET['ts'] == 'reset')
{
      JRequest::setVar( 'TYPESITE', 1 );
      $session->set( 'ts', 1);
      
      if($_SERVER['REQUEST_URI'] == '/?ts=reset') {
        header("HTTP/1.1 301 Moved Permanently");
        header("Location: /");
      }
}


if(JRequest::getVar( 'TYPESITE' ) > 1)
{
	$clrs = '?ts=reset';
}


$ts= $session->get( 'ts');
//echo $ts;
//echo 'M';
//print_r($ts.' = ts <br>');
//print_r(JRequest::getVar( 'TYPESITE' ).' = TYPESITE <br>');

if($_GET['rtf'] == true)
{
	$db = & JFactory::getDBO();
	$query="SELECT name, (SELECT name FROM 0y13_ray_naspunkt WHERE id=naspunk) as naspunks, (SELECT alias2 FROM 0y13_ray_servis WHERE id=service) as services FROM 0y13_ray_item WHERE id=".$_GET['id']."";
    $ndoc = '';
	$db->setQuery($query);	
	$row = $db->loadObject();
	//print_r($row);
    $ndoc = iconv('UTF-8','Windows-1251', 'РАЙ.РФ  -  '.$row->services.' '.$row->name.' '.$row->naspunks.' ');
  
    //$ndoc = iconv('UTF-8','Windows-1251', 'РАЙ.РФ  1 '.$_GET['id']);
   
header("Content-type: text/html; charset=utf-8");
header( "Content-type: application/msword" );
        header('Content-Disposition: inline; filename=" '.$ndoc.'.rtf"');
        header('Content-Description: File Transfer');
        header("Cache-control: private");

    $id = $_GET['id'];
    
    
    echo '
     <html>
            <head>
            <meta http-equiv="Expires" content="Fri, Jan 01 1900 00:00:00 GMT">
            <meta http-equiv="Pragma" content="no-cache">
            <meta http-equiv="Cache-Control" content="no-cache">
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
            <meta http-equiv="Lang" content="en">
            <meta name="author" content="">
            <meta http-equiv="Reply-to" content="@.com">
            <meta name="generator" content="PhpED 5.8">
            <meta name="description" content="">
            <meta name="keywords" content="">
            <meta name="creation-date" content="01/01/2009">
            <meta name="revisit-after" content="15 days"> 
            </head>
            <body>';
    
    
    
    include('components/com_k2/element.php');
    
    
    echo '</body>
            </html>';
    
    exit();

}



?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" id="nojs">
<head>		
	<jdoc:include type="head" />
<meta name='yandex-verification' content='60af5c2bd9f86ae0' />
    <link rel="stylesheet" type="text/css" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/common.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/tags.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/classes.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/layout.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/fancybox/jquery.fancybox.css" media="screen" />
    <!--[if lte IE 7]>
    <link rel="stylesheet" type="text/css" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/common-ie.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/tags-ie.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/classes-ie.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/layout-ie.css"/>
    <![endif]-->
    <script type="text/javascript">document.documentElement.id = "js"; var run = 0; </script> 
    <script src="http://api-maps.yandex.ru/2.0/?load=package.full&lang=ru-RU" type="text/javascript"></script>   
	<script type="text/javascript" src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/js/jquery-1.7.2.min.js"></script>	
	<script type="text/javascript" src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/js/text-shadow.min.js"></script>	  
<meta name="google-translate-customization" content="fcc1b0a7b60dc750-fc8e2539b559f497-gcd7c6c0990722567-16">

	<script type="text/javascript" src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/fancybox/jquery.easing.1.3.js"></script>
	<script type="text/javascript" src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/fancybox/jquery.fancybox-1.2.1.pack.js"></script>
    
	<!-- + scripts -->
    <script type="text/javascript" src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/js/script21.js"></script>	     
	<!-- - scripts -->   
	
                    
    <style>
.item-page{
display: none;
}
.item-page{
display: none;
}
.simbad{
padding-top: 5px;
}

</style>


<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7">


</head>
<body>
<div id="google_translate_element" style="display:none; position:absolute; z-index:999999; "></div>
    <link rel="stylesheet" type="text/css" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/st.css" />


<div class="box">

	<div class="osnvisible">
		<div class="top">
			<div class="logo">
				<a href="<?php echo $this->baseurl.$clrs; ?>"><img src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/images/logo.png"></a>
			</div>
			<div class="banner">
				<div class="banner2">
                    <?php
                    $db = & JFactory::getDBO();
                    $ban = GetBanner($db);
                    echo ' <a href="' . $ban["url"] . '"> <img style="width:854px; height: 87px;" src="' . $ban["src"] . '" class="topbanned"> </a> ';
                    ?>
				</div>
			</div>		
			<div class="typeobject">
				<ul>
				
				
				<?php
					if(JRequest::getVar( 'TYPESITE' ) == '')
						$TYPESITE = 1;
					else					
                        $TYPESITE = 	JRequest::getVar( 'TYPESITE' );
		
                    
        
        
					$query = "SELECT * FROM 0y13_ray_typeobject WHERE id > 1";
								
					$db->setQuery($query);		
					$row = $db->loadObjectList();
					$i = 0;
					foreach ($row as $servis) 
					{
						$i++;
						if($TYPESITE == $servis->id)
							echo '<li> <a href="'.$servis->main_alias.'" class="slink'.$i.'" style="color:#ff0000; font-weight:bold; ">&#10003;'.$servis->name.' </a> </li>';						
						else
							echo '<li> <a href="'.$servis->main_alias.'" class="slink'.$i.'"> 	&nbsp;	&nbsp;  '.$servis->name.' </a> </li>';
					
                        
					}
				
					if($TYPESITE == 1)
                    {
						echo '<li> <a href="'.$this->baseurl.'?ts=reset" style="color:#ff0000; font-weight:bold; "  class="slink4">&#10003;Общий поиск   </a> </li>';	
                        echo '
                                <script>
                                var us = 0;
                                </script>
                                ';			
                    }                                
					else
                    {
						echo '<li> <a href="'.$this->baseurl.'?ts=reset"  class="slink4"> 	&nbsp;	&nbsp;  Общий поиск  </a> </li>';
                        
                        echo '
                                <script>
                                var us = 1;
                                </script>
                                ';
                        
                    }
				?>
				
				
				
				
				
				</ul>
			</div>		
		</div>
		<div class="left">
			
<!--***********************************************************************************************************************************************************************************************************************************-->

<div class="menu-class1">	

<?php 

$nlist=1; 

if(JRequest::getVar( 'view' ) != 'region' && JRequest::getVar( 'view' ) != 'servis'  && JRequest::getVar( 'view' ) != 'naspunkt'  && JRequest::getVar( 'view' ) != 'item'){
include("cantry.php"); 
}
else
{
 include("service.php");
}
?>
		
</div>

<?php
	if( $view == 'article' && JRequest::getVar( 'id'  )== 5)
		{
			echo $script;
		}


?>
<!--***********************************************************************************************************************************************************************************************************************************-->
<div class="menu-class2">

    <?php
    $nlist = 2;
    if (JRequest::getVar('view') != 'region'
        && JRequest::getVar('view') != 'servis'
        && JRequest::getVar('view') != 'naspunkt'
        && JRequest::getVar('view') != 'item') {
        include("service.php");
    } else {
        include("cantry.php");
    }
    ?>

</div>        
        
		
		</div>
		<div class="center">
		
		
				<div class="topmenu">
				
				<jdoc:include type="modules" name="atomic-topmenu" style="container" /> 
				
				
				<script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'ru', layout: google.translate.TranslateElement.InlineLayout.SIMPLE, autoDisplay: false}, 'google_translate_element');
}
</script><script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
        
	
<p  class="hleb" style=" height:17px; padding-top:3px; margin-top: 1px; "> <?php 
/**
 * @version		$Id: mod_k2_tools.php 1229 2011-10-18 17:55:00Z joomlaworks $
 * @package		K2
 * @author		JoomlaWorks http://www.joomlaworks.gr
 * @copyright	Copyright (c) 2006 - 2011 JoomlaWorks Ltd. All rights reserved.
 * @license		GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

// no direct access
defined('_JEXEC') or die('Restricted access');
global $PAGENAME;

$k2_url = $PAGENAME;

$curent_page =  '<a href="'.$clrs.'"> Главная  </a> <img src="templates/atomic/images/strela.png">  ';

		$db = & JFactory::getDBO();
			
		global $TYPESITE;
		
	if(JRequest::getVar( 'TYPESITE' ) == '')
		$TYPESITE = 1;
	else
    {
		$TYPESITE = 	JRequest::getVar( 'TYPESITE' );
        
        
    }


		$query_word="SELECT * FROM 0y13_ray_typeobject WHERE id = ".$TYPESITE;	
		$db->setQuery($query_word);	
		$ferst_word = '';	
		if($row_word = $db->loadObject())
		{	
			$ferst_word = $row_word->alias;
            
            if($TYPESITE > 1)            
                $curent_page =  $curent_page.'<a href="'.($row_word->main_alias).'"> '.($row_word->name).'  </a> <img src="templates/atomic/images/strela.png">  ';
        
		}
		
		if(JRequest::getVar( 'view' ) == 'cantry' )
		{
			$curent_page  = $curent_page.get_cantry($ferst_word, JRequest::getInt( 'id' ));
		}
		if(JRequest::getVar( 'view' ) == 'region' )
		{			
			$curent_page  = $curent_page.get_cantry($ferst_word, JRequest::getInt( 'cantry' )).get_region($ferst_word, JRequest::getInt( 'id' ));
		}
		if(JRequest::getVar( 'view' ) == 'naspunkt' )
		{			
			$curent_page  = $curent_page.get_cantry($ferst_word, JRequest::getInt( 'cantry' )).get_region($ferst_word, JRequest::getInt( 'region' )).get_naspunkt($ferst_word, JRequest::getInt( 'id' ));
		}
		if(JRequest::getVar( 'view' ) == 'servis' )
		{			
			$curent_page  = $curent_page.get_cantry($ferst_word, JRequest::getInt( 'cantry' )).get_region($ferst_word, JRequest::getInt( 'region' )).get_naspunkt($ferst_word, JRequest::getInt( 'naspunkt' )).get_servis(JRequest::getInt( 'id' ));
		}
		if(JRequest::getVar( 'view' ) == 'item' )
		{			
			$curent_page  = $curent_page.get_cantry($ferst_word, JRequest::getInt( 'cantry' )).get_region($ferst_word, JRequest::getInt( 'region' )).get_naspunkt($ferst_word, JRequest::getInt( 'naspunkt' )).get_servis(JRequest::getInt( 'servis' )).get_item(JRequest::getInt( 'id' ));
		}
			
		echo $curent_page;
		
		
		
function get_cantry($ferst_word, $uin)
{
	$db = & JFactory::getDBO();
	
	$query_temp="SELECT * FROM d0y13_ray_cantry WHERE id=".$uin ;
			
	$db->setQuery($query_temp);		
	if($row_temp = $db->loadObject()){
				
	if(JRequest::getVar( 'TYPESITE' ) == '')
		$TYPESITE = 1;
	else
		$TYPESITE = 	JRequest::getVar( 'TYPESITE' );
		
	if($TYPESITE == 1)
		return '  <a href="'.$ferst_word.'-'.$row_temp->alias3.'"> '.$row_temp->name.' </a>  <img src="templates/atomic/images/strela.png">   ';
	else
		return '  <a href="'.$ferst_word.'-'.$row_temp->alias2.'"> '.$row_temp->name.' </a>  <img src="templates/atomic/images/strela.png">   ';
	}
	
}
			
		
		
function get_region($ferst_word, $uin)
{
	$db = & JFactory::getDBO();
	
	$query_temp="SELECT * FROM 0y13_ray_region WHERE id=".$uin ;
			
	$db->setQuery($query_temp);		
	if($row_temp = $db->loadObject()){
				
	if(JRequest::getVar( 'TYPESITE' ) == '')
		$TYPESITE = 1;
	else
		$TYPESITE = 	JRequest::getVar( 'TYPESITE' );
		
	if($TYPESITE == 1)			
		return '  <a href="'.$ferst_word.'-'.$row_temp->alias3.'"> '.$row_temp->name.' </a> <img src="templates/atomic/images/strela.png">  ';
	else
		return '  <a href="'.$ferst_word.'-'.$row_temp->alias2.'"> '.$row_temp->name.' </a> <img src="templates/atomic/images/strela.png">  ';
	}
}
			
		
function get_naspunkt($ferst_word, $uin)
{
	$db = & JFactory::getDBO();
	
	$query_temp="SELECT * FROM 0y13_ray_naspunkt WHERE id = ".$uin ;
			
	$db->setQuery($query_temp);		
	if($row_temp = $db->loadObject()){
					
	if(JRequest::getVar( 'TYPESITE' ) == '')
		$TYPESITE = 1;
	else
		$TYPESITE = 	JRequest::getVar( 'TYPESITE' );
		
	if($TYPESITE == 1)			
		return '  <a href="'.$ferst_word.'-'.$row_temp->alias3.'"> '.$row_temp->name.' </a> <img src="templates/atomic/images/strela.png">  ';
	else
		return '  <a href="'.$ferst_word.'-'.$row_temp->alias2.'"> '.$row_temp->name.' </a> <img src="templates/atomic/images/strela.png">  ';
	}
}		
			
function get_item($uin)
{
	$db = & JFactory::getDBO();
		
	$query = "SELECT * FROM 0y13_ray_servis WHERE id = ".JRequest::getInt( 'servis' );			
	$db->setQuery($query);		
	$serv = $db->loadObject();
	
	$query = "SELECT * FROM 0y13_ray_naspunkt WHERE id = ".JRequest::getInt( 'naspunkt' );			
	$db->setQuery($query);		
	$reg = $db->loadObject();	
	
	$query_temp="SELECT * FROM 0y13_ray_item WHERE id = ".$uin ;			
	$db->setQuery($query_temp);		
	$row_temp = $db->loadObject();
			
	return '  <a href="'.$serv->alias2.'-'.$row_temp->alias.'-'.$reg->alias.'"> '.$row_temp->name.' </a>  ';
}		
		
function get_servis($uin)
{
	$db = & JFactory::getDBO();
	
	if(JRequest::getInt( 'naspunkt' ))	
	{
	
		$query="SELECT * FROM 0y13_ray_naspunkt WHERE id=".JRequest::getInt( 'naspunkt' ) ;
		$db->setQuery($query);		
		$row = $db->loadObject();
	
	}
	elseif(JRequest::getInt( 'region' ))	
	{
	
		$query="SELECT * FROM 0y13_ray_region WHERE id=".JRequest::getInt( 'region' ) ;
		$db->setQuery($query);		
		$row = $db->loadObject();
	
	}
	
		
	$query_temp="SELECT * FROM 0y13_ray_servis WHERE id = ".$uin ;
			
	$db->setQuery($query_temp);		
	if($row_temp = $db->loadObject()){
			
	return '  <a href="'.$row_temp->alias.'-'.$row->alias2.'"> '.$row_temp->name.' </a> <img src="templates/atomic/images/strela.png">  ';
	}
}
		
	echo ' </p>';	
		?>
		<?php
		global $TYPESITE;
		
		if($TYPESITE != 1 && JRequest::getVar( 'option' ) == 'com_content' &&  JRequest::getVar( 'view' ) == 'article'   &&  JRequest::getVar( 'id' ) == 5)
		{
			$query = "SELECT * FROM 0y13_ray_typeobject WHERE id > 1";
				
			$db = & JFactory::getDBO();			
			$db->setQuery($query);		
			$row = $db->loadObjectList();
			foreach ($row as $servis) 
			{
			
				if($TYPESITE == $servis->id)
				{
					$document = JFactory::getDocument();
					$document->setTitle($servis->title);
					
					$document->setDescription($servis->title);
					$document->setMetaData('keywords', $servis->title);
					echo '<h1 style="border:0px; margin:0px; padding:0px; margin-bottom: -5px; margin-top: 0px; ">'.$servis->title.' </h1>';
				}
				
			}
		}
			
		?>
		<div class="simbad" style=" float:left; width:100%; ">
				<jdoc:include type="component" />
	
<?php
$controller = JRequest::getWord('view', 'itemlist');
$com_content  = JRequest::getWord('option');
$id  = JRequest::getInt('id');

if($controller == 'article' && $com_content == 'com_content' && $id == 5 )
{    
?>
<div id="map" style="width: 600px; height: 300px; float:left; "> </div>
<?php

}
?> 			
				</div>
				<div style="padding-top:5px;  " ><form action="index.php?option=com_k2&view=seach" method="post">	<input type="text" name="text" style="width:64%; border:1px solid #c6c7c7; height:18px; margin-left:5px; float: left;" id="fseatch" > <input id="bseatch"  type="submit" value="поиск" style="width:5%; background: #42d00c; background: url('<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/images/btse.png') no-repeat top center; width: 77px; height:22px; padding-bottom:3px; color:#3b6a08; border:none; float: left; margin-right:5px; "> </form> </div>
				<div class="footmenu" style="height:30px;">
				
				
				<jdoc:include type="modules" name="atomic-topmenu3" style="container" /> 
				
				<!--
				<ul>
					<li><a href="http://рай.рф/index.php?option=com_k2&view=pogoda" > Погода </a> <span class="lin"></span> </li>
					<li><a href="http://рай.рф/index.php?option=com_k2&view=curs" > Курсы валют </a> <span class="lin"></span>  </li>
					<li><a href="index.php?option=com_content&view=article&id=11" > ТВ-программа </a> <span class="lin"></span>  </li>
					<li><a href="index.php?option=com_content&view=article&id=10" > Гороскоп </a> <span class="lin"></span>  </li>
					<li><a href="index.php?option=com_content&view=article&id=9" > Новости туризма </a> </li>
				</ul>
				
				-->
				
				</div>

    
         
				</div>
		</div>
		<div class="right">

<!--  **************************************************************************************************************************************************************************************  -->			
<div class="menu-class1">		
<?php $nlist=3; 





if(JRequest::getVar( 'view' ) != 'region' && JRequest::getVar( 'view' ) != 'servis'  && JRequest::getVar( 'view' ) != 'naspunkt'  && JRequest::getVar( 'view' ) != 'item'){
include("region.php"); 
}
else
{
 include("naspunct.php");
}
 ?>
</div>

<div class="menu-class2">
    <?php
    $nlist = 4;
    if (JRequest::getVar('view') != 'region'
        && JRequest::getVar('view') != 'servis'
        && JRequest::getVar('view') != 'naspunkt'
        && JRequest::getVar('view') != 'item') {
        include("naspunct.php");
    } else {
        include("region.php");
    }
    ?>

 </div>
	</div>	
		
	</div>

	<div class="block-second" style="margin-top:-7px;">
	
    <?php
$controller = JRequest::getWord('view', 'itemlist');

if($controller != 'item'  && $controller != 'naspunkt' && $controller != 'servis')
{

	$db = & JFactory::getDBO();

//echo '<h1> '.urldecode($_SERVER['REQUEST_URI']).' </h1>'; гостиница эдем адрес
	
	/*$queryst_banner="SELECT * FROM 0y13_ray_banner WHERE page='".urldecode($_SERVER['REQUEST_URI'])."' and data_start < '".date("Y-m-d H:i:s")."' and	data_stop > '".date("Y-m-d H:i:s")."' ";
	//echo $queryst_banner;
	$db->setQuery($queryst_banner);	
	
	$row_banner = $db->loadObjectList();
	$banner = '';
    
	foreach ($row_banner as $row_b) 
	{
  
            
            $banner .= ' <td> 
				<a href="'.$row_b->url_send.'" ><img src="/media/banner/'.$row_b->object.'"></a>
				<a href="'.$row_b->url_send.'" style="width:200px; text-align:center;"> '.$row_b->text.' </a>
			</td> ';
    

    }http://рай.рф/werwe.jpg?object=584/&image=961134816.jpg
    */
    
        $where = '';
    
    if(JRequest::getVar( 'view' ) == 'cantry')
    {
        $where = " and naspunk IN ( SELECT id FROM 0y13_ray_naspunkt WHERE  cantry =".JRequest::getInt('id').") ";
    }
        
    if(JRequest::getVar( 'view' ) == 'region')
    {
        $where = " and naspunk IN ( SELECT id FROM 0y13_ray_naspunkt WHERE  region =".JRequest::getInt('id').") ";
    }
    
    if($TYPESITE > 1)
    {
        $whr = " and naspunk in (SELECT id FROM 0y13_ray_naspunkt WHERE to".($TYPESITE-1)."=1) ";
    }

    
    
    
    
    
  $queryst_banner_fixed=" SELECT  id,		 	 	
	name, 	 	 	 
	alias,	
	opisanie,		 
	osnovnoe,		 	 				 
	naspunk, 	 	 		 	 	
	service,
	 (SELECT alias2 FROM 0y13_ray_servis WHERE id=0y13_ray_item.service) as servicealias,

	 (SELECT name FROM 0y13_ray_servis WHERE id=0y13_ray_item.service) as servicename,     
	 (SELECT alias FROM 0y13_ray_naspunkt WHERE id=0y13_ray_item.naspunk) as naspunkalias,		
	 (SELECT name FROM 0y13_ray_naspunkt WHERE id=0y13_ray_item.naspunk) as nnaspunk,	
     ( SELECT	
        IF ((SELECT parent FROM 0y13_ray_naspunkt WHERE id=0y13_ray_item.naspunk) > 0,
            (SELECT name FROM 0y13_ray_naspunkt WHERE id=(SELECT parent FROM 0y13_ray_naspunkt WHERE id=0y13_ray_item.naspunk)),
            (SELECT '' as pr)	
        )) as rayon,     
	 (SELECT name FROM  d0y13_ray_cantry WHERE d0y13_ray_cantry.id=(SELECT cantry FROM 0y13_ray_naspunkt WHERE 0y13_ray_naspunkt.id=0y13_ray_item.naspunk)) as ncantry,			
	 (SELECT name FROM  0y13_ray_region WHERE 0y13_ray_region.id=(SELECT region FROM 0y13_ray_naspunkt WHERE 0y13_ray_naspunkt.id=0y13_ray_item.naspunk)) as nregion,		 	 	 	 	 	
	typeobject,	 	 	 	 	
	user,	 	 	 	 	 	
	sort,		 	 	 	 	
	oplata,	 	 	 	 	 	 	
	act,		 	 	 	 	 	 	
	act_oplata,
(SELECT 
IF ((SELECT COUNT(*) FROM 0y13_ray_image WHERE main=1 and item=0y13_ray_item.id) >0, 
	(SELECT name FROM 0y13_ray_image WHERE main=1 and item=0y13_ray_item.id limit 1),  
 	(SELECT name FROM 0y13_ray_image WHERE  item=0y13_ray_item.id limit 1))) as photo,
(SELECT value FROM 0y13_ray_image WHERE item=0y13_ray_item.id  limit 1) as photo_v,
(SELECT number FROM 0y13_ray_rp WHERE page = '".urldecode($_SERVER['REQUEST_URI'])."' and  iditem = 0y13_ray_item.id) as mesto 


  FROM 0y13_ray_item WHERE id in (SELECT iditem FROM 0y13_ray_rp WHERE page = '".urldecode($_SERVER['REQUEST_URI'])."' and date > '".date("Y-m-d")."' ) ; ";
 // echo urldecode($_SERVER['REQUEST_URI']);
 //   echo $queryst_banner_fixed;
  
	$db->setQuery($queryst_banner_fixed);	
	
	$row_banner = $db->loadObjectList();
	$banner_fix = Array();
	foreach ($row_banner as $row_b) 
	{
            
			$title_doc = $row_b->servicealias.'-'.$row_b->alias.'-'.$row_b->naspunkalias;
            
            $banner = ' <td style="width: 14.2%"> 
				<a style="  text-align:center; " href="'.$title_doc.'" ><img style="width:160px; height:120px; " src="/'.$row_b->alias.'.jpg?object='.$row_b->id.'/&image='.$row_b->photo.'&mini=1"> </a>
				<a href="'.$title_doc.'" style="  text-align:center; text-decoration: none;"> <span style="color: #28880a;"> '.str_replace("-", " ", $row_b->servicealias).' '.$row_b->name.' </span> <br> '.$row_b->ncantry.', '.$row_b->nregion.', '.$row_b->rayon.', '.$row_b->nnaspunk.' </a>
			</td> ';
            
        $banner_fix[$row_b->mesto] = $banner;
    }








    
  $queryst_banner=" SELECT  id,		 	 	
	name, 	 	 	 
	alias,	
	opisanie,		 
	osnovnoe,		 	 				 
	naspunk, 	 	 		 	 	
	service,
	 (SELECT alias2 FROM 0y13_ray_servis WHERE id=0y13_ray_item.service) as servicealias,

	 (SELECT name FROM 0y13_ray_servis WHERE id=0y13_ray_item.service) as servicename,     
	 (SELECT alias FROM 0y13_ray_naspunkt WHERE id=0y13_ray_item.naspunk) as naspunkalias,		
	 (SELECT name FROM 0y13_ray_naspunkt WHERE id=0y13_ray_item.naspunk) as nnaspunk,	
     ( SELECT	
        IF ((SELECT parent FROM 0y13_ray_naspunkt WHERE id=0y13_ray_item.naspunk) > 0,
            (SELECT name FROM 0y13_ray_naspunkt WHERE id=(SELECT parent FROM 0y13_ray_naspunkt WHERE id=0y13_ray_item.naspunk)),
            (SELECT '' as pr)	
        )) as rayon,     
	 (SELECT name FROM  d0y13_ray_cantry WHERE d0y13_ray_cantry.id=(SELECT cantry FROM 0y13_ray_naspunkt WHERE 0y13_ray_naspunkt.id=0y13_ray_item.naspunk)) as ncantry,			
	 (SELECT name FROM  0y13_ray_region WHERE 0y13_ray_region.id=(SELECT region FROM 0y13_ray_naspunkt WHERE 0y13_ray_naspunkt.id=0y13_ray_item.naspunk)) as nregion,		 	 	 	 	 	
	typeobject,	 	 	 	 	
	user,	 	 	 	 	 	
	sort,		 	 	 	 	
	oplata,	 	 	 	 	 	 	
	act,		 	 	 	 	 	 	
	act_oplata,
(SELECT 
IF ((SELECT COUNT(*) FROM 0y13_ray_image WHERE main=1 and item=0y13_ray_item.id) >0, 
	(SELECT name FROM 0y13_ray_image WHERE main=1 and item=0y13_ray_item.id limit 1),  
 	(SELECT name FROM 0y13_ray_image WHERE  item=0y13_ray_item.id limit 1))) as photo,
(SELECT value FROM 0y13_ray_image WHERE item=0y13_ray_item.id  limit 1) as photo_v



  FROM 0y13_ray_item WHERE act = 1 and oplata > 0 and act_oplata > 0  ".$whr.$where."  ORDER BY RAND() LIMIT 7;";
	//echo $queryst_banner;
	$db->setQuery($queryst_banner);	
	
	$row_banner = $db->loadObjectList();
	$banner = '';
    $nb = 0;
	foreach ($row_banner as $row_b) 
	{
  $nb++;
  
  if($banner_fix[$nb]>'')
  {
    $banner .= $banner_fix[$nb];
  }
  else
  {
            
			$title_doc = $row_b->servicealias.'-'.$row_b->alias.'-'.$row_b->naspunkalias;
            
            $banner .= ' <td style="width: 14.2%"> 
				<a style="  text-align:center; " href="'.$title_doc.'" ><img style="width:160px; height:120px; " src="/'.$row_b->alias.'.jpg?object='.$row_b->id.'/&image='.$row_b->photo.'&mini=1"> </a>
				<a href="'.$title_doc.'" style="  text-align:center; text-decoration: none;"> <span style="color: #28880a;"> '.str_replace("-", " ", $row_b->servicealias).' '.$row_b->name.' </span> <br> '.$row_b->ncantry.', '.$row_b->nregion.', '.$row_b->rayon.', '.$row_b->nnaspunk.' </a>
			</td> ';
    
}
    }  
?>
<?php if($banner>''){  ?>
<div style="width:100%; overflow: auto;">
    <table class="fbanner">
		<tr valign="top">
			<?php  
//print_r(urldecode($_SERVER['REQUEST_URI']));	
//print_r($_SERVER['REQUEST_URI']);		
            echo $banner;
            ?>           
		</tr>
	</table>
</div>    
<?php   }  else {?>

<div style="height:3px;">  </div>
<?php  }  ?>
    <?php  }
else {    ?>


    <?php  }
 ?>
   	<?php
        
        
$controller = JRequest::getWord('view', 'itemlist');
             //print_r($controller);
             if($controller == 'cantry')
             {
                $id = JRequest::getInt('id');
                $query="SELECT * FROM d0y13_ray_cantry WHERE id=".$id."";
                $db->setQuery($query);	
                if($row = $db->loadObject())
                {	
                    	global $TYPESITE;
                        
                        
                    if(JRequest::getVar( 'TYPESITE' ) == '')
                        $TYPESITE = 1;
                    else
                        $TYPESITE = 	JRequest::getVar( 'TYPESITE' );
                        
                    if($TYPESITE == 2)
                        $text_pages_write = $row->text1;
                    elseif($TYPESITE == 3)
                        $text_pages_write = $row->text2;
                    elseif($TYPESITE == 4)
                        $text_pages_write = $row->text3;
                    elseif($TYPESITE == 1)
                        $text_pages_write = $row->text0;
                }
                if($text_pages_write>'')
            echo '<div style="padding:5px; text-align:center; width:98%; float: left;"> '.preg_replace('~class="[^"]*"~i', '', preg_replace('~style="[^"]*"~i', '', $text_pages_write)).' </div>';
             
             }
             elseif($controller == 'region')
             {
                $id = JRequest::getInt('id');
                $query="SELECT * FROM 0y13_ray_region WHERE id=".$id."";
                $db->setQuery($query);	
                if($row = $db->loadObject())
                {	
                    	global $TYPESITE;
                        
                        
                    if(JRequest::getVar( 'TYPESITE' ) == '')
                        $TYPESITE = 1;
                    else
                        $TYPESITE = 	JRequest::getVar( 'TYPESITE' );
                        
                    if($TYPESITE == 2)
                        $text_pages_write = $row->text1;
                    elseif($TYPESITE == 3)
                        $text_pages_write = $row->text2;
                    elseif($TYPESITE == 4)
                        $text_pages_write = $row->text3;
                    elseif($TYPESITE == 1)
                        $text_pages_write = $row->text0;
                }
				
                if($text_pages_write>'')
            echo '<div style="padding:5px; text-align:center; width:98%; float: left;"> '.preg_replace('~class="[^"]*"~i', '', preg_replace('~style="[^"]*"~i', '', $text_pages_write)).' </div>';
             }
             elseif($controller == 'naspunkt')
             {
                $id = JRequest::getInt('id');
                $query="SELECT * FROM 0y13_ray_naspunkt WHERE id=".$id."";
                $db->setQuery($query);	
                if($row = $db->loadObject())
                {	
                    	global $TYPESITE;
                        
                        
                    if(JRequest::getVar( 'TYPESITE' ) == '')
                        $TYPESITE = 1;
                    else
                        $TYPESITE = 	JRequest::getVar( 'TYPESITE' );
                        
                    if($TYPESITE == 2)
                        $text_pages_write = $row->text1;
                    elseif($TYPESITE == 3)
                        $text_pages_write = $row->text2;
                    elseif($TYPESITE == 4)
                        $text_pages_write = $row->text3;
                    elseif($TYPESITE == 1)
                        $text_pages_write = $row->text0;
                }
				
				
            if(strlen($text_pages_write) > 10 )
			
            echo '<div style="padding:5px; text-align:center; width:98%; float: left;"> '.preg_replace('~class="[^"]*"~i', '', preg_replace('~style="[^"]*"~i', '', $text_pages_write)).' </div>';
			else
			
            echo '<div style="padding-top:3px; text-align:center; width:98%; float: left;">  </div>';
			
			
			
             }
             elseif($controller == 'article')
            {          

              	global $TYPESITE;
                        
                        
                if(JRequest::getVar( 'TYPESITE' ) == '')
                    $TYPESITE = 1;
                else
                    $TYPESITE = 	JRequest::getVar( 'TYPESITE' );
                
                $idco = 24;
                
                if($TYPESITE == 2)
                {                
                    $idco = 21;
                }
                elseif($TYPESITE == 3)
                {
                    $idco = 22;
                }
                elseif($TYPESITE == 4)
                {
                    $idco = 23;
                }
                
                $query_p="SELECT * FROM d0y13_content WHERE id=".$idco."";
                
                $db->setQuery($query_p);	
                
                if($row_p = $db->loadObject())
                {
                    ?>
<style>
.skjdnhf *{
  font-family: Arial,Helvetica,sans-serif;  
  font-size: 12px;
}
</style>
<?					
				echo '<div style="padding-top:3px; text-align:center; width:98%; float: left;  font-family: Arial,Helvetica,sans-serif;  font-size: 12px;" class="skjdnhf">  '.preg_replace('~class="[^"]*"~i', '', preg_replace('~style="[^"]*"~i', '',   $row_p->introtext)).' </div>';
                }                
            }             
             elseif($controller == 'item' || $controller == 'servis'  ||  $controller == 'naspunkt'  ||  $controller == 'naspunkt' )
             {
             
            echo '<div style="padding-top:3px; text-align:center; width:98%; float: left;">  </div>';
            }
             
 
            
        
        ?>
	
	<div class="foot">
		<div class="foot1">
			<div class="foot2">
            
				<jdoc:include type="modules" name="atomic-topmenu2" style="container" /> 
				<p>TvoyRay.ru 2007-2012. Рай.рф все права защищены © 2012-<?php echo date("Y"); ?></p>

			</div>
		</div>
	</div>
	
	</div>

</div>
	
	
	
	
	
</body>
</html>

<?php
function GetBanner($db){
    $getbanner = array(
        "url" => "#",
        "src" => "banner.jpg"
    );

    $query = "SELECT * FROM 0y13_ray_banner  WHERE page ='" . urldecode($_SERVER['REQUEST_URI']) . "' and position='0' and data > '" . date("Y-m-d") . "'  ORDER BY RAND()  limit 1; ";
    $db->setQuery($query);

    if ($row = $db->loadObject()) {
        $getbanner["url"] = $row->url;
        $getbanner["src"] = $row->object;
    }
    return $getbanner;
}
?>