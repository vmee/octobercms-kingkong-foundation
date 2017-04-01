# Foundation plugin

### 点赞功能说明

基于model行为绑定实现的点赞功能, 通过用户id,做到过滤重复点赞

#### 第一步 点击model behaviors 绑定

在要使用点赞功能的model里添加

    public $implement = ['Kingkong\Foundation\Behaviors\LikeModel'];


#### 第二步 设置model点赞对应的计数统计字段

默认是like, 若是model不作点赞统计,这里可以设置成false

    public $likeAttribute = 'like';

#### 第三方调用点赞计数方法

分点赞加1计数方法 incrementLike 或 点赞减1计数方法 decrementLike

    $model->incrementLike();
    $model->decrementLike();
    $model->incrementLike($userId)

不传$userId 默认会取当前登陆用户id

### 通用缩略图链接获取

    app('thumb')->url($file)
    app('thumb')->url($user->avatar)

### 中国行政区域划分

    参考Kingkong\Foundation\Classes\Region 方法

### 图片合并

设置背景图

    Kingkong\Foundation\Classes\MergeImage::setGroundImageResource($groundImgPath);

合并图片

    $res = Kingkong\Foundation\Classes\MergeImage::merge(
                        [
                            [
                                'path' =>  $qrCodeImgFilepath,
                                'dst_x' => 242,
                                'dst_y' => 1060,
                            ],
                            [
                                'path' =>  $headImgFilepath,
                                'dst_x' => 130,
                                'dst_y' => 250,
                            ],
                            [
                                'path' =>  base_path($this->getAssetPath('assets/images/WechatIMG6-bord.jpg')),
                                'dst_x' => 130,
                                'dst_y' => 250,
                            ],
                        ], '', true
                    );

添加文字

    Kingkong\Foundation\Classes\MergeImage::string(
                        [
                            [
                                'string' =>  $wxUser->nickname,
                                'x' => 280,
                                'y' => 344,
                                'size' => 24,
                                'color_red' => 255,
                                'color_green' => 255,
                                'color_blue' => 255,
                            ]
                        ]
                    );


获取合并后的资源对象

    $imageResource = Kingkong\Foundation\Classes\MergeImage::getGroundImageResource();

你可以存在本地

    Storage::makeDirectory($inviteImgDir);
    imagejpeg($imageResource, $inviteImgPath);

你也可以直接输出

     header("Content-type: image/jpeg");
     imagejpeg($imageResource);

正常情况下不建议,直接输出,因为访问会比较慢