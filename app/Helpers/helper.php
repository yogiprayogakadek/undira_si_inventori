<?php

use App\Models\Pengguna;

function checkLogin()
{
    $status = null;
    $currentPassword = '123456789';
    $pengguna = Pengguna::find(auth()->user()->id);
    if (!password_verify($currentPassword, $pengguna->password)) {
        $status = 'invalid';
    } else {
        $status = 'valid';
    }

    return $status;
}

function checkedData($data, $search, $key = 'produkId')
{
    $return = '';
    // // Decode the JSON data
    // $dataArray = json_decode($data, true);

    // // Initialize a variable to check if produkId 2 exists
    // $produkIdExists = false;

    // // Loop through the array to check if produkId is 2
    // foreach ($dataArray as $item) {
    //     if ($item['produkId'] == $search) {
    //         $produkIdExists = true;
    //         break;
    //     }
    // }

    // // Output the result
    // if ($produkIdExists) {
    //     $return = 'checked';
    // } else {
    //     $return = '';
    // }

    // return $return;

    // Decode the JSON data
    $dataArray = json_decode($data, true);

    // Initialize a variable to store the matching data
    $matchingData = null;

    // Loop through the array to find the item with produkId 2
    foreach ($dataArray as $item) {
        if ($item['produkId'] == $search) {
            $matchingData = $item;
            break;
        }
    }

    if ($matchingData) {
        $return = 'checked';
    }

    return [
        'checked' => $return,
        'data' => $matchingData[$key] ?? ''
    ];
}
