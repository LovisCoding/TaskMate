<?php
namespace App\Controllers;
class DateControlleur extends BaseController
{
public function __construct()
{
helper(['date']);
}
public function index()
{
echo view ('date_vue');
}
}