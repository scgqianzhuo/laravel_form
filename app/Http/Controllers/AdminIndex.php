<?php
/**
 * Created by PhpStorm.
 * User: qianzhuo
 * Date: 2018/11/11
 * Time: 15:35
 */

namespace App\Http\Controllers;


class AdminIndex
{

    public function init()
    {
        return view('common.init');
    }


    public function index()
    {
    	return view('common.index');
    }

}