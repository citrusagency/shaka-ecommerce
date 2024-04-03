<?php

return [
    [
        'key'   => 'account',
        'name'  => 'shop::app.layouts.my-account',
        'route' =>'customer.profile.index',
        'sort'  => 1,
        'icon'  => 'profile_bl'
    ], [
        'key'   => 'account.profile',
        'name'  => 'shop::app.layouts.profile',
        'route' =>'customer.profile.index',
        'sort'  => 1,
        'icon'  => 'profile_icon'
    ], [
        'key'   => 'account.address',
        'name'  => 'shop::app.layouts.address',
        'route' =>'customer.address.index',
        'sort'  => 2,
        'icon'  => 'address_icon'
    ], [
        'key'   => 'account.wishlist',
        'name'  => 'shop::app.layouts.wishlist',
        'route' => 'customer.wishlist.index',
        'sort'  => 3,
        'icon'  => 'wishlist_icon'
    ], [
        'key'   => 'account.orders',
        'name'  => 'shop::app.layouts.orders',
        'route' => 'customer.orders.index',
        'sort'  => 4,
        'icon'  => 'order_icon'
    ],
//    [
//        'key'   => 'account.downloadables',
//        'name'  => 'shop::app.layouts.downloadable-products',
//        'route' =>'customer.downloadable_products.index',
//        'sort'  => 6,
//    ]
//    [
//        'key'   => 'account.compare',
//        'name'  => 'shop::app.customer.compare.text',
//        'route' =>'velocity.customer.product.compare',
//        'sort'  => 7,
//    ],
//    [
//        'key'   => 'account.reviews',
//        'name'  => 'shop::app.layouts.reviews',
//        'route' =>'customer.reviews.index',
//        'sort'  => 8,
//    ],
];

?>