<?php
/**
 * Created by PhpStorm.
 * User: Николай
 * Date: 25.06.14
 * Time: 21:45
 */

defined('_JEXEC') or die('Restricted access');

define('DEFAULT_URL', $_SERVER["REQUEST_URI"]);

function GetBanner($db, $banner_type){
    $getbanner = array(
        "url" => DEFAULT_URL,
        "src" => "banner.jpg"
    );
    $ids = GetID();

    if (IsMainPage()){
        $getbanner = ArticleBanner($db, $banner_type, $getbanner);
    }elseif (IsCountryPage()){
        $getbanner = CountryBanner($db, $banner_type, $ids, $getbanner);
        $getarticlebanner = ArticleBanner($db, $banner_type, $getbanner);

        $getbanner["url"] = ($getarticlebanner["url"] == DEFAULT_URL) ? $getbanner["url"] : $getarticlebanner["url"];
        $getbanner["src"] = ($getarticlebanner["src"] == "banner.jpg") ? $getbanner["src"] : $getarticlebanner["src"];
    }else{
        $getcountrybanner = CountryBanner($db, $banner_type, $ids, $getbanner);
        $getbanner = RegionBanner($db, $banner_type, $ids, $getbanner);
        $getarticlebanner = ArticleBanner($db, $banner_type, $getbanner);

        $getbanner["url"] = ($getarticlebanner["url"] == DEFAULT_URL) ? $getbanner["url"] : $getcountrybanner["url"];
        $getbanner["src"] = ($getarticlebanner["src"] == "banner.jpg") ? $getbanner["src"] : $getcountrybanner["src"];
        $getbanner["url"] = ($getarticlebanner["url"] == DEFAULT_URL) ? $getbanner["url"] : $getarticlebanner["url"];
        $getbanner["src"] = ($getarticlebanner["src"] == "banner.jpg") ? $getbanner["src"] : $getarticlebanner["src"];

        $getbanner["url"] = ($getbanner["url"] == DEFAULT_URL) ? $getcountrybanner["url"] : $getbanner["url"];
        $getbanner["src"] = ($getbanner["src"] == "banner.jpg") ? $getcountrybanner["src"] : $getbanner["src"];


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
        case "naspunkt":
            $countryID = $_REQUEST["cantry"];
            $regionID = $_REQUEST["region"];;
            break;
        case "servis":
            $countryID = $_REQUEST["cantry"];
            $regionID = $_REQUEST["region"];;
            break;
        case "item":
            $countryID = $_REQUEST["cantry"];
            $regionID = $_REQUEST["region"];;
            break;
        default:
            $countryID = null;
            $regionID = null;
    }
    return array("countryID" => $countryID, "regionID" => $regionID);
}

function IsMainPage(){
    return ($_REQUEST["view"] == "article") ? true : false;
}
function IsCountryPage(){
    return ($_REQUEST["view"] == "cantry") ? true : false;
}
function IsRegionPage(){
    return ($_REQUEST["view"] == "region") ? true : false;
}


function ArticleBanner($db, $banner_type, $getbanner){
    $query = "SELECT * FROM 0y13_ray_banner  WHERE page ='" . urldecode($_SERVER['REQUEST_URI']) . "' and position='". $banner_type ."' and data > '" . date("Y-m-d") . "'  ORDER BY RAND()  limit 1; ";
    $db->setQuery($query);

    if ($row = $db->loadObject()) {
//        $getbanner["url"] = $row->url;
//        $getbanner["src"] = $row->object;
        $getbanner["url"] = !empty($row->url) ? $row->url : DEFAULT_URL;
        $getbanner["src"] = !empty($row->object) ? $row->object : "banner.jpg";
    }
    return $getbanner;
}
function CountryBanner($db, $banner_type, $ids, $getbanner){
    //Проверяем наличие ссылки на баннер в разделе "страны"
    $query = "SELECT * FROM d0y13_ray_cantry  WHERE id ='" . $ids["countryID"] . "' ";
    $db->setQuery($query);
    $row = $db->loadObject();
//        if (isset($row->banner1)) {
    if (!empty($row)) {
        switch($banner_type){
            case 0:
                $getbanner["url"] = !empty($row->url1) ? $row->url1 : DEFAULT_URL;
                $getbanner["src"] = !empty($row->banner1) ? $row->banner1 : "banner.jpg";
                break;
            case 1:
                $getbanner["url"] = !empty($row->url2) ? $row->url2 : DEFAULT_URL;
                $getbanner["src"] = !empty($row->banner2) ? $row->banner2 : "banner.jpg";
                break;
            case 2:
                $getbanner["url"] = !empty($row->url3) ? $row->url3 : DEFAULT_URL;
                $getbanner["src"] = !empty($row->banner3) ? $row->banner3 : "banner.jpg";
                break;
            case 3:
                $getbanner["url"] = !empty($row->url4) ? $row->url4 : DEFAULT_URL;
                $getbanner["src"] = !empty($row->banner4) ? $row->banner4 : "banner.jpg";
                break;
        }
    }
    return $getbanner;
}
function RegionBanner($db, $banner_type, $ids, $getbanner){
    $query = "SELECT * FROM 0y13_ray_region  WHERE cantry ='" . $ids["countryID"] . "' and id='" . $ids["regionID"] . "'";
    $db->setQuery($query);
    $row = $db->loadObject();
//        if (isset($row->banner1)) {
    if (!empty($row)) {
        switch($banner_type){
            case 0:
                $getbanner["url"] = !empty($row->url1) ? $row->url1 : DEFAULT_URL;
                $getbanner["src"] = !empty($row->banner1) ? $row->banner1 : "banner.jpg";
                break;
            case 1:
                $getbanner["url"] = !empty($row->url2) ? $row->url2 : DEFAULT_URL;
                $getbanner["src"] = !empty($row->banner2) ? $row->banner2 : "banner.jpg";
                break;
            case 2:
                $getbanner["url"] = !empty($row->url3) ? $row->url3 : DEFAULT_URL;
                $getbanner["src"] = !empty($row->banner3) ? $row->banner3 : "banner.jpg";
                break;
            case 3:
                $getbanner["url"] = !empty($row->url4) ? $row->url4 : DEFAULT_URL;
                $getbanner["src"] = !empty($row->banner4) ? $row->banner4 : "banner.jpg";
                break;
        }
    }
    return $getbanner;
}
