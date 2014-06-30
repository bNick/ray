<?php
header("Content-type: text/html; charset=utf-8");
/**
 * @version		$Id: default.php 1188 2011-10-17 14:25:19Z joomlaworks $
 * @package		K2
 * @author		JoomlaWorks http://www.joomlaworks.gr
 * @copyright	Copyright (c) 2006 - 2011 JoomlaWorks Ltd. All rights reserved.
 * @license		GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

$document = & JFactory::getDocument();

	$db = & JFactory::getDBO();
	
if( JRequest::getVar('save') && JRequest::getInt('cid') != 0)
{
		$query = "UPDATE  0y13_ray_region SET  name =  '".(JRequest::getVar('name'))."',
cantry =  '".(JRequest::getVar('cantry'))."',
alias =  '".(JRequest::getVar('alias'))."',
alias2 =  '".(JRequest::getVar('alias2'))."',
maps =  '".(JRequest::getVar('maps'))."',
alias3 =  '".(JRequest::getVar('alias3'))."',
text1 =  '".$_POST['text1']."',
text2 =  '".$_POST['text2']."',
text3 =  '".$_POST['text3']."',
text0 =  '".$_POST['text0']."',
banner1 = '".$_POST['banner1']."',
banner2 = '".$_POST['banner2']."',
banner3 = '".$_POST['banner3']."',
banner4 = '".$_POST['banner4']."',
url2 = '".$_POST['url1']."',
url3 = '".$_POST['url2']."',
url4 = '".$_POST['url3']."',
url1 = '".$_POST['url4']."'
 WHERE  id =".(JRequest::getVar('cid'))." LIMIT 1 ;";
		$db->setQuery($query);
		$db->query();	
		
		echo "<script language='JavaScript'> 
  window.location.href = '".str_replace('&amp;', '&', JRoute::_('index.php?option=com_k2&view=tags'))."'
</script>";
}
elseif( JRequest::getVar('save'))
{

		$query = "INSERT INTO 0y13_ray_region (id, cantry, name, maps, alias, alias2, alias3, text1, text2, text3, text0, banner1, banner2, banner3, banner4, url1, url2, url3, url4) VALUES
		(NULL, '".(JRequest::getVar('cantry'))."', '".(JRequest::getVar('name'))."', '".(JRequest::getVar('maps'))."', 
		'".(JRequest::getVar('alias'))."', '".(JRequest::getVar('alias2'))."', '".(JRequest::getVar('alias3'))."', 
		'".($_POST['text1'])."', '".($_POST['text2'])."', 
		'".($_POST['text3'])."', '".($_POST['text0'])."', '".($_POST['banner1'])."', '".($_POST['banner2'])."', '".($_POST['banner3'])."', '".($_POST['banner4'])."', '".($_POST['url1'])."', '".($_POST['url2'])."', '".($_POST['url4'])."', '".($_POST['url4'])."');";
	//echo $query;
	$db->setQuery($query);
		$db->query();
	echo "<script language='JavaScript'> 
  window.location.href = '".str_replace('&amp;', '&', JRoute::_('index.php?option=com_k2&view=tags'))."'
</script>";
}
else
{


	$query="SELECT 
					id, 
					(SELECT name FROM  d0y13_ray_cantry where id=cantry) as ncantry,
					(SELECT id FROM  d0y13_ray_cantry where id=cantry) as idcantry,
					name,
					maps,
					alias,
					alias2,
					alias3,
					text1,
					text2,
					text3,
					text0,
					banner1,
					banner2,
					banner3,
					banner4,
					url1,
					url2,
					url3,
					url4
			FROM 
					0y13_ray_region where id=".(JRequest::getInt('cid'));	
					
	$db->setQuery($query);
	$row = $db->loadObject();
}


?>
<form action="" enctype="multipart/form-data" method="post" name="adminForm" id="adminForm">
	<table cellspacing="0" cellpadding="0" border="0" class="adminFormK2Container adminK2Category">
		<tbody>
			<tr>
				<td>
					<table class="adminFormK2">
						<tr>
							<td class="adminK2LeftCol">
								<label for="name"><?php echo JText::_('K2_TITLE'); ?></label>
							</td>
							<td class="adminK2RightCol">
								<input class="text_area k2TitleBox" type="text" name="name" id="name" value="<?php echo $row->name; ?>" maxlength="250" />
							</td>
						</tr>
						<tr>
							<td class="adminK2LeftCol">
								<label for="alias"> Страна </label>
							</td>
							<td class="adminK2RightCol">
							
							<?php
							
								$query="SELECT 	*	FROM d0y13_ray_cantry";	
								$db->setQuery($query);
								$row_cantry = $db->loadObjectList();
							
							?>
							
							<select name="cantry" >
							<?php foreach ($row_cantry as $cantry): 
							if($cantry->id == $row->idcantry)  
							  echo "<option value='".$cantry->id."' selected>".$cantry->name."</option>";
							else   
							   echo "<option value='".$cantry->id."'>".$cantry->name."</option>";
							 
							 endforeach; ?>
							</select>
							</td>
						</tr>
						<tr>
							<td class="adminK2LeftCol">
								<label for="alias"><?php echo JText::_('K2_TITLE_ALIAS'); ?></label>
							</td>
							<td class="adminK2RightCol">
								<input class="text_area k2TitleAliasBox" type="text" name="alias" value="<?php echo $row->alias; ?>" maxlength="250" />
							</td>
						</tr>
						<tr>
							<td class="adminK2LeftCol">
								<label for="alias">Псевдоним заголовка(Родительный падеж)</label>
							</td>
							<td class="adminK2RightCol">
								<input class="text_area k2TitleAliasBox" type="text" name="alias2" value="<?php echo $row->alias2; ?>" maxlength="250" />
							</td>
						</tr>
						<tr>
							<td class="adminK2LeftCol">
								<label for="alias">Псевдоним заголовка(Винительный падеж)</label>
							</td>
							<td class="adminK2RightCol">
								<input class="text_area k2TitleAliasBox" type="text" name="alias3" value="<?php echo $row->alias3; ?>" maxlength="250" />
							</td>
						</tr>
						<tr>
							<td class="adminK2LeftCol">
								<label for="alias"> Текст по типам объектов </label>
							</td>
							<td class="adminK2RightCol">
								
							<p>Общее описание</p>							
							<p> <textarea name="text0"><?php echo $row->text0; ?></textarea> </p>
							<?php
							
							
							
	$query_to="SELECT 	*	FROM 0y13_ray_typeobject WHERE id>1";	
	$db->setQuery($query_to);
	$row_to = $db->loadObjectList();
	$i = 0;

						foreach ($row_to as $tot){ 
							$i++;
							
							if($i == 1)
							{
								echo '<p> '.$tot->name.'</p>';
							
								echo '<p> <textarea name="text1"> '.$row->text1.' </textarea> </p>';	
								
							}
							if($i == 2)	
							{
								echo '<p> '.$tot->name.' </p>';
								
								echo '<p> <textarea name="text2"> '.$row->text2.' </textarea> </p>';	
							}
							if($i == 3)	
							{
								echo '<p> '.$tot->name.'</p>';
							
								echo '<p> <textarea name="text3"> '.$row->text3.' </textarea> </p>';	
							}
						}
							
							
							?>
							
							</td>
						</tr>
						<tr>
							<td class="adminK2LeftCol">Карта
							</td>
							<td class="adminK2RightCol">
						<div id="map" style="width: 1200px; height: 800px"></div>
<input type="hidden" name="maps"  id="geometry" value="<?php  echo $row->maps; ?>"/>
							</td>
						</tr>
                        <tr>
                            <td class="adminK2LeftCol">
                                <label for="banner1">Баннер для страны (шапка)</label>
                            </td>
                            <td class="adminK2RightCol">
                                <input class="text_area k2TitleAliasBox" type="text" name="banner1" value="<?php echo $row->banner1; ?>" />
                            </td>
                        </tr>
                        <tr>
                            <td class="adminK2LeftCol">
                                <label for="url1">URL (шапка)</label>
                            </td>
                            <td class="adminK2RightCol">
                                <input class="text_area k2TitleAliasBox" type="text" name="url1" value="<?php echo $row->url1; ?>" />
                            </td>
                        </tr>
						<tr>
							<td class="adminK2LeftCol"> 
							<a style="width:200px; height:40px; font-size:16px;" href="<?php echo JRoute::_('index.php?option=com_k2&view=categories'); ?>"  > Вернуться </a>
							</td>
							<td class="adminK2RightCol">
								<input type="submit" name="save" value="Сохранить" style="width:200px; height:40px; font-size:16px;"  />
							</td>
						</tr>
					</table>
					
				</td>
			</tr>
		</tbody>
	</table>
	<input type="hidden" name="id" value="<?php echo $this->row->id; ?>" />
	<input type="hidden" name="option" value="com_k2" />
	<input type="hidden" name="view" value="tag" />
	<input type="hidden" name="task" value="<?php echo JRequest::getVar('task'); ?>" />
	<?php echo JHTML::_('form.token'); ?>
</form>
    <script src="http://api-maps.yandex.ru/2.0/?load=package.full,util.json&lang=ru-RU"
            type="text/javascript"></script>

    <!--
        Основная библиотека JQuery.
        Яндекс предоставляет хостинг JavaScript-библиотек:
    -->
    <script src="http://yandex.st/jquery/1.6.4/jquery.min.js" type="text/javascript"></script>

   <script type="text/javascript">
	
</script>

    <script type="text/javascript">

        // Как только будет загружен API и готов DOM, выполняем инициализацию
        ymaps.ready(init);
var myMap;

var arrayM = <?php  if(sizeof($row) > 0) echo  $row->maps; else echo '[6, [53.057219943574,11.167717023287562], [ [ [ 54.9330, 9.74579 ], [ 53.8136, 9.17171 ], [ 54.3746, 8.83793 ], [ 54.9330, 9.74579 ] ] ]]';  ?> ;

        function init () {
             myMap = new ymaps.Map("map", {
                    center: arrayM[1],
                    zoom: arrayM[0]
                }),
                myGeometry = {
                    type: 'Polygon',
                    coordinates: arrayM[2]
                },
                myOptions = {
                    strokeWidth: 6,
					
								opacity: 0.5,
                    strokeColor: '#0000FF', // синий
                    fillColor: '#FFFF00', // желтый
                    draggable: true      // объект можно перемещать, зажав левую кнопку мыши
                };

            myMap.controls
			
                .add('zoomControl')
				
                .add('typeSelector')
				.add('miniMap')
				
                .add('mapTools');
            // Создаем геообъект с определенной (в switch) геометрией.
            var myGeoobject = new ymaps.GeoObject({geometry: myGeometry}, myOptions);

            // При визуальном редактировании геообъекта изменяется его геометрия.
            // Тип геометрии измениться не может, однако меняются координаты.
            // При изменении геометрии геообъекта будем выводить массив его координат.
            myGeoobject.events.add('geometrychange', function (event) {
                printGeometry(myGeoobject.geometry.getCoordinates());
            });

            // Размещаем геообъект на карте
            myMap.geoObjects.add(myGeoobject);
            // ... и выводим его координаты.
            printGeometry(myGeoobject.geometry.getCoordinates());
            // Подключаем к геообъекту редактор, позволяющий
            // визуально добавлять/удалять/перемещать его вершины.
            myGeoobject.editor.startEditing();
        }

        // Выводит массив координат геообъекта в <div id="geometry">
        function printGeometry (coords) {
		
            $('#geometry').val('['+myMap.getZoom()+', ['+myMap.getCenter()+'], '+stringify(coords)+']');

            function stringify (coords) {
                var res = '';
                if ($.isArray(coords)) {
                    res = '[ ';
                    for (var i = 0, l = coords.length; i < l; i++) {
                        if (i > 0) {
                            res += ', ';
                        }
                        res += stringify(coords[i]);
                    }
                    res += ' ]';
                } else if (typeof coords == 'number') {
                    res = coords.toPrecision(6);
                } else if (coords.toString) {
                    res = coords.toString();
                }

                return res;
            }
        }
    </script>