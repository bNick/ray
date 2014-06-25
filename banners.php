<?php
/**
 * Created by PhpStorm.
 * User: Николай
 * Date: 25.06.14
 * Time: 21:45
 */

defined('_JEXEC') or die('Restricted access');


function GetBanner($db, $banner_type){
    $getbanner = array(
        //ToDo: Дефолтные значения должны браться со странницы "баннеры"
        "url" => "/",
        "src" => "banner.jpg"
    );
    $ids = GetID();

    if (empty($ids["countryID"]) & empty($ids["regionID"])){
        //Главная страница
        $getbanner = GetArticleBanner($db, $banner_type);
    }elseif(!empty($ids["countryID"]) & empty($ids["regionID"])){
        //Страны
        $getarticlebanner = GetArticleBanner($db, $banner_type);
        $getcountrybanner = GetCountryBanner($db, $banner_type, $ids);
        $getbanner["url"] = ($getarticlebanner["url"] == "/")?"/":$getcountrybanner["url"];
        $getbanner["src"] = ($getarticlebanner["src"] == "banner.jpg")?"banner.jpg":$getcountrybanner["src"];
    }elseif(!empty($ids["countryID"]) & !empty($ids["regionID"])){
        //Регионы
        $getarticlebanner = GetArticleBanner($db, $banner_type);
        $getcountrybanner = GetCountryBanner($db, $banner_type, $ids);
        $getregionbanner = GetRegionBanner($db, $banner_type, $ids);

        $getbanner["url"] = ($getarticlebanner["url"] == "/")?"/":$getcountrybanner["url"];
        $getbanner["src"] = ($getarticlebanner["src"] == "banner.jpg")?"banner.jpg":$getcountrybanner["src"];
    }

    return $getbanner;
}
function GetID(){
    switch ($_REQUEST["view"]){
        case "cantry":
            $countryID = $_REQUEST["id"];
            $regionID = null;
            break;
        case "region":
            $countryID = $_REQUEST["cantry"];
            $regionID = $_REQUEST["id"];;
            break;
        default:
            $countryID = null;
            $regionID = null;
    }
    return array("countryID" => $countryID, "regionID" => $regionID);
}
function GetArticleBanner($db, $banner_type){
    $query = "SELECT * FROM 0y13_ray_banner  WHERE page ='" . urldecode($_SERVER['REQUEST_URI']) . "' and position='". $banner_type ."' and data > '" . date("Y-m-d") . "'  ORDER BY RAND()  limit 1; ";
    $db->setQuery($query);

    if ($row = $db->loadObject()) {
        $getbanner["url"] = $row->url;
        $getbanner["src"] = $row->object;
    }
    return $getbanner;
}
function GetCountryBanner($db, $banner_type, $ids){
    //Проверяем наличие ссылки на баннер в разделе "страны"
    $query = "SELECT * FROM d0y13_ray_cantry  WHERE id ='" . $ids["countryID"] . "' ";
    $db->setQuery($query);
    $row = $db->loadObject();
//        if (isset($row->banner1)) {
    if (!empty($row)) {
        switch($banner_type){
            case 0:
                $getbanner["url"] = !empty($row->url1) ? $row->url1 : "/";
                $getbanner["src"] = !empty($row->banner1) ? $row->banner1 : "banner.jpg";
                break;
            case 1:
                $getbanner["url"] = !empty($row->url2) ? $row->url2 : "/";
                $getbanner["src"] = !empty($row->banner2) ? $row->banner2 : "banner.jpg";
                break;
            case 2:
                $getbanner["url"] = !empty($row->url3) ? $row->url3 : "/";
                $getbanner["src"] = !empty($row->banner3) ? $row->banner3 : "banner.jpg";
                break;
            case 3:
                $getbanner["url"] = !empty($row->url4) ? $row->url4 : "/";
                $getbanner["src"] = !empty($row->banner4) ? $row->banner4 : "banner.jpg";
                break;
        }
    }
    return $getbanner;
}
function GetRegionBanner($db, $banner_type, $ids){
    $query = "SELECT * FROM 0y13_ray_region  WHERE id ='" . $ids["countryID"] . "' ";
    $db->setQuery($query);
    $row = $db->loadObject();
//        if (isset($row->banner1)) {
    if (!empty($row)) {
        switch($banner_type){
            case 0:
                $getbanner["url"] = !empty($row->url1) ? $row->url1 : "/";
                $getbanner["src"] = !empty($row->banner1) ? $row->banner1 : "banner.jpg";
                break;
            case 1:
                $getbanner["url"] = !empty($row->url2) ? $row->url2 : "/";
                $getbanner["src"] = !empty($row->banner2) ? $row->banner2 : "banner.jpg";
                break;
            case 2:
                $getbanner["url"] = !empty($row->url3) ? $row->url3 : "/";
                $getbanner["src"] = !empty($row->banner3) ? $row->banner3 : "banner.jpg";
                break;
            case 3:
                $getbanner["url"] = !empty($row->url4) ? $row->url4 : "/";
                $getbanner["src"] = !empty($row->banner4) ? $row->banner4 : "banner.jpg";
                break;
        }

    }
}
