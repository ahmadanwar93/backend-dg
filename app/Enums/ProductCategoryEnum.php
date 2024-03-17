<?php

namespace App\Enums;
 
enum ProductCategoryEnum:string {
    case ELECTRONICS = 'Electronics';
    case CLOTHING = 'Clothing';
    case HOME_APP = 'Home Appliances';
    case BOOKS = 'Books';
    case TOYS = 'Toys';
    case FURNITURE = 'Furniture';
    case SPORTS_EQ = 'Sports Equipment';
    case BEAUTY_PROD = 'Beauty Products';
    case STATIONERY = 'Stationery';
}