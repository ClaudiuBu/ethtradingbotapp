<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// Models
use App\Models\Configurations as ConfigurationModel;

class Admin extends Controller
{
    private $configurations;

    public function __construct()
    {
        $this->configurations = ConfigurationModel::all();
    }

    public function index()
    {
        return view('admin.admin', [
            'configurations' => $this->configurations,
        ]);
    }
}
