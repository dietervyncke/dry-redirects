<?php

namespace Tnt\Redirects\Admin;

use dry\admin\component\DateView;
use dry\admin\component\EnumView;
use dry\admin\component\StringView;
use dry\admin\Module;
use dry\orm\action\Delete;
use dry\orm\action\MultiDelete;
use dry\orm\component\Pagination;
use dry\orm\component\RowCheckbox;
use dry\orm\Index;
use dry\orm\Manager;
use dry\orm\paginate\Paginator;
use dry\orm\sort\StaticSorter;
use Tnt\Redirects\Model\Redirect;
use Tnt\Redirects\Model\RedirectLog;

class RedirectLogManager extends Manager
{
    public function __construct()
    {
        parent::__construct(RedirectLog::class, [
            'icon' => Module::ICON_STATS,
            'singular' => 'redirect log',
            'plural' => 'redirect logs',
        ]);

        $this->actions[] = $delete = new Delete();
        $this->actions[] = $multiDelete = new MultiDelete();

        $this->header[] = $multiDelete->create_link();

        $this->footer[] = new Pagination();

        $this->index = new Index([
            new RowCheckbox(),
            new DateView('created', [
                'format' => 'd/m/Y H:i:s'
            ]),
            new StringView('source_path'),
            new StringView('target_path'),
            new EnumView('status_code', Redirect::getEnumStatusCode()),
            $delete->create_link(),
        ] );

        $this->index->paginator = new Paginator(20);

        $this->index->sorter = new StaticSorter('created', StaticSorter::DESC);
    }
}