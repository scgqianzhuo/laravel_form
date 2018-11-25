<?php
/**
 * Created by PhpStorm.
 * User: qianzhuo
 * Date: 2018/11/11
 * Time: 17:03
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{

	const SEX_UN = 0;//未知
    const SEX_BOY = 1;//男
    const SEX_GIRL = 2;//女
    const STATUS_START = 1;//用户启用
    const STATUS_STOP = 0;//用户注销
    /**
     * 关联到模型的数据表
     *
     * @var string
     */
    protected $table = 'student';

    //自动维护时间戳 false 不会
	public $timestamps = true;

    //将格式化时间转为时间戳存储

    protected function getDateFormat()
    {
        return time();  
    }
    //去除格式化显示
    protected function asDateTime($val) 
    {
        return $val;
    }

    public function dateForm($ind =null)
    {
        if (!empty($ind)) {
            return date('Y-m-d H:i',$ind);
        }
        return $ind;
    }
    protected $guarded = [];

	    /**
     * 处理用户的性别，转换为中文
     *
     * @param     $ind    用户存储的性别数字编号
     * @return    string  对应的性别中文字符
     * @author    webjust [604854119@qq.com]
     */
    public function sex($ind = null)
    {
        $arr = array(
            self::SEX_GIRL => '女',
            self::SEX_BOY => '男',
            self::SEX_UN => '未知',
        );

 
        if($ind !== null)
        {
            return array_key_exists($ind, $arr) ? $arr[$ind] : $arr[self::SEX_UN];
        }
        return $arr;
    }


    /**
    *处理用户状态 1 启用 0 注销
    */
    public  function status($ind = null)
    {
        $arr = array(
            self::STATUS_START =>['status'=>'已启用','style'=>'success'],
            self::STATUS_STOP =>['status'=>'已注销','style'=>'error']
        );
        if($ind !== null)
        {
            return array_key_exists($ind, $arr) ? $arr[$ind] : $arr[self::STATUS_START];
        }
        return $arr;
    }


}