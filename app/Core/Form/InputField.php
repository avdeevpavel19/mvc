<?php

namespace App\Core\Form;

use App\Core\Model;

class InputField extends BaseField
{
    public const TEXT_TYPE     = 'text';
    public const PASSWORD_TYPE = 'password';

    public string $type;

    /**
     * @param Model  $model
     * @param string $attribute
     */
    public function __construct(Model $model, string $attribute)
    {
        $this->type = self::TEXT_TYPE;
        parent::__construct($model, $attribute);
    }

    public function passwordField()
    {
        $this->type = self::PASSWORD_TYPE;

        return $this;
    }

    public function renderInput(): string
    {
        return sprintf('<input type="%s" class="form-control%s" name="%s" value="%s">',
            $this->type,
            $this->model->hasError($this->attribute) ? ' is-invalid' : '',
            $this->attribute,
            $this->model->{$this->attribute}
        );
    }
}