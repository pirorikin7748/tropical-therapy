<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User; 
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class SalesController extends Controller
{
    public function index(Request $request)
    {
        $baseQuery = Order::with('user');

        //日付絞り込み
        if ($request->filled('start_date')) {
            $baseQuery->whereDate('created_at', '>=', $request->start_date);
        }

        if ($request->filled('end_date')) {
            $baseQuery->whereDate('created_at', '<=', $request->end_date);
        }

        //並び順
        $sort_column = $request->input('sort_column', 'created_at');
        $sort_direction = $request->input('sort_direction', 'asc');
        $baseQuery->orderBy($sort_column, $sort_direction);

        //クローンして集計専用クエリを用意
        $countQuery = clone $baseQuery;
        $sumQuery = clone $baseQuery;

        //売上集計
        $total_count = $countQuery->count();
        $total_sum = $sumQuery->sum('total_price');
                                            //ページ送りでも条件保持
        $orders = $baseQuery->paginate(10)->withQueryString();

        return view('admin.sales.index', compact('orders', 'total_count', 'total_sum'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,completed,canceled',
        ]);

        $order = Order::findOrFail($id);
        $order->status = $request->status;
        $order->save();

        return redirect()->route('admin.sales.index')->with('success', 'ステータスを変更しました。');
    }

    public function csv(Request $request)
    {
        $query = Order::with('user');

        //フィルター処理
        if ($request->filled('start_date')) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }
        if ($request->filled('end_date')) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        //並び順
        $sort_column = $request->input('sort_column', 'created_at');
        $sort_direction = $request->input('sort_direction', 'desc');
        $query->orderBy($sort_column, $sort_direction);

        $orders = $query->get();

        //csvヘッダー
        $csvHeader = ['注文ID', '名前', '合計金額', '注文ステータス', '注文日時'];
        $csvData = [];

        foreach ($orders as $order) {
            $csvData[] = [
                $order->id,
                $order->user ? $order->user->family_name . ' ' . $order->user->first_name : '不明',
                $order->total_price,
                $order->status,
                $order->created_at->format('Y-m-d H:i:s'),
            ];
        }

        $filename = 'orders_' . now()->format('Ymd_His') . '.csv';

        $response = Response::stream(function () use ($csvHeader, $csvData) {
            $handle = fopen('php://output', 'w');
            stream_filter_append($handle, 'convert.iconv.utf-8/cp932');

            fputcsv($handle, $csvHeader);
            foreach ($csvData as $row) {
                fputcsv($handle, $row);
            }
            fclose($handle);
        }, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ]);
        return $response;
    }
}
