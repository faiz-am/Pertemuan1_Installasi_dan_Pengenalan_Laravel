<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $menu = Menu::query()
            ->when($request->q, function ($query) use ($request) {
                $query->where('menu_Text', 'like', '%' . $request->q . '%')
                      ->orWhere('menu_url', 'like', '%' . $request->q . '%');
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('dashboard.menu.index', [
            'menu' => $menu,
            'q' => $request->q,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.menu.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'menu_text' => 'required|string|max:255',
            'menu_icon' => 'nullable|string',
            'menu_url' => 'required|string|max:255',
            'menu_order' => 'required|string|max:255',
            'status' => 'required|in:active,inactive',
        ]);

        if($request->status === 'active') {
            Menu::where('status', 'active')->update(['status' => 'inactive']);
        }

        $menu = new Menu();
        $menu->menu_text = $request->menu_text;
        $menu->menu_icon = $request->menu_icon;
        $menu->menu_url = $request->menu_url;
        $menu->menu_order = $request->menu_order;
        $menu->status = $request->has('status') ? 'active' : 'inactive';;
        $menu->save();

        return redirect()->route('menu.index')->with('successMessage', 'Menu created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $menu = Menu::findOrFail($id);
        return view('dashboard.menu.show', compact('menu'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $menu = Menu::findOrFail($id);
        return view('dashboard.menu.edit', compact('menu'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'menu_text' => 'required|string|max:255',
            'menu_icon' => 'nullable|string',
            'menu_url' => 'required|string|max:255',
            'menu_order' => 'required|string|max:255',
            'status' => 'required|in:active,inactive',
        ]);

        if($request->status === 'active') {
            Menu::where('status', 'active')->update(['status' => 'inactive']);
        }

        $menu = Menu::findOrFail($id);
        $menu->update($request->all());

        return redirect()->route('menu.index')->with('successMessage', 'Menu updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $menu = Menu::findOrFail($id);
        $menu->delete();

        return redirect()->route('menu.index')->with('success', 'Menu deleted successfully.');
    }
}
