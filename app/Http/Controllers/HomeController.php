<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Mail;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

use App\Models\Product;
use App\Models\Category;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Client;
use App\Models\Message;

class HomeController extends Controller
{
    /* ============================
       Pages publiques
    ============================ */

    public function index()
    {
        $products = Product::paginate(20);
        $categories = Category::orderBy('catagory_name', 'asc')->get();
        return view('home.userpage', compact('products', 'categories'));
    }

    public function blog()
    {
        return view('home.blog');
    }

    public function contact()
    {
        return view('home.contact');
    }

    // Soumission du formulaire de contact et enregistrement en base
    public function submitContact(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        // Enregistrement en base
        Message::create([
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
        ]);

        // Optionnel : envoi par email
        Mail::raw(
            "Nom: {$request->name}\nEmail: {$request->email}\nMessage: {$request->message}",
            function ($msg) use ($request) {
                $msg->to('admins@gmail.com')
                    ->subject("Nouveau message: {$request->subject}");
            }
        );

        return redirect()->back()->with('success', 'Votre message a été envoyé avec succès !');
    }

    public function about()
    {
        return view('home.about');
    }

    public function pproduct()
    {
        $products = Product::paginate(12);
        $categories = Category::all();
        return view('home.pproduct', compact('products', 'categories'));
    }

    // Filtrer les produits par catégorie
    public function productsByCategory($categoryId)
    {
        $products = Product::where('id_category', $categoryId)->paginate(9);
        $categories = Category::all();
        return view('home.products', compact('products', 'categories'));
    }

    // Rechercher des produits par description
    public function products(Request $request)
    {
        $search = $request->input('search');

        $query = Product::query();
        if (!empty($search)) {
            $query->where('description', 'LIKE', "%{$search}%");
        }

        $products = $query->paginate(9);
        return view('home.products', compact('products'));
    }

    // Afficher les détails d’un produit avec sa fiche technique
    public function product_details($reference)
    {
        // Récupérer le produit et sa fiche technique associée depuis la base
        $product = Product::with('ficheTechnique')->findOrFail($reference);
        return view('home.product_details', compact('product'));
    }

    /* ============================
       Panier
    ============================ */

    public function add_cart(Request $request, $reference)
{
    if (!Auth::guard('client')->check()) {
        return redirect()->route('client.login');
    }

    $client = Auth::guard('client')->user();
    $product = Product::where('reference', $reference)->firstOrFail();

    // Déterminer le prix correct : discount_price si existe, sinon price
    $unitPrice = $product->discount_price ?? $product->price;

    $cart = new Cart();
    $cart->name = $client->name;
    $cart->email = $client->email;
    $cart->phone = $client->phone;
    $cart->address = $client->address;
    $cart->client_id = $client->id;
    $cart->product_title = $product->description;
    $cart->product_reference = $product->reference;
    $cart->unit_price = $unitPrice; // ⚡ ici on utilise le prix correct
    $cart->quantity = $request->quantity;
    $cart->total = $unitPrice * $request->quantity;
    $cart->image = $product->image;
    $cart->save();

    return redirect()->back()->with('message', 'Produit ajouté au panier ✅');
}

    public function show_cart()
    {
        if (!Auth::guard('client')->check()) return redirect()->route('client.login');

        $client = Auth::guard('client')->user();
        $carts = Cart::where('client_id', $client->id)->get();

        $grandTotal = 0;
        $messageCommande = "Bonjour,\nVoici ma commande :\n";

        foreach ($carts as $item) {
            $lineTotal = $item->unit_price * $item->quantity;
            $grandTotal += $lineTotal;
            $messageCommande .= "- {$item->product_title} x{$item->quantity} : " . number_format($lineTotal, 2) . " DH\n";
        }

        $messageCommande .= "Total : " . number_format($grandTotal, 2) . " DH";

        $messageWhatsapp = urlencode($messageCommande);
        $numeroDestinataire = "212710678089";
        $messageEmail = $messageCommande;
        $emailDestinataire = "elhoubnouhad@gmail.com";

        return view('home.showcart', compact(
            'carts','grandTotal','messageCommande','messageWhatsapp','numeroDestinataire','messageEmail','emailDestinataire'
        ));
    }

    public function update_cart(Request $request, $id)
    {
        $request->validate(['quantity'=>'required|integer|min:1']);
        $cart = Cart::where('id', $id)->where('client_id', Auth::guard('client')->id())->firstOrFail();
        $cart->quantity = $request->quantity;
        $cart->total = $cart->unit_price * $request->quantity;
        $cart->save();

        return redirect()->back()->with('message','Quantité mise à jour ✅');
    }

    public function removeCartItem($id)
    {
        $cart = Cart::where('id', $id)->where('client_id', Auth::guard('client')->id())->first();
        if ($cart) $cart->delete();
        return redirect()->back()->with('message','Produit supprimé ✅');
    }

    /* ============================
       Commande
    ============================ */

