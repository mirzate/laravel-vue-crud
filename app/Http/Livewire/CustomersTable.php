<?php

namespace App\Http\Livewire;

use App\Models\Customer;

use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;


class CustomersTable extends LivewireDatatable
{
    public $model = Customer::class;

    public function columns()
    {
        return [
            Column::name('id'),
            Column::name('name')->searchable()->filterable()
        ];
    }
}
