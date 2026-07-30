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
                $nodePath = env('NODE_BINARY');
                if (!$nodePath) {
                    foreach (['/opt/homebrew/bin/node', '/usr/local/bin/node', '/usr/bin/node'] as $path) {
                        if (file_exists($path)) {
                            $nodePath = $path;
                            break;
                        }
                    }
                }
                if ($nodePath) {
                    $browsershot->setNodeBinary($nodePath);
                }

                $npmPath = env('NPM_BINARY');
                if (!$npmPath) {
                    foreach (['/opt/homebrew/bin/npm', '/usr/local/bin/npm', '/usr/bin/npm'] as $path) {
                        if (file_exists($path)) {
                            $npmPath = $path;
                            break;
                        }
                    }
                }
                if ($npmPath) {
                    $browsershot->setNpmBinary($npmPath);
                }

                $chromePath = env('CHROME_PATH');
                if (!$chromePath) {
                    foreach ([
                        '/Applications/Google Chrome.app/Contents/MacOS/Google Chrome',
                        '/usr/bin/google-chrome',
                        '/usr/bin/chromium',
                        '/usr/bin/chromium-browser',
                    ] as $path) {
                        if (file_exists($path)) {
                            $chromePath = $path;
                            break;
                        }
                    }
                }
                if ($chromePath) {
                    $browsershot->setChromePath($chromePath);
                }

                $browsershot->noSandbox();
            })
            ->name('Invoice_SipAndSnug_' . substr($order->id, -8) . '.pdf')
            ->download();
    }
}
