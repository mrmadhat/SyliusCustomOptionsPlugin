<?php

declare(strict_types=1);

namespace Brille24\SyliusCustomerOptionsPlugin\Entity\CustomerOptions\Validator;

use Brille24\SyliusCustomerOptionsPlugin\Traits\ConditionTrait;

class Constraint implements ConstraintInterface
{
    use ConditionTrait;

    protected ?int $id = null;

    public function getId(): ?int
    {
        return $this->id;
    }
}
