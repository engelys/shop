<?php

declare(strict_types=1);

namespace App\Http\Integrations\WP\Models;

use Zamaldinov28\JsonModel\JSONModel;

class WPOrderResponse extends JSONModel
{
    /**
     * @var int
     */
    public int $id;

    /**
     * @var string
     */
    public string $number;

    /**
     * @var string
     */
    public string $status;

    /**
     * @var ?int
     */
    public ?int $parent_id = null;

    /**
     * @var ?string
     */
    public ?string $currency = null;

    /**
     * @var ?bool
     */
    public ?bool $prices_include_tax = null;

    /**
     * @var ?int
     */
    public ?int $customer_id = null;

    /**
     * @var ?float
     */
    public ?float $discount_total = null;

    /**
     * @var ?float
     */
    public ?float $discount_tax = null;

    /**
     * @var ?float
     */
    public ?float $shipping_total = null;

    /**
     * @var ?float
     */
    public ?float $shipping_tax = null;

    /**
     * @var ?float
     */
    public ?float $cart_tax = null;

    /**
     * @var ?float
     */
    public ?float $total = null;

    /**
     * @var ?float
     */
    public ?float $total_tax = null;

    /**
     * @var ?string
     */
    public ?string $order_key = null;

    /**
     * @var ?string
     */
    public ?string $payment_method = null;

    /**
     * @var ?string
     */
    public ?string $payment_method_title = null;

    /**
     * @var ?string
     */
    public ?string $transaction_id = null;

    /**
     * @var ?string
     */
    public ?string $created_via = null;

    /**
     * @var ?string
     */
    public ?string $cart_hash = null;

    /**
     * @var ?string
     */
    public ?string $payment_url = null;

    /**
     * @var ?boolean
     */
    public ?bool $is_editable = null;

    /**
     * @var ?boolean
     */
    public ?bool $needs_payment = null;

    /**
     * @var ?boolean
     */
    public ?bool $needs_processing = null;

    /**
     * @var ?string
     */
    public ?string $date_paid = null; // timestamp')->nullable();

    /**
     * @var ?string
     */
    public ?string $date_completed = null; // timestamp')->nullable();

    /**
     * @var ?string
     */
    public ?string $customer_ip_address = null;

    /**
     * @var ?string
     */
    public ?string $customer_user_agent = null;

    /**
     * @var ?string
     */
    public ?string $customer_note = null;

//    @working

//    /**
//     * @var ?string
//     */
//    public ?string $line_items = null;

//    /**
//     * @var ?array
//     */
//    public ?array $shipping_lines = null;

//    /**
//     * @var ?array
//     */
//    public ?array $coupon_lines = null;

}
