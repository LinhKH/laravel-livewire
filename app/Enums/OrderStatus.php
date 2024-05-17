<?php
/**
 * User: Zura
 * Date: 9/17/2022
 * Time: 6:34 AM
 */

namespace App\Enums;


/**
 * Class OrderStatus
 *
 * @author  Zura Sekhniashvili <zurasekhniashvili@gmail.com>
 * @package App\Enums
 */
enum OrderStatus: int
{
    case Pending = 1;
    case Progress = 2;
    case Delivering = 3;
    case Cancelled = 4;
    case Completed = 5;

    public function status(): string
    {
        return match ($this) {
            OrderStatus::Pending => 'Pending',
            OrderStatus::Progress => 'Progress',
            OrderStatus::Delivering => 'Delivering',
            OrderStatus::Cancelled => 'Cancelled',
            OrderStatus::Completed => 'Completed',
        };
    }

    public function icon(): string
    {
        return match ($this) {
            OrderStatus::Pending => 'fa-check',
            OrderStatus::Progress => 'fa-line-chart',
            OrderStatus::Delivering => 'fa-truck',
            OrderStatus::Cancelled => 'fa-trash',
            OrderStatus::Completed => 'fa-dollar',
        };
    }
}
