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

}
