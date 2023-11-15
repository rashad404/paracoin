<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Menu extends Model
{
    use HasFactory;

    protected $attributes = [
        'status' => true,
        'position' => 0,
    ];

    public $timestamps = false;

    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    public function childmenu()
    {
        return $this->hasMany(self::class, 'parent_id')
            ->select('name', 'url', 'description', 'icon', 'parent_id', 'id')->where('status', 1);
    }

    public static function getItems()
    {
        // $sql = DB::table('tbl_user')->get();

        $rows = DB::select('select `name`, `url`, `parent_id` from menus where status = ? order by `position` ASC', [1]);
        return $rows;
    }

    public static function getList()
    {
        $return = self::select('name', 'url', 'parent_id', 'id', 'icon')
            ->where('status', 1)
            ->where('parent_id', null)
            ->orderBy('position', 'ASC')->with('childmenu')
            ->get();

        return $return;
    }


    public static function checkActiveNav($nav)
    {
        if (isset($_SERVER['REDIRECT_URL'])) {
            $urlSlug = $_SERVER['REDIRECT_URL'];
        } else {
            $urlSlug = '';
        }

        $nav = str_replace('/', '', $nav);

        if (preg_match("/\/az|en|ru\//i", $urlSlug)) {
            $urlSlug = substr($urlSlug, 3);
        }

        $urlSlug = str_replace('/', '', $urlSlug);

        if (empty($nav) && strlen($urlSlug) < 4) {
            return " active";
        } elseif (!empty($nav) && $nav == $urlSlug) {
            return " active";
        } else {
            return '';
        }
    }
}
