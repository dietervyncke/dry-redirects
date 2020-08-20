<?php

namespace Tnt\Redirects\Model;

use dry\db\ResultSet;
use dry\orm\Model;
use dry\orm\relationship\HasMany;
use dry\orm\special\Boolean;

class Redirect extends Model
{
    const STATUS_CODE_301 = 301;
    const STATUS_CODE_302 = 302;
    const STATUS_CODE_404 = 404;

    const TABLE = 'redirects_redirect';

    /**
     * @var array
     */
    public static $special_fields = [
      'is_active' => Boolean::class,
    ];

    /**
     * @return int
     */
    public function get_hits_count()
    {
        return count($this->getLogs());
    }

    /**
     * @return array
     */
    public static function getEnumStatusCode()
    {
        return [
          [self::STATUS_CODE_301, '301'],
          [self::STATUS_CODE_302, '302'],
          [self::STATUS_CODE_404, '404'],
        ];
    }

    /**
     * @return ResultSet
     */
    public static function getActiveRedirects(): ResultSet
    {
        return self::all('WHERE is_active IS TRUE');
    }

    /**
     * @return HasMany
     */
    public function getLogs(): HasMany
    {
        return $this->has_many(RedirectLog::class, 'redirect');
    }

    /**
     *
     */
    public function delete()
    {
        foreach ($this->getLogs() as $log) {
            $log->delete();
        }

        parent::delete();
    }
}