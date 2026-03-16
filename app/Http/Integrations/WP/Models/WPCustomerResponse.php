<?php

declare(strict_types=1);

namespace App\Http\Integrations\WP\Models;

use Zamaldinov28\JsonModel\JSONModel;

class WPCustomerResponse extends JSONModel
{
    /**
     * @var int
     */
    public int $id;

    /**
     * @var string
     */
    public string $email;

    /**
     * @var string
     */
    public string $username;

    /**
     * @var ?string
     */
    public ?string $name = null;

    /**
     * @var ?string
     */
    public ?string $date_created = null;

    /**
     * @var ?string
     */
    public ?string $date_created_gmt = null;

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
    public ?string $role = null;

    /**
     * @var ?WPCustomerAddressResponse
     */
    public ?WPCustomerAddressResponse $billing = null;

    /**
     * @var ?WPCustomerAddressResponse
     */
    public ?WPCustomerAddressResponse $shipping = null;

    /**
     * @var ?bool
     */
    public ?bool $is_paying_customer = null;

    /**
     * @var ?string
     */
    public ?string $avatar_url = null;
}