   public function confirmOrder(Request $request)
{
    if (!Auth::guard('client')->check()) {
        return redirect()->route('client.login');
    }

    $type = $request->input('type'); // 'whatsapp' ou 'email'
    $client = Auth::guard('client')->user();
    $carts = Cart::where('client_id', $client->id)->get();

    if ($carts->isEmpty()) {
        return redirect()->back()->with('message', 'Le panier est vide.');
    }

    $grandTotal = 0;

    $messageCommande  = "👤 Nom : {$client->name}\n";
    $messageCommande .= "📞 Téléphone : {$client->phone}\n";
    $messageCommande .= "🏠 Adresse : {$client->address}\n\n";
    $messageCommande .= "Bonjour,\nVoici ma commande :\n\n";
    $messageCommande .= "----------------------------------------------------------------------\n";
    $messageCommande .= "Description                     Qté                     Total (DH)\n";
    $messageCommande .= "-----------------------------------------------------------------------\n";

    foreach ($carts as $item) {
        $lineTotal = $item->unit_price * $item->quantity;
        $grandTotal += $lineTotal;

        $title = substr($item->product_title, 0,50);
        $messageCommande .= str_pad($title, 30)
                          . str_pad("x{$item->quantity}", 18)
                          . number_format($lineTotal, 2) . " DH\n";

        // Enregistrer la commande en BDD
        Order::create([
            'client_id'       => $client->id,
            'name'            => $client->name,
            'email'           => $client->email,
            'phone'           => $client->phone,
            'address'         => $client->address,
            'product_title'   => $item->product_title,
            'product_id'      => $item->product_reference, // ou product_id si tu veux
            'quantity'        => $item->quantity,
            'price'           => $item->unit_price,
            'total_price'     => $lineTotal,
            'delivery_status' => 'processing',
            'payment_status'  => 'pending',
            'image'           => $item->image,
        ]);
    }

    $messageCommande .= "-----------------------------------------------------------------------\n";
    $messageCommande .= "\n                                        📌 Total : " . number_format($grandTotal, 2) . " DH\n";

    if ($type === 'whatsapp') {
        $numeroDestinataire = $client->phone;
        $messageWhatsapp = urlencode($messageCommande);
        return redirect()->away("https://wa.me/{$numeroDestinataire}?text={$messageWhatsapp}");
    } elseif ($type === 'email') {
        Mail::raw($messageCommande, function ($message) use ($client) {
            $message->to($client->email)
                    ->subject("Confirmation de votre commande");
        });

        return redirect()->back()->with('message', 'Votre commande a été envoyée par email ✅');
    }

    return redirect()->back()->with('message', 'Commande envoyée ✅');
}


    /* ============================
       Authentification client
    ============================ */

    public function showLoginForm() { return view('client.login'); }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::guard('client')->attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }
        return back()->withErrors(['email' => 'Email ou mot de passe invalide']);
    }

    public function logout(Request $request)
    {
        Auth::guard('client')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home');
    }

    public function showRegisterForm() { return view('client.register'); }

    public function register(Request $request)
    {
        $request->validate([
            'name'=>'required|string|max:255',
            'email'=>'required|string|email|max:255|unique:clients',
            'phone'=>'nullable|string|max:20',
            'address'=>'nullable|string|max:255',
            'password'=>'required|string|confirmed|min:6',
        ]);

        $client = Client::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'address'=>$request->address,
            'password'=>Hash::make($request->password),
        ]);

        event(new Registered($client));
        Auth::guard('client')->login($client);
        return redirect()->route('home');
    }

    /* ============================
       Profil client
    ============================ */

    public function profile()
    {
        $client = Auth::guard('client')->user();
        $orders = Order::where('client_id', $client->id)
                       ->orderBy('created_at', 'desc')
                       ->get();

        return view('client.profile', compact('client', 'orders'));
    }

    /*public function profile()
    {
        $orders = Auth::guard('client')->user()->orders;
        return view('client.profile', compact('orders'));
    }*/

    public function updateProfile(Request $request)
    {
        $client = Auth::guard('client')->user();

        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255|unique:clients,email,' . $client->id,
            'phone'   => 'required|string|max:20',
            'address' => 'required|string|max:255',
        ]);

        $client->update([
            'name'    => $request->name,
            'email'   => $request->email,
            'phone'   => $request->phone,
            'address' => $request->address,
        ]);

        return redirect()->back()->with('message', 'Profil mis à jour ✅');
    }

    /* ============================
       Social Login
    ============================ */

    // Redirection vers le provider
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    // Callback après authentification
    public function callback($provider)
    {
        try {
            $socialUser = Socialite::driver($provider)->user();

            // Vérifier si l'utilisateur existe déjà
            $user = Client::where('email', $socialUser->getEmail())->first();

            if (!$user) {
                // Créer un nouvel utilisateur
                $user = Client::create([
                    'name' => $socialUser->getName() ?? $socialUser->getNickname(),
                    'email' => $socialUser->getEmail(),
                    'password' => bcrypt(Str::random(16)), // mot de passe aléatoire
                ]);
            }

            Auth::login($user);

            return redirect()->route('home'); // redirige vers la page d'accueil
        } catch (\Exception $e) {
            return redirect()->route('client.login')->withErrors('Erreur lors de la connexion sociale : ' . $e->getMessage());
        }
    }
}
