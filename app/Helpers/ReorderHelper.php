<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class ReorderHelper
{
    public static function tree_element($entry, $key, $all_entries, $label)
    {
        if (!isset($entry->tree_element_shown)) {
            // mark the element as shown
//            $all_entries[$key]->tree_element_shown = true;
            $entry->tree_element_shown = true;

            // show the tree element
            echo '<li id="list_' . $entry->getKey() . '">';
            echo '<div><span class="disclose"><span></span></span>' . object_get($entry, $label) . '</div>';

            // see if this element has any children
            $children = [];
            foreach ($all_entries as $key => $subentry) {
                if ($subentry->parent_id == $entry->getKey()) {
                    $children[] = $subentry;
                }
            }

            $children = collect($children)->sortBy('lft');

            // if it does have children, show them
            if (count($children)) {
                echo '<ol>';
                foreach ($children as $key => $child) {
                    $children[$key] = ReorderHelper::tree_element($child, $child->getKey(), $all_entries);
                }
                echo '</ol>';
            }
            echo '</li>';
        }

        return $entry;
    }

    public static function updateTreeOrder($request, $model)
    {
        $count = 0;
        $primaryKey = $model->getKeyName();

        DB::beginTransaction();
        foreach ($request as $key => $entry) {
            if ($entry['item_id'] != '' && $entry['item_id'] != null) {
                $item = $model->where($primaryKey, $entry['item_id'])->update([
                    'parent_id' => empty($entry['parent_id']) ? null : $entry['parent_id'],
                    'depth' => empty($entry['depth']) ? null : $entry['depth'],
                    'lft' => empty($entry['left']) ? null : $entry['left'],
                    'rgt' => empty($entry['right']) ? null : $entry['right'],
                ]);

                $count++;
            }
        }
        DB::commit();

        return $count;
    }

    public static function reorder($model, $label, $path, $max_num = 0)
    {

        $data = $model->select('id', $label, 'lft', 'parent_id')->orderBy('lft', 'ASC')->get();
        return view($path, get_defined_vars());

    }

    public static function saveReorder($all_entries, $model)
    {
        if (count($all_entries)) {
            $count = ReorderHelper::updateTreeOrder($all_entries, $model);
        } else {
            return false;
        }
        return 'success for '.$count.' items';
    }

    public static function reorderComponent($all_entries, $label) {
        $root_entries = $all_entries->filter(function ($item) {
            return $item->parent_id == 0;
        });
        foreach ($root_entries as $key => $entry) {

            $root_entries[$key] = \App\Helpers\ReorderHelper::tree_element($entry, $key, $all_entries, $label);
        }
    }

}
