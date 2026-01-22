<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\Gallery;
use App\Models\Activity;
use App\Models\Product;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->get();
        $totalUsers = User::count();
        $totalGalleries = Gallery::count();
        $totalActivities = Activity::count();
        $totalProducts = Product::count();

        // ambil user per hari (7 hari terakhir)
        $usersPerDay = User::select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('COUNT(*) as total')
            )
            ->where('created_at', '>=', Carbon::now()->subDays(6))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // bikin format array buat chart
        $chartLabels = [];
        $chartData   = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i)->format('Y-m-d');
            $label = Carbon::now()->subDays($i)->translatedFormat('D'); // Sen, Sel, Rab

            $chartLabels[] = $label;

            $found = $usersPerDay->firstWhere('date', $date);
            $chartData[] = $found ? $found->total : 0;
        }

        $galleriesPerDay = Gallery::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('COUNT(*) as total')
        )
        ->where('created_at', '>=', Carbon::now()->subDays(6))
        ->groupBy('date')
        ->orderBy('date')
        ->get();

        $galleryChartData = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i)->format('Y-m-d');
            $found = $galleriesPerDay->firstWhere('date', $date);
            $galleryChartData[] = $found ? $found->total : 0;
        }

        $activitiesPerDay = Activity::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('COUNT(*) as total')
        )
        ->where('created_at', '>=', Carbon::now()->subDays(6))
        ->groupBy('date')
        ->orderBy('date')
        ->get();

        $activityChartData = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i)->format('Y-m-d');
            $found = $activitiesPerDay->firstWhere('date', $date);
            $activityChartData[] = $found ? $found->total : 0;
        }

        $productsPerDay = Product::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('COUNT(*) as total')
        )
        ->where('created_at', '>=', Carbon::now()->subDays(6))
        ->groupBy('date')
        ->orderBy('date')
        ->get();

        $productChartData = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i)->format('Y-m-d');
            $found = $productsPerDay->firstWhere('date', $date);
            $productChartData[] = $found ? $found->total : 0;
        }

        return view('backend.home.index', compact(
            'users',
            'totalUsers',
            'totalGalleries',
            'totalActivities',
            'totalProducts',
            'chartLabels',
            'chartData',
            'galleryChartData',
            'activityChartData',
            'productChartData'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:users,name',
            'password' => 'required|min:6'
        ]);

        User::create([
            'name' => $request->name,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->to(url()->previous() . '#users')
            ->with('success', 'User berhasil ditambahkan');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->to(url()->previous() . '#users')
            ->with('success', 'User berhasil dihapus');
    }
}
