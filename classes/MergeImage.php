<?php
/**
 * Created by PhpStorm.
 * User: kingkong
 * Date: 2017/2/13
 * Time: 下午3:23
 */

namespace Kingkong\Foundation\Classes;


class MergeImage
{
    public static $groupImageResource = null;
    public static $imageResources = [];
    public static $imageInfos = [];

    public static function setGroundImageResource($imagePath)
    {
        return self::$groupImageResource = self::getImageResource($imagePath);
    }

    public static function getGroundImageResource($imagePath = '')
    {
        if($imagePath){
            self::setGroundImage($imagePath);
        }
        return self::$groupImageResource;
    }

    public static function getImageResource($imagePath)
    {
        if(is_resource($imagePath)){
            return $imagePath;
        }else{
            if(empty(self::$imageResources[$imagePath]) || !is_resource(self::$imageResources[$imagePath])){
                $imageInfo = self::getImageInfo($imagePath);
                $imageResource = null;
                switch($imageInfo[2]){
                    case 1:
                        $imageResource= imagecreatefromgif($imagePath);
                        break;
                    case 2:
                        $imageResource = imagecreatefromjpeg($imagePath);
                        break;
                    case 3:
                        $imageResource = imagecreatefrompng($imagePath);
                        break;
                }

                self::$imageResources[$imagePath] = $imageResource;
            }
        }

        return self::$imageResources[$imagePath];
    }

    public static function getImageInfo($imagePath)
    {
        if(empty(self::$imageInfos[$imagePath])){
            self::$imageInfos[$imagePath] = getimagesize($imagePath);
        }
        return self::$imageInfos[$imagePath];
    }
    
    
    /**
     * 合并生成图片
     * @param $groudImgPath
     * @param array $mergeImgs
     *  [
     *      [
     *       'path' => '',
     *      'dst_x' => '',
     *      'dst_y' => '',
     *      'src_x' => '',
     *      'src_y' => '',
     *      ]
     * ]
     */
    public static function merge($mergeImages = [], $groundImagePath = '', $full = false)
    {
        $groundImageResource = null;
        if($groundImagePath){
            $groundImageResource = self::getImageResource($groundImagePath);
        }else{
            $groundImageResource = self::getGroundImageResource();
        }

        if(empty($mergeImages)){
            return $groundImageResource;
        }

        foreach($mergeImages as $image){

            if(empty($image['path'])){
                if($full){
                    return null;
                }else{
                    continue;
                }

            }

            $imageResource = self::getImageResource($image['path']);
            if(!is_resource($imageResource)){
                if($full){
                    return null;
                }else{
                    continue;
                }
            }

            $imageInfo = self::getImageInfo($image['path']);
            $image['dst_x'] = isset($image['dst_x']) ? intval($image['dst_x']) : 0;
            $image['dst_y'] = isset($image['dst_y']) ? intval($image['dst_y']) : 0;
            $image['src_x'] = isset($image['src_x']) ? intval($image['src_x']) : 0;
            $image['src_y'] = isset($image['src_y']) ? intval($image['src_y']) : 0;

            imagecopy($groundImageResource,$imageResource,
                $image['dst_x'],$image['dst_y'], $image['src_x'],
                $image['src_y'],$imageInfo[0],$imageInfo[1]);
        }

        return $groundImageResource;
        
    }

    /**
     * @param array $strings
     *  [
     *      [
     *          'font' => '',
     *          'x' => '',
     *          'y' => '',
     *          'string' => '',
     *          'color_red' => '',
     *          'color_green' => '',
     *          'color_blue' => '',
     *      ]
     * ]
     * @param string $groundImagePath
     * @return mixed|null
     */
    public static function string($strings=[], $groundImagePath = '')
    {
        $groundImageResource = null;
        if($groundImagePath){
            $groundImageResource = self::getImageResource($groundImagePath);
        }else{
            $groundImageResource = self::getGroundImageResource();
        }

        if(empty($strings)){
            return $groundImageResource;
        }

        foreach ($strings as $str){
            if(empty($str['string'])) continue;

            $str['color_red'] = isset($str['color_red']) ? intval($str['color_red']) : 0;
            $str['color_green'] = isset($str['color_green']) ? intval($str['color_green']) : 0;
            $str['color_blue'] = isset($str['color_blue']) ? intval($str['color_blue']) : 0;

            $textcolor = imagecolorallocate($groundImageResource, $str['color_red'], $str['color_green'], $str['color_blue']);

            $str['size'] = isset($str['size']) ? intval($str['size']) : 14;
            $str['x'] = isset($str['x']) ? intval($str['x']) : 3;
            $str['y'] = isset($str['y']) ? intval($str['y']) : 3;
            $str['angle'] = isset($str['angle']) ? intval($str['angle']) : 0;

            $fontfile = plugins_path().'/kingkong/foundation/fonts/STHeiti Medium.ttc';
            if(!is_file($fontfile)){
                $fontfile = '/usr/share/fonts/wqy-zenhei/wqy-zenhei.ttc';
            }

            imagettftext($groundImageResource, $str['size'],$str['angle'], $str['x'], $str['y'], $textcolor, $fontfile, $str['string']);
        }

        return $groundImageResource;
        
    }

}