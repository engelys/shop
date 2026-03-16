<?php

declare(strict_types=1);

namespace App\Http\Integrations\WP\Models;

use Zamaldinov28\JsonModel\JSONModel;

class WPCustomerAddressResponse extends JSONModel
{
    /**
     * @var ?string
     */
    public ?string $first_name = null;

    /**
     * @var ?string
     */
    public ?string $last_name = null;

    /**
     * @var ?string
     */
    public ?string $company = null;

    /**
     * @var ?string
     */
    public ?string $address_1 = null;

    /**
     * @var ?string
     */
    public ?string $address_2 = null;

    /**
     * @var ?string
     */
    public ?string $city = null;

    /**
     * @var ?string
     */
    public ?string $postcode = null;

    /**
     * @var ?string
     */
    public ?string $country = null;

    /**
     * @var ?string
     */
    public ?string $state = null;

    /**
     * @var ?string
     */
    public ?string $email = null;

    /**
     * @var ?string
     */
    public ?string $phone = null;
}
