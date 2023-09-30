<?php

namespace T0team\LaravelPanel\Controllers\Makers;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Pagination\AbstractPaginator;
use Illuminate\Support\Collection;
use T0team\LaravelPanel\Controllers\Button;

class TableMaker extends Maker
{
    private Collection $headers;
    private Collection $rows;
    private ?Collection $actions = null;
    private string $primaryKey = 'id';
    private $paginate = null;

    public function make(array $headers): static
    {
        if (empty($headers)) throw new \Exception('Headers can not be empty');

        $this->headers = collect($headers);
        $this->rows = collect();

        return $this;
    }

    public function header(Arrayable|array|string $key, ?string $value = null): TableMaker
    {
        if (is_string($key)) {
            $key = [$key => $value];
        }

        $this->headers = $this->headers->merge($key);

        return $this;
    }

    public function row(AbstractPaginator|Arrayable|array $row, ?callable $map = null): TableMaker
    {
        if ($row instanceof AbstractPaginator) {
            $this->paginate = $row;
            $this->rows = collect();
            $row = $row->items();
        }

        $row = collect($row)->flatten()->when(!is_null($map), function (Collection $row) use ($map) {
            return $row->map($map);
        });

        $this->rows->push(...$row);

        return $this;
    }

    public function action(Button $button): TableMaker
    {
        if (is_null($this->actions)) $this->actions = collect();

        $this->actions->push($button->get());

        return $this;
    }

    /** Define the primary key of the table. Default is 'id'. */
    public function setPrimaryKey(string $key): TableMaker
    {
        $this->primaryKey = $key;

        return $this;
    }

    protected function beforeRender()
    {
        $this->data->put('view', view('panel::table', [
            'headers' => $this->headers->toArray(),
            'actions' => $this->actions?->toArray(),
            'rows' => $this->rows,
            'primaryKey' => $this->primaryKey,
            'paginate' => $this->paginate,
        ]));
    }
}
