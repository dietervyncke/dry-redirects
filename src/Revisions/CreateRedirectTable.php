<?php

namespace Tnt\Redirects\Revisions;

use Oak\Contracts\Migration\RevisionInterface;
use Tnt\Dbi\TableBuilder;

class CreateRedirectTable extends DatabaseRevision implements RevisionInterface
{
    /**
     * Create redirects_redirect table
     */
    public function up()
    {
        $this->queryBuilder->table('redirects_redirect')->create(function(TableBuilder $table) {

            $table->addColumn('id', 'int')->length(11)->primaryKey();
            $table->addColumn('created', 'int')->length(11);
            $table->addColumn('updated', 'int')->length(11);
            $table->addColumn('source_path', 'varchar')->length(255);
            $table->addColumn('target_path', 'varchar')->length(255);
            $table->addColumn('status_code', 'int')->length(11);
            $table->addColumn('hit_count', 'int')->length(11);
            $table->addColumn('is_active', 'tinyint')->length(1);

        });

        $this->execute();
    }

    /**
     * Drop redirects_redirect table
     */
    public function down()
    {
        $this->queryBuilder->table('redirects_redirect')->drop();

        $this->execute();
    }

    /**
     * @return string
     */
    public function describeUp(): string
    {
        return 'Create redirects_redirect table';
    }

    /**
     * @return string
     */
    public function describeDown(): string
    {
        return 'Drop redirects_redirect table';
    }
}