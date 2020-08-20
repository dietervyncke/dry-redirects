<?php

namespace Tnt\Redirects\Events;

use Oak\Dispatcher\Event;
use Tnt\Redirects\Model\Redirect;

class RouteWasHit extends Event
{
    /**
     * @var Redirect
     */
    private $redirect;

    /**
     * RouteWasHit constructor.
     * @param Redirect $redirect
     */
    public function __construct(Redirect $redirect)
    {
        $this->redirect = $redirect;
    }

    /**
     * @return Redirect
     */
    public function getRedirect(): Redirect
    {
        return $this->redirect;
    }
}