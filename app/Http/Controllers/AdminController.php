<?php

namespace App\Http\Controllers;

use App\Role;
use App\Models\User;
use App\Order;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ExportClass;
use App\Models\Ring;
use App\Models\Type;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    protected $navItems = [
        [
            'name' => 'Gebruikers',
            'route' => 'admin.users',
        ],
        [
            'name' => 'Ringen',
            'route' => 'admin.rings',
        ],
        [
            'name' => 'Orders',
            'route' => 'admin.orders',
        ],
        [
            'name' => 'Exporteren',
            'route' => 'admin.exports',
        ],
    ];

    public function index()
    {
        $navItems = $this->navItems;

        return view('admin.index', compact('navItems'));
    }

    public function users()
    {
        $navItems = $this->navItems;

        // desc
        $users = User::orderBy('created_at', 'desc')->get();

        return view('admin.users.index', compact('users', 'navItems'));
    }

    public function createUser()
    {
        $navItems = $this->navItems;

        $roles = Role::all();

        return view('admin.users.create', compact('roles', 'navItems'));
    }

    public function storeUser(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . Auth::id(),
            
        ]);

        $user = new User();

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        // password is hashed in the model, rol als foreign key naar roles opgesaan als role_id, phone, birthdate, address_street, address_nr, address_city, address_zipcode,

        // hash the password
        $user->password = bcrypt($request->input('password'));
        $user->lidnummer = $request->input('lidnummer');
        $user->role()->associate($request->input('role'));
        $user->phone = $request->input('phone');
        $user->birthdate = $request->input('birthdate');
        $user->address_street = $request->input('street');
        $user->address_nr = $request->input('nr');
        $user->address_city = $request->input('city');
        $user->address_zipcode = $request->input('zipcode');


        $user->save();

        return redirect()->route('admin.users')->with('success', 'User created successfully.');
    }

    public function editUser($id)
    {
        $navItems = $this->navItems;

        $user = User::findOrFail($id);
        $roles = Role::all();

        return view('admin.users.edit', compact('user', 'roles', 'navItems'));
    }

    public function updateUser(Request $request, $id)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            
        ]);

        $user = User::findOrFail($id);

        // dd($user);

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        // password is hashed in the model, rol als foreign key naar roles opgesaan als role_id, phone, birthdate, address_street, address_nr, address_city, address_zipcode,

        // hash the password
        // $user->password = bcrypt($request->input('password'));
        $user->lidnummer = $request->input('lidnummer');
        $user->role()->associate($request->input('role'));
        $user->phone = $request->input('phone');
        $user->birthdate = $request->input('birthdate');
        $user->address_street = $request->input('street');
        $user->address_nr = $request->input('nr');
        $user->address_zipcode = $request->input('zipcode');
        $user->address_city = $request->input('city');

        $user->save();

        return redirect()->route('admin.users')->with('success', 'User updated successfully.');

    }

    public function showUser($id)
    {
        $navItems = $this->navItems;

        $user = User::findOrFail($id);

        return view('admin.users.show', compact('user', 'navItems'));
    }

    public function exports()
    {
        $navItems = $this->navItems;

        return view('admin.exports.index', compact('navItems'));
    }

    // een function die de orders exporteert van een filter met van-tot naar een excel bestand
    public function exportOrders(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'van' => 'required|date',
            'tot' => 'required|date',
        ]);

        $fromDate = $request->input('van');
        $toDate = $request->input('tot');

        // dd($from, $to);
        $formattedFromDate = Carbon::parse($fromDate)->format('Y-m-d');
        $formattedToDate = Carbon::parse($toDate)->format('Y-m-d');
        
        $filename = 'orders-' . $formattedFromDate . '-' . $formattedToDate . '.xlsx';
    
        return Excel::download(new ExportClass($fromDate, $toDate), $filename);

        return redirect()->back()->with('success', 'Orders exported successfully.');
    }
    
    public function rings()
    {
        $navItems = $this->navItems;

        $rings = Ring::all();

        return view('admin.rings.index', compact('navItems', 'rings'));
    }

    public function createRing()
    {
        $navItems = $this->navItems;

        // haal de ringtypes op
        $types = Type::all();

        return view('admin.rings.create', compact('navItems', 'types'));
    }

    public function storeRing(Request $request)
    {
        // size, type, price
        $request->validate([
            'size' => 'required|string|max:255',
            'type' => 'required|numeric',
            'price' => 'required|string|max:255',
        ]);

        // dd($request->all());

        $ring = new Ring();

        $ring->size = $request->input('size');
        $ring->type_id = $request->input('type');
        $ring->price = $request->input('price');
        $ring->created_at = Carbon::now();
        $ring->updated_at = Carbon::now();

        $ring->save();

        //  redirect naar rings.index
        return redirect()->route('admin.rings')->with('success', 'Ring created successfully.');
    }

    public function editRing($id)
    {
        $navItems = $this->navItems;

        $ring = Ring::findOrFail($id);
        $types = Type::all();

        return view('admin.rings.edit', compact('navItems', 'ring', 'types'));
    }

    public function updateRing(Request $request, $id)
    {
        $request->validate([
            'size' => 'required|string|max:255',
            'type' => 'required|numeric',
            'price' => 'required|string|max:255',
        ]);

        // dd($request->all());

        $ring = Ring::findOrFail($id);

        $ring->size = $request->input('size');
        $ring->type_id = $request->input('type');
        $ring->price = $request->input('price');
        $ring->updated_at = Carbon::now();

        $ring->save();

        return redirect()->route('admin.rings')->with('success', 'Ring updated successfully.');
    }

    public function deleteRing($id)
    {
        $ring = Ring::findOrFail($id);

        $ring->delete();

        return redirect()->route('admin.rings')->with('success', 'Ring deleted successfully.');
    }

    public function orders()
    {
        $navItems = $this->navItems;

        // desc
        $orders = Order::orderBy('created_at', 'desc')->get();

        return view('admin.orders.index', compact('navItems', 'orders'));
    }

    public function showOrder($id)
    {
        $navItems = $this->navItems;

        // order with orderItems
        $order = Order::with('orderItems')->findOrFail($id);

        $rings = Ring::all();


        return view('admin.orders.show', compact('navItems', 'order', 'rings'));
    }

    public function editOrder($id)
    {
        $navItems = $this->navItems;

        $order = Order::findOrFail($id);

        return view('admin.orders.edit', compact('navItems', 'order'));
    }

    public function updateOrder(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string|max:255',
            'admin_remarks' =>  'nullable|string|max:500',
        ]);

        $order = Order::findOrFail($id);

        $order->status = $request->input('status');
        $order->admin_remarks = $request->input('admin_remarks');

        $order->save();

        return redirect()->route('admin.orders')->with('success', 'Order updated successfully.');
    }

    public function deleteOrder($id)
    {
        $order = Order::findOrFail($id);

        $order->delete();

        return redirect()->back()->with('success', 'Order deleted successfully.');
    }


}
