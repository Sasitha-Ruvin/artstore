<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use App\Models\Category;
use ArielMejiaDev\LarapexCharts\Facades\LarapexChart;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalProducts = Product::count();
        $totalUsers = User::count();

        // Pie Chart: Products by Category
        $categories = Category::withCount('products')->get();
        $categoryNames = $categories->pluck('name')->toArray();
        $categoryCounts = $categories->pluck('products_count')->toArray();

        $categoryChart = LarapexChart::pieChart()
            ->setTitle('Products by Category')
            ->addData($categoryCounts)
            ->setLabels($categoryNames);

        // Line Chart: Product Addition Frequency
        $products = Product::selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->get();

        $dates = $products->pluck('date')->map(fn ($date) => Carbon::parse($date)->format('M d'))->toArray();
        $counts = $products->pluck('count')->toArray();

        $frequencyChart = LarapexChart::lineChart()
            ->setTitle('Product Addition Frequency')
            ->setSubtitle('Number of products added per day')
            ->addData('Products', $counts)
            ->setXAxis($dates);

        return view('admin.dashboard', compact('totalProducts', 'totalUsers', 'categoryChart', 'frequencyChart'));
    }
}
