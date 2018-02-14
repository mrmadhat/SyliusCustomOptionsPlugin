<?php
declare(strict_types=1);

namespace Brille24\CustomerOptionsPlugin\Enumerations;

// TODO: Wait to see if sylius has something like this.
use Faker\Provider\Text;
use Sonata\CoreBundle\Form\Type\BooleanType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

final class CustomerOptionTypeEnum implements EnumInterface
{
    const __default = null;

    const TEXT         = 'text';
    const SELECT       = 'select';
    const MULTI_SELECT = 'multi_select';
    const FILE         = 'file';
    const DATE         = 'date';
    const DATETIME     = 'datetime';
    const NUMBER       = 'number';
    const BOOLEAN      = 'boolean';

    public static function getConstList(): array
    {
        return [
            self::TEXT,
            self::SELECT,
            self::MULTI_SELECT,
            self::FILE,
            self::DATE,
            self::DATETIME,
            self::NUMBER,
            self::BOOLEAN,
        ];
    }

    public static function isValid($enumValue): bool
    {
        return in_array($enumValue, self::getConstList());
    }

    public static function getTranslateArray(): array
    {
        return [
            self::TEXT         => 'brille24.form.customer_options.type.text',
            self::SELECT       => 'brille24.form.customer_options.type.select',
            self::MULTI_SELECT => 'brille24.form.customer_options.type.multi_select',
            self::FILE         => 'brille24.form.customer_options.type.file',
            self::DATE         => 'brille24.form.customer_options.type.date',
            self::DATETIME     => 'brille24.form.customer_options.type.datetime',
            self::NUMBER       => 'brille24.form.customer_options.type.number',
            self::BOOLEAN      => 'brille24.form.customer_options.type.boolean',
        ];
    }

    public static function getFormTypeArray(): array
    {
        return [
            self::TEXT => [
                TextType::class, [],
            ],
            self::SELECT => [
                ChoiceType::class, [],
            ],
            self::MULTI_SELECT => [
                ChoiceType::class, ['multiple' => true],
            ],
            self::FILE => [
                FileType::class, [],
            ],
            self::DATE => [
                DateType::class, [],
            ],
            self::DATETIME => [
                DateTimeType::class, [],
            ],
            self::NUMBER => [
                NumberType::class, [],
            ],
            self::BOOLEAN => [
                BooleanType::class, [],
            ],
        ];
    }
}