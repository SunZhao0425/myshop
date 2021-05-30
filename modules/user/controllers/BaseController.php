<?php

namespace app\modules\user\controllers;

use yii\web\Controller;

class BaseController extends Controller
{
    /**
     * 统一返回
     * @param array $data
     * @param int $code
     * @param string $message
     * @param string $version
     * @return mixed
     * @author zhaohongyan@zhibo.tv
     * @date 2021/4/11
     * @time 17:05
     */
    protected function apiResponse($data=[],$code = 200,$message ='success' ,$version = '5.0.0')
    {
        $data = [
            'control' =>[
                'version'=>$version, // 版本号
                'time' => time(),
                'status' => $code,
                'message' => $message,
            ],
            'data'=>$data,
        ];
        $response         = \Yii::$app->getResponse();
        $response->format = \yii\web\Response::FORMAT_JSON;
        $response->data   = $data;
        return $response;
    }
}
