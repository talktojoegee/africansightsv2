<?php

namespace App\View;

use App\Models\PostCategory;

class DynamicMenu {
    /**
     * Get menu items
     *
     * @param void
     * @return EloquentCollection
     */
    public static function getPrimaryMenu()
    {
        return PostCategory::where('is_primary', 1)->get();
    }
}
