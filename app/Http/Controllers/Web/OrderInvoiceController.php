<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\LaravelPdf\Facades\Pdf;
use Spatie\Browsershot\Browsershot;

class OrderInvoiceController extends Controller
{
    /**
     * Display printable/downloadable invoice for an order.
     */
    public function show($id)
    {
        $order = Order::with([
            'user',
            'address.deliveryZone',
            'orderItems.product',
            'orderItems.orderItemAddons.addOn'
        ])->findOrFail($id);

        // Security check: ensure user owns the order or is admin
        if (Auth::check() && Auth::user()->id !== $order->user_id && !Auth::user()->isAdmin()) {
            abort(403, 'Unauthorized access to invoice.');
        }

        return view('front.orders.invoice', compact('order'));
    }

    /**
     * Download invoice as PDF using Spatie Laravel Pdf (Puppeteer backend)
     */
    public function download($id)
    {
        $order = Order::with([
            'user',
            'address.deliveryZone',
            'orderItems.product',
            'orderItems.orderItemAddons.addOn'
        ])->findOrFail($id);

        if (Auth::check() && Auth::user()->id !== $order->user_id && !Auth::user()->isAdmin()) {
            abort(403, 'Unauthorized access to invoice.');
        }

        return Pdf::view('front.orders.invoice', compact('order'))
            ->format('a4')
            ->withBrowsershot(function (Browsershot $browsershot) {
                $browsershot->setNodeBinary('/usr/bin/node')
                            ->setNpmBinary('/usr/bin/npm')
                            ->setChromePath('/home/figo/.cache/puppeteer/chrome/linux-130.0.6723.116/chrome-linux64/chrome')
                            ->noSandbox();
            })
            ->name('Invoice_SipAndSnug_' . substr($order->id, -8) . '.pdf')
            ->download();
    }
}
