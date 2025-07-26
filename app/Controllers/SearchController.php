<?php

namespace App\Controllers;

use App\Models\ProductModel;

class SearchController extends BaseController
{
    public function index()
    {
        helper('form');
        
        $query = $this->request->getPost('query');

        $productModel = new ProductModel();
        $results = $productModel
                    ->like('nama', $query)
                    ->findAll();

        return view('v_search', [
            'product' => $results,
            'query' => $query
        ]);
    }
}