<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Services\BrandService;
use App\Services\CategoryService;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\View;

use Neon\Services\LinkService;
use Neon\Models\Link;

class CaseStudyController extends Controller
{
    public function show(Request $request, string $slug = null)
    {
    }
}
