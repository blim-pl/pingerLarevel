<?php
/**
 * Created by PhpStorm.
 * User: Sebastian Śliwiński
 * Date: 03.08.2017
 * Time: 10:45
 */

namespace CMS\Observer;

use CMS\Observer\Contracts\IObserver;
use CMS\Observer\Contracts\IObserverSubject;

trait SubjectTrait
{
    protected $obeservers = [];

    /**
     * @param IObserver $observer
     *
     * @return IObserverSubject
     */
    public function attach(IObserver $observer): IObserverSubject
    {
        $this->obeservers[spl_object_hash($observer)] = $observer;

        return $this;
    }

    /**
     * @param IObserver $observer
     *
     * @return IObserverSubject
     */
    public function detach(IObserver $observer): IObserverSubject
    {
        $key = spl_object_hash($observer);

        if (isset($this->obeservers[$key])) {
            unset($this->obeservers[$key]);
        }

        return $this;
    }

    /**
     * @return IObserverSubject
     */
    public function notify(): IObserverSubject
    {
        foreach ($this->obeservers as $obeserver) {
            $obeserver->update($this);
        }

        return $this;
    }
}