<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;
use App\Models\Field;

class FieldViewModel extends ViewModel
{
    public function __construct(public ?Field $field = null)
    {
        $this->field = is_null($field) ? new Field(old()) : $field;
    }

    public function action(): string
    {
        return is_null($this->field->id)
            ? route('admin.field.store')
            : route('admin.field.update', ['field' => $this->field->id]);
    }

    public function method(): string
    {
        return is_null($this->field->id) ? 'POST' : 'PUT';
    }
}
