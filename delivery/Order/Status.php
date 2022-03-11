<?php

namespace Delivery\Order;

enum Status: string
{
    case NEW = "order has been formed";
    case APPROVED = "order has been approved";
}
