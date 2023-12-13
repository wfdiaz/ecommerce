<?php

namespace App\Http\Traits;

trait OrderTableTrait
{

    public $camp = 'id';
    public $order = 'asc';
    public $icon = '↑';

    public function order($column)
    {
        if ($column == $this->camp) {

            switch ($this->order) {
                case 'asc':
                    $this->order = 'desc';
                    $this->icon = '↓';
                    break;
                case 'desc':
                    $this->order = 'asc';
                    $this->icon = '↑';
                    break;
                default:
                    $this->order = 'asc';
                    $this->icon = '';
                    break;
            }
        }
        else {
            $this->order = 'asc';
            $this->icon = '↑';
        }
        $this->camp = $column;
    }

}
