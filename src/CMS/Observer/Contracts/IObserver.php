<?php
/**
 * Created by PhpStorm.
 * User: Sebastian Śliwiński
 * Date: 03.08.2017
 * Time: 10:39
 */

namespace CMS\Observer\Contracts;


interface IObserver
{
    public function update(IObserverSubject $subject);
}