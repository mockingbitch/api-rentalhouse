<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Label Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used by the paginator library to build
    | the label. You are free to change them to anything
    | you want to customize your views to better match your application.
    |
    */
    'common' => [
        'field' => [
            'status'     => 'Status',
            'created_at' => 'Created at',
            'updated_at' => 'Updated at',
            'deleted_at' => 'Deleted at',
        ],
        'status' => [
            'active'    => 'Inactivate',
            'draft'     => 'Draft',
            'pending'   => 'Pending',
            'inactive'  => 'Hide',
        ],
    ],
    'user' => [
        'field' => [
            'email'            => 'Email',
            'password'         => 'Password',
            'confirm_password' => 'Confirm Password',
            'firstName'        => 'First name',
            'lastName'         => 'Last name',
            'birthday'         => 'Birthday',
            'province'         => 'Province',
            'district'         => 'District',
            'ward'             => 'Ward',
            'address'          => 'Address',
        ],
    ],
    'category' => [
        'field' => [
            'name_vi'        => 'Name (vi)',
            'name_en'        => 'Name (en)',
            'description_vi' => 'Description (vi)',
            'description_en' => 'Description (en)',
            'icon'           => 'Icon',
        ],
    ],
    'tag' => [
        'field' => [
            'name_vi'        => 'Name (vi)',
            'name_en'        => 'Name (en)',
        ],
    ],
    'house' => [
        'field' => [
            'name'          => 'Name',
            'description'   => 'Description',
            'province_code' => 'Province code',
            'district_code' => 'District code',
            'ward_code'     => 'Ward code',
            'full_address'  => 'Full address',
            'thumbnail'     => 'Thumbnail',
            'category_id'   => 'Category',
        ],
    ],
];
