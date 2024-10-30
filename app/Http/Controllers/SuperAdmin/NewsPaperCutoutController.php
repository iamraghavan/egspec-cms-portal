<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\NewspaperCutout;
use Illuminate\Http\Request;

class NewsPaperCutoutController extends Controller
{
    public function sa_newspcc_index()
    {
        $newspcc = NewspaperCutout::with('user')->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.pages.newspaper-cutout.newspaper-cutout', compact('newspcc'));
    }
}