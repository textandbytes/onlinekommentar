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

    public function commentaries()
    {
        return $this->hasMany(Commentary::class, 'document_id', 'id');
    }

   /**
     * Prepare tree data recursively
     *
     * @param array  $aItems    - data to prepare
     * @param int    $iParentId - 1 is the id of the root node
     *                            call method with $iParentId null 
     *                            to include root node
     * @param string $sNodeTypeToCount – 'leaf', 'node' or ''
     *                                   empty string == no counting
     * 
     *
     * @return array $aTree
     */
    protected static function prepareTreeData(array $aItems, $iParentId = 1, $sNodeTypeToCount = '')
    {
      $aTree = [];

      // Loop through the items
      foreach ($aItems as $aItem) {

        // The parent id of the item matches the current $iParentId
        if ((int) $aItem['parent_id'] == $iParentId) {

          // Call the function recursively, use the item's id as the parent's id
          // The function returns the list of children as an array or an empty array
          $aChildren = Self::prepareTreeData($aItems, $aItem['id'], $sNodeTypeToCount);

          // Children array is not empty
          if (count($aChildren) > 0) {

            // Count all elements of type $sNodeTypeToCount 
            // in the current part of tree
            $i = 0;
            foreach ($aChildren as $aChild) {
              // count child if it has node_type  $sNodeTypeToCount
              if ($aChild['node_type'] == $sNodeTypeToCount) {
                $i++;
              }
              // add sum of all child and child-child-... elements
              if (isset($aChild['element_count'])) {
                $i = $i + $aChild['element_count'];
              }
            }
            $aItem['element_count'] = $i;

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
