<?php
header("Content-type: text/html; charset=utf-8");
/**
 * @version		$Id: default.php 1225 2011-10-18 16:22:02Z joomlaworks $
 * @package		K2
 * @author		JoomlaWorks http://www.joomlaworks.gr
 * @copyright	Copyright (c) 2006 - 2011 JoomlaWorks Ltd. All rights reserved.
 * @license		GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

$document = & JFactory::getDocument();
$document->addScriptDeclaration("
	\$K2(document).ready(function(){
		\$K2('#K2ImportContentButton').click(function(event){
			var answer = confirm('".JText::_('K2_WARNING_YOU_ARE_ABOUT_TO_IMPORT_ALL_SECTIONS_CATEGORIES_AND_ARTICLES_FROM_JOOMLAS_CORE_CONTENT_COMPONENT_COM_CONTENT_INTO_K2_IF_THIS_IS_THE_FIRST_TIME_YOU_IMPORT_CONTENT_TO_K2_AND_YOUR_SITE_HAS_MORE_THAN_A_FEW_THOUSAND_ARTICLES_THE_PROCESS_MAY_TAKE_A_FEW_MINUTES_IF_YOU_HAVE_EXECUTED_THIS_OPERATION_BEFORE_DUPLICATE_CONTENT_MAY_BE_PRODUCED', true)."');
			if (!answer){
				event.preventDefault();
			}
		});
	});
");
	$db = & JFactory::getDBO();
if(JRequest::getVar('del') > '')
{
$query = "DELETE FROM  d0y13_ray_cantry WHERE id=".(JRequest::getVar('del'))." ;";
		$db->setQuery($query);
		$db->query();	
}
		
		

	$query="SELECT 
					*
			FROM 
					d0y13_ray_cantry";	
	$db->setQuery($query);
	$row = $db->loadObjectList();

	
?>

<form action="index.php" method="post" name="adminForm" id="adminForm">
	<!--<table class="k2AdminTableFilters">
		<tr>
			<td class="k2AdminTableFiltersSearch">
				<?php echo JText::_('K2_FILTER'); ?>
				<input type="text" name="search" value="<?php echo $this->lists['search'] ?>" class="text_area"	title="<?php echo JText::_('K2_FILTER_BY_TITLE'); ?>" />
				<button id="k2SubmitButton"><?php echo JText::_('K2_GO'); ?></button>
				<button id="k2ResetButton"><?php echo JText::_('K2_RESET'); ?></button>
			</td>
			<td class="k2AdminTableFiltersSelects">
				<?php echo $this->lists['trash']; ?> <?php echo $this->lists['featured']; ?> &nbsp;| <?php echo $this->lists['categories']; ?>
				<?php if(isset($this->lists['tag'])): ?>
				<?php echo $this->lists['tag']; ?>
				<?php endif; ?>
				<?php echo $this->lists['authors']; ?> <?php echo $this->lists['state']; ?>
				<?php if(isset($this->lists['language'])): ?>
				<?php echo $this->lists['language']; ?>
				<?php endif; ?>
			</td>
		</tr>
	</table>
	-->
    
    <h1>Количество: <?php  echo sizeof($row);  ?> </h1>
    	<table class="adminlist">
		<thead>
			<tr>
				<th>
					Удалить
				</th>
				<th>
					№
				</th>
				<th>
					Название
				</th>
<!--                <th>-->
<!--                    Баннер-->
<!--                </th>-->
					
				
			</tr>
		</thead>
		<tbody>
			<?php $m = 0;  foreach ($row as $servis):  $m ++;  ?>
			<tr class="row">
				<td>
                    <a href="#" onclick="funct(<?php echo $m ; ?>)"  class="deletebutton" > Удалить  </a>
                    <span id="deletepanel<?php echo $m ; ?>" style="display:none;">
					<a href="<?php echo JRoute::_('index.php?option=com_k2&view=categories&del='.$servis->id); ?>"  style="color:#FF0000;"> Да </a> <a href="#" onclick="funct2(<?php echo $m ; ?>)"  style="color:#000000;"> Нет </a>
                    </span>
				</td>
				<td>
					<a href="<?php echo JRoute::_('index.php?option=com_k2&view=category&cid='.$servis->id); ?>"> <?php echo  $servis->id; ?> </a>
				</td>
				<td>
                    <a href="<?php echo JRoute::_('index.php?option=com_k2&view=category&cid='.$servis->id); ?>"><?php echo  $servis->name; ?> </a>
                </td>
<!--                <td>-->
<!--                    <a href="--><?php //echo JRoute::_('index.php?option=com_k2&view=category&cid='.$servis->id); ?><!--">--><?php //echo  $servis->banner1; ?><!-- </a>-->
<!--                </td>-->
			</tr>	
			<?php endforeach; ?>
		</tbody>
	</table>
	<input type="hidden" name="option" value="com_k2" />
	<input type="hidden" name="view" value="<?php echo JRequest::getVar('view'); ?>" />
	<input type="hidden" name="task" value="<?php echo JRequest::getVar('task'); ?>" />
	<input type="hidden" name="filter_order" value="<?php echo $this->lists['order']; ?>" />
	<input type="hidden" name="filter_order_Dir" value="<?php echo $this->lists['order_Dir']; ?>" />
	<input type="hidden" name="boxchecked" value="0" />
	<?php echo JHTML::_('form.token'); ?>
</form>
<script type="text/javascript">

function funct(v){
document.getElementById("deletepanel"+v).style.display = 'block';
}

function funct2(v){
document.getElementById("deletepanel"+v).style.display = 'none';
}
</script>