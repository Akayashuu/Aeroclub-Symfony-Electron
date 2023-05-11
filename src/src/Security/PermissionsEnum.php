<?php


namespace App\Security;

use App\Entity\Permissions;
use App\Repository\PermissionsRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Response;


abstract class PermissionsEnum
{
    const ADMIN = "isAdmin";
    const WRITE = "canWrite";
    const READ = "canRead";
    const UPDATE = "canUpdate";
    const DELETE = "canDelete";
    const REDIRECT_ROUTE = "app_profile";
}