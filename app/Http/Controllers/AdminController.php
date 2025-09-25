<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

use App\Mail\ReplyMail;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\Client;
use App\Models\Message;
use App\Models\Entry;

use Carbon\Carbon;

class AdminController extends Controller
{
    // ==================== CATEGORY ====================
    public function view_category()
    {
        $categories = Category::all();
        return view('admin.catagory', compact('categories'));
    }

    public function add_category(Request $request)
    {
        $request->validate([
            'category' => 'required|string|max:255',
        ]);

        Category::create([
            'catagory_name' => $request->category
        ]);

        return redirect()->back()->with('message', 'Catégorie ajoutée avec succès ✅');
    }

    public function delete_category($id)
    {
        $category = Category::find($id);
        if ($category) {
            $category->delete();
            return redirect()->back()->with('message', 'Catégorie ajoutée avec succès ✅');
        }

        return redirect()->back()->withErrors(['error' => 'Catégorie introuvable']);
    }

    // ==================== PRODUCT ====================
    public function view_product()
    {
        $categories = Category::all();
        return view('admin.product', compact('categories'));
    }

    public function add_product(Request $request)
    {
        $request->validate([
            'reference' => 'required|string|max:255|unique:products,reference',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'discount_price' => 'nullable|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'id_category' => 'required|exists:catagories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $product = new Product($request->only([
            'reference', 'description', 'price', 'discount_price', 'quantity', 'id_category'
        ]));

        if ($request->hasFile('image')) {
            $imageName = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('product'), $imageName);
            $product->image = $imageName;
        }

        $product->save();

        return redirect()->back()->with('message', 'Produit ajouté avec succès ✅');
    }

    public function show_product()
    {
        $products = Product::with('category')->paginate(10);
        return view('admin.show_product', compact('products'));
    }

    public function update_product($reference)
    {
        $product = Product::findOrFail($reference);
        $categories = Category::all();
        return view('admin.update_product', compact('product', 'categories'));
    }

    public function update_product_confirm(Request $request, $reference)
    {
        $request->validate([
            'description' => 'nullable|string|max:255',
            'id_category' => 'required|exists:catagories,id',
            'quantity' => 'required|integer|min:0',
            'price' => 'nullable|numeric|min:0',
            'discount_price' => 'nullable|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $product = Product::findOrFail($reference);

        $product->update($request->only([
            'description', 'id_category', 'quantity', 'price', 'discount_price'
        ]));

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('product'), $imageName);
            $product->image = $imageName;
            $product->save();
        }

        return redirect()->route('admin.products')->with('success', 'Produit mis à jour avec succès.');
    }

    public function delete_product($reference)
    {
        $product = Product::findOrFail($reference);

        if ($product->image && File::exists(public_path('product/' . $product->image))) {
            File::delete(public_path('product/' . $product->image));
        }

        $product->delete();

        return redirect()->back()->with('message', 'Produit supprimé avec succès ✅');
    }

    // ==================== ORDER ====================
    public function order()
    {
        $orders = Order::with(['client', 'product'])->orderBy('created_at', 'desc')->get();
        return view('admin.order', compact('orders'));
    }

    public function delivered($id)
    {
        $order = Order::find($id);
        if (!$order) return redirect()->back()->withErrors(['error' => 'Commande introuvable']);

        $order->delivery_status = 'delivered';
        $order->save();

        $product = Product::where('description', $order->product_title)->first();
        if ($product) {
            $product->quantity = max($product->quantity - $order->quantity, 0);
            $product->save();
        }

        return redirect()->route('admin.orders')->with('message', '✅ Commande livrée et stock mis à jour');
    }

    public function searchdata(Request $request)
    {
        $searchText = $request->search;
        $orders = Order::with(['client', 'product'])
            ->where('name', 'LIKE', "%$searchText%")
            ->orWhere('phone', 'LIKE', "%$searchText%")
            ->orWhere('product_reference', 'LIKE', "%$searchText%")
            ->get();

        return view('admin.order', compact('orders'));
    }

    // ==================== ENTRIES ====================
    public function entry(Request $request)
    {
        $search = $request->input('search');

        $entries = DB::table('entries')
            ->leftJoin('products', 'entries.product_reference', '=', 'products.reference')
            ->select('entries.*', 'products.description')
            ->when($search, function ($query, $search) {
                $query->where('entries.product_reference', 'like', "%{$search}%")
                      ->orWhere('products.description', 'like', "%{$search}%");
            })
            ->orderBy('entries.created_at', 'desc')
            ->paginate(10);

        return view('admin.entry', compact('entries'));
    }

    public function checkProduct($reference)
    {
        $exists = Product::where('reference', $reference)->exists();
        return response()->json(['exists' => $exists]);
    }

    public function add_entry()
    {
        return view('admin.add_entry');
    }

    public function store_entry(Request $request)
    {
        $request->validate([
            'reference' => 'required|string|max:255',
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Product::find($request->reference);
        if ($product) {
            $product->increment('quantity', $request->quantity);
        }

        DB::table('entries')->insert([
            'product_reference' => $request->reference,
            'quantity' => $request->quantity,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->back()->with('message', 'Entrée enregistrée avec succès ✅');
    }

    public function delete_entry($reference)
    {
        $product = Product::findOrFail($reference);

        if ($product->image && File::exists(public_path('product/' . $product->image))) {
            File::delete(public_path('product/' . $product->image));
        }

        $product->delete();

        return redirect()->route('admin.entry')->with('message', 'Entrée supprimé avec succès ✅');
    }

    // ==================== AUTHENTICATION ====================
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if (Auth::guard('admin')->attempt($request->only('email','password'))) {
            $request->session()->regenerate();
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors([
            'email' => 'Email ou mot de passe incorrect'
        ])->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout(); 
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        //$products = Product::paginate(20);
        return redirect()->route('home'); 
        //return view('home.userpage',compact('products'));
    }

    // ==================== DASHBOARD ====================
   public function view_dashboard()
{
    // Totaux
    $total_product = Product::count();
    $total_order   = Order::count();
    $total_client  = Client::count();
    $total_revenue = Order::sum('total_price');

    // ======================
    // Dernières commandes
    // ======================
    $recent_orders = Order::with('client')
        ->orderBy('created_at', 'desc')
        ->take(5)
        ->get();

    // ======================
    // Ventes du mois en cours (tous les jours)
    // ======================
    $startOfMonth = Carbon::now()->startOfMonth();
    $endOfMonth   = Carbon::now()->endOfMonth();

    $orders = Order::select(
            DB::raw('DAY(created_at) as day'),
            DB::raw('COUNT(*) as total')
        )
        ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
        ->groupBy('day')
        ->pluck('total', 'day'); // [jour => total]

    $daysInMonth = $startOfMonth->daysInMonth;
    $daily_sales_labels = range(1, $daysInMonth);
    $daily_sales_values = [];

    foreach ($daily_sales_labels as $day) {
        $daily_sales_values[] = $orders[$day] ?? 0;
    }

    $currentMonthName = $startOfMonth->translatedFormat('F Y'); // ex: "Septembre 2025"
    $currentYearName = Carbon::now()->year;

    // ======================
    // Chiffre d'affaires mensuel (tous les mois de l'année)
    // ======================
    $months = [
        1 => 'Jan', 2 => 'Fév', 3 => 'Mar', 4 => 'Avr',
        5 => 'Mai', 6 => 'Juin', 7 => 'Juil', 8 => 'Août',
        9 => 'Sep', 10 => 'Oct', 11 => 'Nov', 12 => 'Déc'
    ];

    $revenueData = Order::select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('SUM(total_price) as total')
        )
        ->whereYear('created_at', $currentYearName)
        ->groupBy('month')
        ->pluck('total', 'month'); // [mois => total]

    $revenue_labels = [];
    $revenue_values = [];

    foreach ($months as $num => $name) {
        $revenue_labels[] = $name;
        $revenue_values[] = $revenueData[$num] ?? 0;
    }

    // ======================
    // Retourner la vue
    // ======================
    return view('admin.dashboard', compact(
        'total_product',
        'total_order',
        'total_client',
        'total_revenue',
        'recent_orders',
        'daily_sales_labels',
        'daily_sales_values',
        'revenue_labels',
        'revenue_values',
        'currentMonthName',
        'currentYearName'
    ));
}

    // ==================== MESSAGES ====================
    public function showMessages()
    {
        return view('admin.messages');
    }

    public function messages()
    {
        $messages = Message::orderBy('created_at','desc')->get();
        return view('admin.messages', compact('messages'));
    }

    public function replyMessage($id)
    {
        $message = Message::findOrFail($id);
        return view('admin.reply', compact('message'));
    }

    // Traitement et envoi du mail
    public function sendReply(Request $request, $id)
    {
        $request->validate([
            'reply' => 'required|string|max:5000',
        ]);

        $message = Message::findOrFail($id);

        // Envoi du mail
        Mail::to($message->email)->send(new ReplyMail($message, $request->reply));

        return redirect()->route('admin.messages')->with('message', 'Réponse envoyée avec succès ✅');
    }

}
