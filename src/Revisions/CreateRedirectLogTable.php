<?php

namespace Tnt\Redirects\Revisions;

use Oak\Contracts\Migration\RevisionInterface;
use Tnt\Dbi\TableBuilder;

class CreateRedirectLogTable extends DatabaseRevision implements RevisionInterface
{
    /**
     * Create redirects_redirect_log table
     */
    public function up()
    {
        $this->queryBuilder->table('redirects_redirect_log')->create(function(TableBuilder $table) {

            $table->addColumn('id', 'int')->length(11)->primaryKey();
            $table->addColumn('created', 'int')->length(11);
            $table->addColumn('updated', 'int')->length(11);
            $table->addColumn('source_path', 'varchar')->length(255);
            $table->addColumn('target_path', 'varchar')->length(255);
            $table->addColumn('status_code', 'int')->length(11);

            $table->addColumn('redirect', 'int')->length(11);
            $table->addForeignKey('redirect', 'redirects_redirect');

        });

        $this->execute();
    }

    /**
     * Drop redirects_redirect_log table
     */
    public function down()
    {
        $this->queryBuilder->table('redirects_redirect_log')->drop();

        $this->execute();
    }

    /**
     * @return string
     */
    public function describeUp(): string
    {
        return 'Create redirects_redirect_log table';
    }

    /**
     * @return string
     */
    public function describeDown(): string
    {
        return 'Drop redirects_redirect_log table';
    }
}