<?php

namespace T0team\LaravelPanel\Controllers\Makers;

use Illuminate\Pagination\LengthAwarePaginator;
use T0team\LaravelPanel\Controllers\Button;

class TableMaker extends Maker
{
    private array $headers;
    private string $primaryKey = 'id';
    private array $rows = [];
    private false|array $actions = false;
    private $paginate = false;

    public function __construct(array $headers, array $config)
    {
        $this->handle($config);

        if ($headers == []) {
            throw new \Exception('Headers can not be empty');
        }

        $this->headers = $headers;

        return $this;
    }

    public function addHeader(string $key, string $label): TableMaker
    {
        $this->headers[$key] = $label;

        return $this;
    }

    public function addHeaders(array $headers): TableMaker
    {
        foreach ($headers as $key => $label) {
            $this->addHeader($key, $label);
        }

        return $this;
    }

    public function paginate(LengthAwarePaginator $paginate, callable $mapForRows = null): self
    {
        $this->paginate = $paginate;

        $this->rows = [];
        if ($mapForRows) {
            $this->addRows($paginate->map($mapForRows));
        } else {
            $this->addRows($paginate);
        }

        return $this;
    }

    public function addAction(Button $button): self
    {
        $this->actions[] = $button->get();

        return $this;
    }

    public function addRows($rows): self
    {
        foreach ($rows as $row) {
            $this->addRow($row);
        }

        return $this;
    }

    public function addRow($row): self
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

    /**
     * Define the primary key of the table. Default is 'id'.
     */
    public function setPrimaryKey(string $key): self
    {
        $this->primaryKey = $key;

        return $this;
    }

    protected function beforeRender()
    {
        $this->data['view'] = view('panel::table', [
            'headers' => $this->headers,
            'primaryKey' => $this->primaryKey,
            'rows' => $this->rows,
            'actions' => $this->actions,
            'paginate' => $this->paginate ?? false,
        ]);
    }
}
