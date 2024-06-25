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
