<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactUs;
use App\Models\Blog;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $today = Carbon::today();

        $totalUsers = User::count();
        $newUsersCount = User::whereDate('created_at', $today)->count();

        $totalContacts = ContactUs::count();
        $unreadContacts = ContactUs::where('status', 0)->count();

        $totalBlogs = Blog::count();
        $publishedBlogs = Blog::where('status', 1)->count();

        $latestContacts = ContactUs::latest()->take(5)->get();

        // Empty chart data
        $ageData = [];
        $genderData = [];
        $occupationData = [];
        $maritalStatusData = [];

        return view('dashboard', compact(
            'totalUsers',
            'newUsersCount',
            'totalContacts',
            'unreadContacts',
            'totalBlogs',
            'publishedBlogs',
            'latestContacts',
            'ageData',
            'genderData',
            'occupationData',
            'maritalStatusData',
        ));
    }
}
