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
    {
		$TYPESITE = 1;
    }
	else
    {
		$TYPESITE = 	JRequest::getVar( 'TYPESITE' );
        
    }
		
	$queryt="SELECT * FROM 0y13_ray_typeobject WHERE id = ".$TYPESITE;	
	$db->setQuery($queryt);	
	$ferst_word = '';	
	if($row = $db->loadObject())
	{	
		$ferst_word = $row->alias;
	}
	
	
$view = JRequest::getVar( 'view' ) ;

if(JRequest::getVar( 'view' ) == 'cantry' || JRequest::getVar( 'cantry' ) != '')
{
	if( $view == 'cantry' )
	{
		$seatch = ' WHERE  cantry = '.JRequest::getVar( 'id' );
	}
	else
	{
		$seatch = ' WHERE  cantry = '.JRequest::getVar( 'cantry' );	
	}

	if(JRequest::getVar( 'view' ) == 'region')
		$this_element = JRequest::getVar( 'id' );
	else
		$this_element = JRequest::getVar( 'region' );	


	echo '
				<div class="title" id="yesmap"> Регионы </div>
				<div class="list" id="list'.$nlist.'">
				<ul>';
                
        if($TYPESITE == 1)
        {
            $query="SELECT * FROM 0y13_ray_region ".$seatch."   ORDER BY name ASC ;";
        }
        else
        {
            $query="SELECT * FROM 0y13_ray_region ".$seatch."  and id in (SELECT region FROM 0y13_ray_naspunkt WHERE to".($TYPESITE-1)."=1 GROUP BY region)   ORDER BY name ASC ;";
        }        
                

		$db->setQuery($query);	
		
		$row = $db->loadObjectList();
	
	$script = '	<script> 	map_point = { ';
		
	$m='no-';
	if($view == 'cantry')
	{
		$m = '';
	}
		foreach ($row as $servis) 
		{
			$i++;
			if($servis->id == $this_element )
			{
				if($TYPESITE == 1)
                {
                    if($m > '')
                        echo '<li style="font-weight:bold; color: #FF0000; " class="ws"> <a style="color: #FF0000;"  href="'.$ferst_word.'-'.$servis->alias3.'"> '.$servis->name.' </a> </li>';
                    else
                        echo '<li style="font-weight:bold; color: #FF0000; " class="ws"> <a style="color: #FF0000;"  href="'.$ferst_word.'-'.$servis->alias3.'" class="'.$m.'itemmaps'.$i.'"> '.$servis->name.' </a> </li>';
                        
                }
                else
                {     if($m > '')
                        echo '<li style="font-weight:bold; color: #FF0000; " class="ws"> <a style="color: #FF0000;"  href="'.$ferst_word.'-'.$servis->alias2.'"> '.$servis->name.' </a> </li>';
                    else
                        echo '<li style="font-weight:bold; color: #FF0000; " class="ws"> <a style="color: #FF0000;"  href="'.$ferst_word.'-'.$servis->alias2.'" class="'.$m.'itemmaps'.$i.'"> '.$servis->name.' </a> </li>';

				}
				
				$script = $script." '".$servis->name."': ".$servis->maps."";
				if($i < sizeof($row))
				{
					$script = $script.", \n ";
				}
			}
			else
			{
				if($TYPESITE == 1)
				{
                    if($m > '')
                        echo '<li> <a href="'.$ferst_word.'-'.$servis->alias3.'"> '.$servis->name.' </a> </li>';                        
                    else
                        echo '<li> <a href="'.$ferst_word.'-'.$servis->alias3.'" class="'.$m.'itemmaps'.$i.'"> '.$servis->name.' </a> </li>';
					
				}
				else
				{
                    if($m > '')
                        echo '<li> <a href="'.$ferst_word.'-'.$servis->alias2.'"> '.$servis->name.' </a> </li>';                    
                    else
                        echo '<li> <a href="'.$ferst_word.'-'.$servis->alias2.'" class="'.$m.'itemmaps'.$i.'"> '.$servis->name.' </a> </li>';
					
				}
				
				$script = $script." '".$servis->name."': ".$servis->maps."";
				if($i < sizeof($row))
				{
					$script = $script.", \n";
				}
			
			}
				
		}
		
				
		$script = $script."	}; run = 1; </script> ";

	
echo '</ul>
				</div>
			';	
		if($view == 'cantry')
		{
			echo $script;
			echo '<script>

run = 1; 

</script>';
		}
		
}
else
{
    $ban = GetBanner($db, 2);
    echo ' <a href="'.$ban["url"].'"> <img src="'.$ban["src"].'"  id="blist3" style="width:199px;"> </a> ';
}




?>