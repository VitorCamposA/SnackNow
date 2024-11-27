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
        Category::where('supplier_id', auth()->id())->each(function ($category) {
            $category->items()->delete();
            $category->delete();
        });

        $categories = $request->input('categorias', []);
        foreach ($categories as $categoryData) {
            $category = Category::create([
                'name' => $categoryData['nome'],
                'supplier_id' => auth()->id(),
            ]);

            foreach ($categoryData['itens'] ?? [] as $itemData) {
                $category->items()->create([
                    'name' => $itemData['nome'],
                    'price' => $itemData['preco'],
                ]);
            }
        }

        return redirect()->back()->with('success', 'Cardápio salvo com sucesso!');
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
