<?php

namespace Tnt\Redirects\Model;

use dry\orm\Model;

class RedirectLog extends Model
{
    const TABLE = 'redirects_redirect_log';

    public static $special_fields = [
      'redirect' => Redirect::class,
    ];
}