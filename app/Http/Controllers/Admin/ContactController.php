<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AdminContact;

class ContactController extends Controller
{
    // Menampilkan form edit kontak admin
    public function edit()
    {
        // Ambil data pertama, jika belum ada buat baris kosong otomatis
        $contact = AdminContact::first() ?? new AdminContact();
        return view('admin.contacts.edit', compact('contact'));
    }

    // Menyimpan / memperbarui data kontak
    public function update(Request $request)
    {
        $request->validate([
            'phone' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:255',
            'instagram' => 'nullable|string|max:255',
            'facebook' => 'nullable|string|max:255',
        ]);

        $contact = AdminContact::first() ?? new AdminContact();
        $contact->fill($request->all());
        $contact->save();

        return redirect()->back()->with('success', 'Kontak admin berhasil diperbarui!');
    }
}