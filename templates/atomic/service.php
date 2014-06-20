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

	global $TYPESITE;
	
	if(JRequest::getVar( 'TYPESITE' ) == '')
		$TYPESITE = 1;
	else
		$TYPESITE = 	JRequest::getVar( 'TYPESITE' );


if(JRequest::getVar( 'view' ) == 'region' || JRequest::getVar( 'view' ) == 'servis'  || JRequest::getVar( 'view' ) == 'naspunkt'  || JRequest::getVar( 'view' ) == 'item')
{
	echo '
				<div class="title" id="yesmap"> Услуги </div>
				<div class="list" id="list'.$nlist.'">
				<ul>';
	$db = & JFactory::getDBO();
	$id_region = -1;

	if(JRequest::getVar( 'view' ) == 'region' )
		$id_region = JRequest::getVar( 'id' );
		else
		$id_region = JRequest::getInt( 'region' );
		if($TYPESITE == 1)
		$query="SELECT id, name, alias, alias2, parent, (SELECT sort FROM 0y13_ray_servis WHERE id=sr.parent) as parname   FROM 0y13_ray_servis as sr WHERE id in (SELECT service FROM 0y13_ray_item WHERE (SELECT region FROM 0y13_ray_naspunkt   WHERE id=naspunk)=$id_region GROUP BY service) ORDER BY parname	 DESC, parent DESC, name ASC  ;";
		else
		$query="SELECT id, name, alias, alias2, parent, (SELECT sort FROM 0y13_ray_servis WHERE id=sr.parent) as parname   FROM 0y13_ray_servis as sr WHERE id in (SELECT service FROM 0y13_ray_item WHERE (SELECT region FROM 0y13_ray_naspunkt  WHERE id=naspunk and  to".($TYPESITE-1)."=1 )=$id_region GROUP BY service) ORDER BY parname	 DESC, parent DESC, name ASC  ;";
		
		$db->setQuery($query);		
		$row = $db->loadObjectList();
		$cp = 0;
        
		foreach ($row as $servis) 	
		{		
			$query_temp="SELECT * FROM 0y13_ray_region WHERE id=$id_region   ORDER BY name ASC ;";
			
			$db->setQuery($query_temp);		
			$row_temp = $db->loadObject();
			
			$query_p="SELECT * FROM 0y13_ray_servis WHERE id=".$servis->parent."   ORDER BY name ASC ;";
			//echo $query_p;
			$db->setQuery($query_p);		
			$row_p = $db->loadObject();
			$sty = '';
			
			if(JRequest::getVar( 'view' ) == 'servis' && (  JRequest::getInt( 'id' ) == $servis->parent || JRequest::getInt( 'id' ) == $servis->id ))			
			{
				$sty = '  style="font-weight:bold; color: #FF0000; "   class="ws" ';
			}
			
			
		if($cp != $row_p->id)
		{		
			$sty2 = '';		
			if(JRequest::getVar( 'view' ) == 'servis' && (  JRequest::getInt( 'id' ) == $row_p->parent || JRequest::getInt( 'id' ) == $row_p->id ))			
			{
				$sty2 = '  style="font-weight:bold; color: #FF0000; " ';
			}	
            if($sty2 > '')
                echo '<li class="ws" > <b> <a '.$sty2.' href="'.$row_p->alias.'-'.$row_temp->alias2.'"> '.$row_p->name.' </a> </b></li>';
            else
                echo '<li> <b> <a '.$sty2.' href="'.$row_p->alias.'-'.$row_temp->alias2.'"> '.$row_p->name.' </a> </b></li>';
            
			$cp = $row_p->id;
		}
         if($sty > '')
			echo '<li class="ws" > <a '.$sty.' href="'.$servis->alias.'-'.$row_temp->alias2.'"> '.$servis->name.' </a> </li>';
          else
			echo '<li> <a '.$sty.' href="'.$servis->alias.'-'.$row_temp->alias2.'"> '.$servis->name.' </a> </li>';
          
            
		}

echo '</ul>
				</div>
			';

}
else
{
    $ban = GetBanner($db, 1);
    echo ' <a href="'.$ban["url"].'"> <img src="'.$ban["src"].'"  id="blist2" style="width:199px;"> </a> ';
}		
?>