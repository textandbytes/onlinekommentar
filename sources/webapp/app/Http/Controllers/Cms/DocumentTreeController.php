<?php

namespace App\Http\Controllers\Cms;

use App\Models\DocumentTree;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Inertia\Inertia;

class DocumentTreeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      
      // Select all document records including root document (id 1)
      // which is needed for the recursiv calls in the vue components
      $aDocumentTree = DocumentTree::prepareTreeData(
                           DocumentTree::select('id', 'parent_id', 'label_de AS label', 'node_type')
                           ->where('id', '>', '0')
                           ->orderBy('parent_id')->orderBy('sort')
                           ->get()
                           ->toArray(),
                           null,
                           'leaf'
                       );

      return Inertia::render('DocumentTree', 
                             ['documentTree' => array_shift($aDocumentTree)]
                            );
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DocumentTree  $documentTree
     * @return \Illuminate\Http\Response
     */
    public function show(DocumentTree $documentTree)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DocumentTree  $documentTree
     * @return \Illuminate\Http\Response
     */
    public function edit(DocumentTree $documentTree)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DocumentTree  $documentTree
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DocumentTree $documentTree)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DocumentTree  $documentTree
     * @return \Illuminate\Http\Response
     */
    public function destroy(DocumentTree $documentTree)
    {
        //
    }
}
