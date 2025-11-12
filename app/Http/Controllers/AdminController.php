<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller {
    public function admin() {
        return view('admin.dashboard');
    }
    public function authenticate(Request $request) {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->route('admin.dashboard');
        }
        return back()->withErrors(['error' => 'Invalid credentials']);
    }
    // public function dashboard() {
    //     return view('admin.dashboard');
    // }
    // public function manageUsers() {
    //     return view('admin.users');
    // }
    // public function manageProducts() {
    //     return view('admin.products');
    // }
    // public function manageAffiliateLinks() {
    //     return view('admin.affiliate_links');
    // }
    // public function checkOrders() {
    //     return view('admin.orders');
    // }

    // public function Transactions() {
    //     return view('admin.transactions');
    // }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}