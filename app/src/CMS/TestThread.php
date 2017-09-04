<?php
/**
 * Created by PhpStorm.
 * User: Sebastian Śliwiński
 * Date: 28.08.2017
 * Time: 14:16
 */

namespace CMS;


class TestThread extends \Thread
{

    private $response;

    public function __construct()
    {
        die('aaa');
    }
}