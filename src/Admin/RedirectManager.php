<?php

namespace Tnt\Redirects\Admin;

use dry\admin\component\BooleanEdit;
use dry\admin\component\EnumEdit;
use dry\admin\component\EnumView;
use dry\admin\component\Stack;
use dry\admin\component\StringEdit;
use dry\admin\component\StringView;
use dry\admin\Module;
use dry\orm\action\Create;
use dry\orm\action\Delete;
use dry\orm\action\Edit;
use dry\orm\component\Pagination;
use dry\orm\Index;
use dry\orm\Manager;
use dry\orm\paginate\Paginator;
use Tnt\Redirects\Model\Redirect;

class RedirectManager extends Manager
{
    public function __construct()
    {
        parent::__construct(Redirect::class, [
            'icon' => Module::ICON_ASSIGNMENT,
            'plural' => 'redirects',
        ]);

        $this->actions[] = $create = new Create([
            new Stack(Stack::HORIZONTAL, [
                new StringEdit('source_path', [
                    'v8n_required',
                ]),
                new EnumEdit('status_code', Redirect::getEnumStatusCode()),
            ], [
                'grid' => [3,1]
            ]),
            new StringEdit('target_path', [
                'v8n_required',
            ]),
            new BooleanEdit('is_active'),
        ], [
            'mode' => Create::MODE_POPUP,
        ]);

        $this->actions[] = $edit = new Edit($create->components, [
            'mode' => Create::MODE_POPUP,
        ]);

        $this->actions[] = $delete = new Delete();

        $this->header[] = $create->create_link('Add redirect');

        $this->footer[] = new Pagination();

        $this->index = new Index([
            new StringView('source_path'),
            new EnumView('status_code', Redirect::getEnumStatusCode()),
            new StringView('target_path'),
            new StringView('hits_count'),
            $edit->create_link(),
            $delete->create_link(),
        ], [
            'field_to_row_class' => [
                'is_active', NULL, \dry\orm\IndexRow::STYLE_DISABLED,
            ],
        ] );

        $this->index->paginator = new Paginator(10);
    }
}