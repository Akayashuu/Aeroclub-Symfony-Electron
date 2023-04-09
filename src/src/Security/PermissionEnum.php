<?php


namespace App\Security;


abstract class PermissionsEnum
{
    const ADMIN = "isAdmin";
    const WRITE = "canWrite";
    const READ = "canRead";
    const UPDATE = "canUpdate";
    const DELETE = "canDelete";
    const REDIRECT_ROUTE = "app_profile";
}