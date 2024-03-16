<?php

namespace App\Enums;
 
enum ProductCategoryEnum:string {
    case ELECTRONICS = 'electronics';
    case CLOTHING = 'clothing';
    case HOME_APP = 'home_app';
    case BOOKS = 'books';
    case TOYS = 'toys';
    case FURNITURE = 'furniture';
    case SPORTS_EQ = 'sports_eq';
    case BEAUTY_PROD = 'beauty_prod';
    case STATIONERY = 'stationery';
}