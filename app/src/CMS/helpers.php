<?php
/**
 * Created by PhpStorm.
 * User: Sebastian Śliwiński
 * Date: 18.08.2017
 * Time: 11:06
 */

function flashMessage($content, $type = 'success') {
    session()->flash('message' , ['content' => $content, 'type' => $type]);
}