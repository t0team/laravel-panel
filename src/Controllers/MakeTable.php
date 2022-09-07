<?php

namespace LazySoft\LaravelPanel\Controllers;

use Illuminate\Support\Facades\View;
use LazySoft\LaravelPanel\Traits\MakerTrait;
use Illuminate\Pagination\LengthAwarePaginator;

class MakeTable
{
    use MakerTrait;

    private $panel;
    private array $headers;
    private array $rows = [];
    private array $data = [];
    private $paginate = false;

    public function __construct(array $headers, array $config)
    {
        $this->data['config'] = $config;
        $this->headers = $headers;
        $this->panel = View::make("panel::index");

        $this->fixSidebarItems();
        $this->fixUserInfo();

        return $this;
    }

    public function withPaginate(LengthAwarePaginator $paginate): MakeTable
    {
        $this->paginate = $paginate;

        $this->rows = [];
        $this->addRows($paginate->items());

        return $this;
    }

    public function addRows($rows): MakeTable
    {
        foreach ($rows as $row) {
            $this->addRow($row);
        }

        return $this;
    }

    public function addRow($row): MakeTable
    {
        if (!is_array($row)) {
            $row = $row->toArray();
        }

        if (isset($row[0]) && (is_array($row[0]) || is_object($row[0]))) {
            $this->addRows($row);
        } else {
            $this->rows[] = $row;
        }

        return $this;
    }

    private function beforeRender()
    {
        $this->data['view'] = view('panel::table', [
            'headers' => $this->headers,
            'rows' => $this->rows,
            'paginate' => $this->paginate ?? false,
        ]);
    }
}
