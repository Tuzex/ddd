<?php

declare(strict_types=1);

namespace Tuzex\Ddd\Domain\Location;

final class PostalAddress
{
    public function __construct(
        private Street $street,
        private Locality $locality,
        private Postcode $postcode,
        private Country $country,
    ) {}

    public function getStreet(): Street
    {
        return $this->street;
    }

    public function getLocality(): Locality
    {
        return $this->locality;
    }

    public function getPostcode(): Postcode
    {
        return $this->postcode;
    }

    public function getCountry(): Country
    {
        return $this->country;
    }
}
