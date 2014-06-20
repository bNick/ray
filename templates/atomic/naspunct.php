<?php 
/**
 * @version		$Id: mod_k2_tools.php 1229 2011-10-18 17:55:00Z joomlaworks $
 * @package		K2
 * @author		JoomlaWorks http://www.joomlaworks.gr
 * @copyright	Copyright (c) 2006 - 2011 JoomlaWorks Ltd. All rights reserved.
 * @license		GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

$i=0;
	$db = & JFactory::getDBO();
	global $TYPESITE;
	
	if(JRequest::getVar( 'TYPESITE' ) == '')
		$TYPESITE = 1;
	else
		$TYPESITE = 	JRequest::getVar( 'TYPESITE' );

	$query="SELECT * FROM 0y13_ray_typeobject WHERE id = ".$TYPESITE;	
	$db->setQuery($query);	
	$ferst_word = '';	
	if($row = $db->loadObject())
	{	
		$ferst_word = $row->alias;
	}
	


if(JRequest::getInt( 'region' ) != '' || JRequest::getVar( 'view' ) == 'region')
{

$cantry = -1;
if(JRequest::getVar( 'cantry' ) != '')
	$cantry = JRequest::getVar( 'cantry' );
	
$region = -1;
if(JRequest::getVar( 'region' ) != '')
	$region = JRequest::getVar( 'region' );
	
if(JRequest::getVar( 'view' ) == 'region')
	$region = JRequest::getVar( 'id' );

                
        if($TYPESITE == 1)
        {
            $seatch = ' WHERE  cantry = '.$cantry.' and   region = '.$region.' and parent = 0     ORDER BY name ASC ;';	
        }
        else
        {
          //  $seatch = ' WHERE  cantry = '.$cantry.' and   region = '.$region.' and  to'.($TYPESITE-1).'=1 and parent = 0     ORDER BY name ASC ;';	
            $seatch = ' WHERE  id in 
            (
                SELECT parent    FROM 0y13_ray_naspunkt WHERE cantry = '.$cantry.' and   region = '.$region.' and  to'.($TYPESITE-1).'=1  and parent <> 0  GROUP BY parent  ORDER BY name ASC 
            );
            
            ';	
        }           
    //echo  $seatch;



if(JRequest::getVar( 'view' ) == 'naspunkt')
	$this_element = JRequest::getVar( 'id' );
else
	$this_element = JRequest::getVar( 'naspunkt' );	




echo '
				<div class="title" id="yesmap"> Населенные пункты </div>
				<div class="list" id="list'.$nlist.'">
				<ul>';
	$db = & JFactory::getDBO();
	$query="SELECT * FROM 0y13_ray_naspunkt ".$seatch ;

	$db->setQuery($query);	
	
	$row = $db->loadObjectList();

	$script = '	<script  type="text/javascript" >	map_point = { ';
	
		foreach ($row as $servis) 
		{
			$i++;
			if($servis->id == $this_element )
			{
				if($TYPESITE == 1)
					echo '<li style="font-weight:bold; color: #FF0000; "> <a style="color: #FF0000;"  href="'.$ferst_word.'-'.$servis->alias3.'" class="itemmaps'.$i.'"> '.$servis->name.' </a> </li>';
				else
					echo '<li style="font-weight:bold; color: #FF0000; "> <a style="color: #FF0000;"  href="'.$ferst_word.'-'.$servis->alias2.'" class="itemmaps'.$i.'"> '.$servis->name.' </a> </li>';
				
				$script = $script." '".$servis->name."': ".$servis->maps.", ";
				//if($i < sizeof($row))
				//{
					//$script = $script.", \n ";
				//}
			}
			else
			{
				if($TYPESITE == 1)
				{
					if($servis->parent != 0)
						echo '<li> <a href="'.$ferst_word.'-'.$servis->alias3.'" class="itemmaps'.$i.'"> '.$servis->name.' </a> </li>';
					else
						echo '<li style="font-weight:bold;"> <a href="'.$ferst_word.'-'.$servis->alias3.'" class="itemmaps'.$i.'">  '.$servis->name.' </a> </li>';
					
				}
				else
				{
				
					if($servis->parent != 0)
						echo '<li> <a href="'.$ferst_word.'-'.$servis->alias2.'" class="itemmaps'.$i.'"> '.$servis->name.' </a> </li>';
					else
						echo '<li style="font-weight:bold;"> <a href="'.$ferst_word.'-'.$servis->alias2.'" class="itemmaps'.$i.'">  '.$servis->name.' </a> </li>';
						
				}
				
				
				$script = $script." '".$servis->name."': ".$servis->maps.", ";
				//if($i < sizeof($row))
				//{
				//	$script = $script.", \n";
				//}
			
			}

		/*---------------------------------------------------------------------------------------*/
			if($TYPESITE == 1)
        {
			$queryp="SELECT * FROM 0y13_ray_naspunkt WHERE parent=".$servis->id.'    ORDER BY name ASC ; ' ;
		
}
else
{

			$queryp="SELECT * FROM 0y13_ray_naspunkt WHERE parent=".$servis->id.' and  to'.($TYPESITE-1).'=1     ORDER BY name ASC ; ' ;
}
		
			
			
			$db->setQuery($queryp);	
			$rowp = $db->loadObjectList();			
			foreach ($rowp as $servisp) 
			{

		/*---------------------------------------------------------------------------------------*/
		
			$i++;
			if($servisp->id == $this_element || $servisp->parent == $this_element )
			{
				if($TYPESITE == 1)
					echo '<li style="font-weight:bold; color: #FF0000; "  class="ws"> <a style="color: #FF0000;"  href="'.$ferst_word.'-'.$servisp->alias3.'" class="itemmaps'.$i.'"> '.$servisp->name.' </a> </li>';
				else
					echo '<li style="font-weight:bold; color: #FF0000; "  class="ws"> <a style="color: #FF0000;"  href="'.$ferst_word.'-'.$servisp->alias2.'" class="itemmaps'.$i.'"> '.$servisp->name.' </a> </li>';
				
				$script = $script." '".$servisp->name."': ".$servisp->maps.", ";
				//if($i < sizeof($rowp))
				//{
				//	$script = $script.", \n ";
				//}
			}
			else
			{
				if($TYPESITE == 1)
				{
					if($servisp->parent != 0)
						echo '<li> <a href="'.$ferst_word.'-'.$servisp->alias3.'" class="itemmaps'.$i.'"> '.$servisp->name.' </a> </li>';
					else
						echo '<li style="font-weight:bold;"> <a href="'.$ferst_word.'-'.$servisp->alias3.'" class="itemmaps'.$i.'">  '.$servisp->name.' </a> </li>';
					
				}
				else
				{
				
					if($servisp->parent != 0)
						echo '<li> <a href="'.$ferst_word.'-'.$servisp->alias2.'" class="itemmaps'.$i.'"> '.$servisp->name.' </a> </li>';
					else
						echo '<li style="font-weight:bold;"> <a href="'.$ferst_word.'-'.$servisp->alias2.'" class="itemmaps'.$i.'">  '.$servisp->name.' </a> </li>';
						
				}
				
				
				$script = $script." '".$servisp->name."': ".$servisp->maps.", ";
				//if($i < sizeof($rowp))
				//{
				//	$script = $script.", \n";
				//}
			
			}
			
		
		/*---------------------------------------------------------------------------------------*/
			
			
			
			}				
		}
		
		$script = mb_substr($script, 0, -2)."	}; run = 1; </script> ";

	
		
		
		echo '</ul>
				</div>
			
		';
		if(JRequest::getVar( 'view' ) == 'region')
		{
			echo $script;
		}
}
else
{
    $ban = GetBanner($db, 3);
    echo ' <a href="'.$ban["url"].'"> <img src="'.$ban["src"].'"  id="blist4" style="width:199px;"> </a> ';
}
?>