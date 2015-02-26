<?php
/**
 * Created by PhpStorm.
 * User: xuzhaoyu
 * Date: 2/26/15
 * Time: 1:39 PM
 */
class WebsiteController extends \BaseController {

    public function getIndex()
    {
        return View::make('hello');
    }

}