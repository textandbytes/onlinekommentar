<?php

namespace App\Http\Controllers\Frontend;

use App\Models\DocumentTree;
use App\Http\Controllers\Controller;

class DocumentTreeController extends Controller
{
    /**
     * Returns document tree in JSON format for display in frontend sidebar.
     *
     * @return DocumentTree as JSON
     */
    public function index()
    {
      
      // Select all document records including root document (id 1)
      // which is needed for the recursive calls in the vue components
      $aDocumentTree = DocumentTree::prepareTreeData(
                           DocumentTree::select('id', 'parent_id', 'label_de AS label', 'node_type')
                           ->where('id', '>', '0')
                           ->orderBy('parent_id')->orderBy('sort')
                           ->get()
                           ->toArray(),
                           null,
                           'leaf'
                       );

      return response()->json(array_shift($aDocumentTree));
    }

}
