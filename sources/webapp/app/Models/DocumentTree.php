<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentTree extends Model
{
    use HasFactory;

    protected $table = 'document_tree';

    public function parent()
    {
        return $this->belongsTo(DocumentTree::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(DocumentTree::class, 'parent_id');
    }

   /**
     * Prepare tree data recursively
     *
     * @param array  $aItems    - data to prepare
     * @param int    $iParentId - 1 is the id of the root node
     *                            call method with $iParentId null 
     *                            to include root node
     *
     * @return array $aTree
     */
    protected static function prepareTreeData(array $aItems, $iParentId = 1)
    {
      $aTree = [];

      // Loop through the items
      foreach ($aItems as $aItem) {

        // The parent id of the item matches the current $iParentId
        if ((int) $aItem['parent_id'] == $iParentId) {
          
          // Call the function recursively, use the item's id as the parent's id
          // The function returns the list of children as an array or an empty array
          $aChildren = Self::prepareTreeData($aItems, $aItem['id']);

          // Children array is not empty
          if (count($aChildren) > 0) {

            // Store all children of the current item
            $aItem['children'] = $aChildren;
          }

          // Fill the output
          $aTree[] = $aItem;
        }
    
      }

      return $aTree;
    }

}
