<?php

/**
 * This file is part of the Brille24 customer options plugin.
 *
 * (c) Brille24 GmbH
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Brille24\SyliusCustomerOptionsPlugin\Entity\CustomerOptions;

use Brille24\SyliusCustomerOptionsPlugin\Entity\ProductInterface;
use Brille24\SyliusCustomerOptionsPlugin\Entity\Tools\DateRangeInterface;
use Sylius\Bundle\MoneyBundle\Formatter\MoneyFormatter;
use Sylius\Bundle\MoneyBundle\Formatter\MoneyFormatterInterface;
use Sylius\Component\Core\Model\ChannelInterface;
use Symfony\Component\Config\Definition\Exception\InvalidTypeException;

class CustomerOptionValuePrice implements CustomerOptionValuePriceInterface, \Stringable
{
    protected ?int $id = null;

    protected float $percent = 0;

    protected int $amount = 0;

    protected string $type = CustomerOptionValuePriceInterface::TYPE_FIXED_AMOUNT;

    protected ?CustomerOptionValueInterface $customerOptionValue = null;

    protected ?ProductInterface $product = null;

    protected ?ChannelInterface $channel = null;

    protected ?DateRangeInterface $dateValid = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPercent(): float
    {
        return $this->percent;
    }

    public function setPercent(float $percent): void
    {
        $this->percent = $percent;
    }

    public function getAmount(): int
    {
        return $this->amount;
    }

    public function setAmount(int $amount): void
    {
        $this->amount = $amount;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): void
    {
        $allTypes = self::getAllTypes();

        if (in_array($type, $allTypes, true)) {
            $this->type = $type;
        } else {
            throw new InvalidTypeException('Invalid type. Possible types are ' . implode(', ', $allTypes));
        }
    }

    public static function getAllTypes(): array
    {
        return [
            self::TYPE_FIXED_AMOUNT,
            self::TYPE_PERCENT,
        ];
    }

    public function getCustomerOptionValue(): ?CustomerOptionValueInterface
    {
        return $this->customerOptionValue;
    }

    public function setCustomerOptionValue(?CustomerOptionValueInterface $customerOptionValue): void
    {
        $this->customerOptionValue = $customerOptionValue;
    }

    public function __toString(): string
    {
        return $this->getValueString('USD', 'en_US', new MoneyFormatter());
    }

    public function getValueString(string $currencyCode, string $locale, MoneyFormatterInterface $formatter): string
    {
        if ($this->getType() === CustomerOptionValuePriceInterface::TYPE_FIXED_AMOUNT) {
            return $formatter->format($this->getAmount(), $currencyCode, $locale);
        }

        $percent = $this->getPercent() * 100;

        return "{$percent}%";
    }

    public function getProduct(): ?ProductInterface
    {
        return $this->product;
    }

    public function setProduct(?ProductInterface $product): void
    {
        $this->product = $product;
    }

    public function setChannel(?ChannelInterface $channel): void
    {
        $this->channel = $channel;
    }

    public function getChannel(): ?ChannelInterface
    {
        return $this->channel;
    }

    public function getDateValid(): ?DateRangeInterface
    {
        return $this->dateValid;
    }

    public function setDateValid(?DateRangeInterface $dateRange): void
    {
        $this->dateValid = $dateRange;
    }

    public function isActive(): bool
    {
        if ($this->dateValid === null) {
            return true;
        }

        return $this->dateValid->contains(new \DateTime('now'));
    }
}
