<?php
/**
 * Created by PhpStorm.
 * User: kingkong
 * Date: 2016/11/7
 * Time: 下午5:43
 */

namespace Kingkong\Foundation\Classes;

use Config;

class Region
{
    const GRADE_PROVINCE = 1;
    const GRADE_CITY = 2;
    const GRADE_AREA = 3;

    protected static $regionGrades = [
        self::GRADE_PROVINCE => '省',
        self::GRADE_CITY => '市',
        self::GRADE_AREA => '区县',
    ];

    protected static $regionCollection = null;

    public static $countryArr = [
        '美国','澳大利亚','英国','韩国','日本','加拿大','新加坡','新西兰','法国','香港','澳门','台湾','中国大陆','阿尔及利亚','阿富汗','阿根廷','阿拉伯联合酋长国','阿曼','阿塞拜疆','阿尔巴尼亚','埃及','埃塞俄比亚','爱尔兰','爱沙尼亚','安道尔共和国','安哥拉','安圭拉岛','安提瓜和巴布达','奥地利','巴巴多斯','巴布亚新几内亚','巴哈马','巴基斯坦','巴拉圭','巴林','巴拿马','巴西','白俄罗斯','保加利亚','贝宁','比利时','冰岛','波多黎各','波兰','玻利维亚','伯利兹','博茨瓦纳','布基纳法索','布隆迪','朝鲜','丹麦','德国','多哥','多米尼加共和国','俄罗斯','厄瓜多尔','法属玻利尼西亚','菲律宾','斐济','芬兰','冈比亚','刚果','哥伦比亚','哥斯达黎加','格林纳达','格鲁吉亚','古巴','关岛','圭亚那','哈萨克斯坦','海地','荷兰','荷属安的列斯','洪都拉斯','吉布提','吉尔吉斯坦','几内亚','加纳','加蓬','柬埔寨','捷克','津巴布韦','喀麦隆','卡塔尔','开曼群岛','科特迪瓦','科威特','肯尼亚','库克群岛','拉脱维亚','莱索托','老挝','黎巴嫩','立陶宛','利比里亚','利比亚','列支敦士登','留尼旺','卢森堡','罗马尼亚','马达加斯加','马尔代夫','马耳他','马拉维','马来西亚','马里','马里亚那群岛','马提尼克','毛里求斯','蒙古','蒙特塞拉特岛','孟加拉国','秘鲁','缅甸','摩尔多瓦','摩洛哥','摩纳哥','莫桑比克','墨西哥','纳米比亚','南非','南斯拉夫','瑙鲁','尼泊尔','尼加拉瓜','尼日尔','尼日利亚','挪威','葡萄牙','瑞典','瑞士','萨尔瓦多','塞拉利昂','塞内加尔','塞浦路斯','塞舌尔','沙特阿拉伯','圣多美和普林西比','圣卢西亚','圣马力诺','圣文森特','斯里兰卡','斯洛伐克','斯洛文尼亚','斯威士兰','苏丹','苏里南','所罗门群岛','索马里','塔吉克斯坦','泰国','坦桑尼亚','汤加','特立尼达和多巴哥','突尼斯','土耳其','土库曼斯坦','危地马拉','委内瑞拉','文莱','乌干达','乌克兰','乌拉圭','乌兹别克斯坦','西班牙','西萨摩亚','希腊','匈牙利','叙利亚','牙买加','亚美尼亚','也门','伊拉克','伊朗','以色列','意大利','印度','印度尼西亚','约旦','越南','赞比亚','扎伊尔','乍得','直布罗陀','智利','中非共和国',    ];

    public static function getProvinces()
    {
        return self::getRegionCollection()->where('grade', self::GRADE_PROVINCE );
    }

    public static function getCountry()
    {
        return self::$countryArr;
    }


    public static function getCities($provinceId)
    {
        return self::getRegionCollection()->where('grade', self::GRADE_CITY )->where('province_id', $provinceId);
    }

    public static function getAreas($cityId)
    {
        return self::getRegionCollection()->where('grade', self::GRADE_AREA )->where('city_id', $cityId);
    }


    public static function getProvinceByCity($city)
    {
        foreach(self::$cityArr as $key => $cities){
            if(in_array($city, $cities)){
                return $key;
            }
        }
        return false;
    }

    public static function getRegionCollection()
    {
        if(!self::$regionCollection){
            self::$regionCollection = Config::get('kingkong.foundation::region');
        }
        return self::$regionCollection;
    }

    public static function getOne($id)
    {
        return self::getRegionCollection()->where('id', $id);
    }
    
}

