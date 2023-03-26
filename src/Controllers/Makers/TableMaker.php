<?php

namespace LazySoft\LaravelPanel\Controllers\Makers;

use Illuminate\Pagination\LengthAwarePaginator;

class TableMaker extends Maker
{
    private array $headers;
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

    public function addAction(
        string $routeName,
        array $routeNeeded = ['id'],
        string $title = null,
        string $icon = 'fa-regular fa-pen-to-square',
        string $color = 'primary',
        bool $disabled = false,
        bool $openInNewTab = false
    ): self {
        $this->actions[] = (object)[
            'route' => $routeName,
            'needed' => $routeNeeded,
            'title' => $title,
            'icon' => $icon,
            'color' => $color,
            'disabled' => $disabled,
            'blanck' => $openInNewTab,
        ];

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

    protected function beforeRender()
    {
        $this->data['view'] = view('panel::table', [
            'headers' => $this->headers,
            'rows' => $this->rows,
            'actions' => $this->actions,
            'paginate' => $this->paginate ?? false,
        ]);
    }
}
