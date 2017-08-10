<?php
/**
 * Created by PhpStorm.
 * User: Sebastian Śliwiński
 * Date: 03.08.2017
 * Time: 10:39
 */

namespace CMS\Observer\Contracts;

interface IObserverSubject
{
    public function attach(IObserver $observer): IObserverSubject;

    public function detach(IObserver $observer): IObserverSubject;

    public function notify(): IObserverSubject;
}