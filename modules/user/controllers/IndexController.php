<?php

namespace app\modules\user\controllers;

use GuzzleHttp\Psr7\AppendStream;
use yii\base\Module;
use yii\web\Controller;

/**
 * Default controller for the `user` module
 */
class IndexController extends BaseController
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionList()
    {

        return $this->apiResponse([]);
    }

    public function actionAdd()
    {

        $num = [34,5,43,2,2,3,4,5,5,3,4,4,55,555,44,1];
//        if (count($num) < 2){
//            return $num;
//        }
//        //冒泡排序 时间复杂度o(N^2), 空间复杂度O(1) 稳定排序
//        for($i= 0; $i < count($num) - 1 ; $i++){
//            for ($j = 0; $j < count($num) - $i -1; $j++){
//                // 如果前面的元素 大于后面的元素, 将大的元素放后面
//                if($num[$j] > $num[$j+ 1]){
//                    $temp = $num[$j];
//                    $num[$j] = $num[$j+1];
//                    $num[$j+1] = $temp;
//                    break;
//                }
//            }
//        }

        // 选择排序 时间复杂度o(N^2), 空间复杂度O(1) 不稳定排序
//        $len = count($num);
//        for($i = 0 ; $i < $len-1; $i++){
//            $min = $i;
//            for ($j = $i + 1; $j < $len; $j++){
//                if($num[$j] < $num[$min]){
//                    $min = $j;
//                }
//                $temp = $num[$i];
//                $num[$i] = $num[$min];
//                $num[$min] = $temp;
//            }
//        }
        // 插入排序 时间复杂度o(N^2), 空间复杂度O(1) 稳定排序
//        $len = count($num);
//        for ($i = 1 ; $i < $len ; $i++){
//            $preIndex = $i - 1 ;
//            $current = $num[$i];
//            while($preIndex >= 0 && $num[$preIndex] > $current){
//                $num[$preIndex+1] = $num[$preIndex];
//                $preIndex--;
//            }
//            $num[$preIndex+1] = $current;
//        }

        // 希尔排序            不稳定排序
//            $len = count($num);
//            $gap = 1;
//            $spit = 3; // 段数参数
//            while ($gap < $len/$spit){
//                $gap = $gap * $spit + 1;
//            }
//            for ($gap; $gap > 0 ; $gap = floor($gap/$spit)){
//                for ($i = $gap; $i < $len ; $i++){
//                    $temp = $num[$i];
//                    for ($j = $i-$gap; $j >= 0 && $num[$j] > $temp; $j-=$gap){
//                        $num[$j + $gap] = $num[$j];
//                    }
//                    $num[$j+$gap] = $temp;
//                }
//            }

            // 归并算法 时间复杂度: O(nlogn)   空间复杂度: O(n)  稳定排序
//            $num = $this->mergeSort($num);

           // 快速排序 时间复杂度: O(nlog(n))   空间复杂度: O(n)  不稳定排序
            $num = $this->quickSort($num);

            // 堆排序
        echo '<pre>';
            $num = $this->heapSort($num);
            print_r($num);die;
    }

    public function actionUpdate()
    {
        // 修改
    }

    public function actionDelete()
    {
        // 删除
    }

    /**
     * 堆排序
     * @param $arr
     */
    /**
     * 创建堆
     * @param $arr
     */
    public function  buildMaxHeap($arr){
        $len = count($arr);
        // 创建堆
        for ($i = floor($len/2); $i >= 0 ; $i--){
            $this->heapify($arr,$i);
        }

    }

    public function heapify($arr,$i){
        $len = count($arr);
        $left = 2 * $i + 1;
        $right = 2 * $i + 1;
        $largest = $i;
        if ($left < $len && $arr[$left] > $arr[$largest]){
            $largest = $left;
        }
        if($right < $len && $arr[$right] > $arr[$largest]){
            $largest = $right;
        }
        if($largest != $i){
            $this->swap($arr,$i,$largest);
            $this->heapify($arr,$largest);
        }
    }

    public function swap($arr,$i,$j){
        $temp = $arr[$i];
        $arr[$j] = $arr[$i];
        $arr[$i] = $temp;
    }

    function heapSort($arr){
        $len = count($arr);
        $this->buildMaxHeap($arr);
//        print_r($arr);die;
//        for ($i = count($arr)-1; $i > 0 ;$i--){
//            $this->swap($arr,0,$i);
//            $len--;
//            $this->heapify($arr,0);
//        }
        return $arr;
    }

    // 快速排序
    public function quickSort($arr){
        if(count($arr)  < 2){
            return $arr;
        }
        $middle = $arr[0];
        $leftArr = [];
        $rightArr = [];
        for ($i = 1; $i < count($arr); $i++){
            if ($arr[$i] < $middle){
                $leftArr[] = $arr[$i];
            }else{
                $rightArr[] = $arr[$i];
            }
        }
        $leftArr = $this->quickSort($leftArr);
        $leftArr[] = $middle;
        $rightArr = $this->quickSort($rightArr);
        return array_merge($leftArr,$rightArr);
    }




    // 归并排序
    public  function mergeSort($arr)
    {
        $len = count($arr);
        if ($len < 2) {
            return $arr;
        }
        $middle = floor($len / 2);
        $left = array_slice($arr, 0, $middle);
        $right = array_slice($arr, $middle);
        return $this->merge($this->mergeSort($left), $this->mergeSort($right));
    }

    private function merge($left, $right){
        $result = [];
        while (count($left) > 0 && count($right) > 0){
            if($left[0] <= $right[0]){
                $result[] = array_shift($left); // 删除元素
            }else{
                $result[] = array_shift($right);
            }
        }

        while (count($left)){
            $result[] = array_shift($left);
        }
        while (count($right)){
            $result[] = array_shift($right);
        }
        return $result;
    }

}
