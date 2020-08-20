<?php

namespace Tnt\Redirects\Revisions;

use dry\db\Connection;
use Tnt\Dbi\QueryBuilder;

/**
 * Class DatabaseRevision
 * @package Tnt\Ecommerce
 */
abstract class DatabaseRevision
{
    /**
     * @var QueryBuilder $queryBuilder
     */
    protected $queryBuilder;

    /**
     * DatabaseRevision constructor.
     * @param QueryBuilder $queryBuilder
     */
    public function __construct(QueryBuilder $queryBuilder)
    {
        $this->queryBuilder = $queryBuilder;
    }

    protected function execute()
    {
        $this->queryBuilder->build();
        Connection::get()->query($this->queryBuilder->getQuery());
    }
}