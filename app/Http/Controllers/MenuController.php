<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\MenuItem;

class MenuController extends Controller
{
    /**
     * Exibe o cardápio de um fornecedor.
     *
     * @param int $supplierId
     * @return \Illuminate\View\View
     */
    public function index($supplierId)
    {
        $categories = Category::with('items')
            ->where('supplier_id', $supplierId)
            ->get();

        return view('menu.index', compact('categories'));
    }

    /**
     * Armazena o cardápio no banco de dados.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $categories = $request->input('categories', []);

        foreach ($categories as $categoryData) {
            $category = Category::create([
                'name' => $categoryData['name'],
                'supplier_id' => auth()->id(), // Associa ao fornecedor autenticado
            ]);

            foreach ($categoryData['items'] ?? [] as $itemData) {
                $category->items()->create([
                    'name' => $itemData['name'],
                    'price' => $itemData['price'],
                ]);
            }
        }

        return redirect()->back()->with('success', 'Cardápio salvo com sucesso!');
    }

    /**
     * Atualiza uma categoria ou item no cardápio.
     *
     * @param Request $request
     * @param int $categoryId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $categoryId)
    {
        $category = Category::findOrFail($categoryId);
        $category->update(['name' => $request->input('name')]);

        foreach ($request->input('items', []) as $itemData) {
            if (isset($itemData['id'])) {
                $item = MenuItem::findOrFail($itemData['id']);
                $item->update([
                    'name' => $itemData['name'],
                    'price' => $itemData['price'],
                ]);
            } else {
                $category->items()->create([
                    'name' => $itemData['name'],
                    'price' => $itemData['price'],
                ]);
            }
        }

        return redirect()->back()->with('success', 'Categoria atualizada com sucesso!');
    }

    /**
     * Exclui uma categoria ou item do cardápio.
     *
     * @param int $categoryId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($categoryId)
    {
        $category = Category::findOrFail($categoryId);
        $category->delete();

        return redirect()->back()->with('success', 'Categoria removida com sucesso!');
    }
}
