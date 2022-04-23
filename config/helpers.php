<?php

use App\Exceptions\ApiForbiddenException;

const ROLE_ADMIN = 1;

function can ($permission) {
    if (!auth()->user()->can($permission)) {
        throw new ApiForbiddenException();
    }

    if (!auth()->user()->roles->contains(ROLE_ADMIN)) {
        throw new ApiForbiddenException();
    }

    return true;
}
