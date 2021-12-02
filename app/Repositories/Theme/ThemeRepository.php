<?php

namespace App\Repositories\Theme;

use App\Model\Clusters;
use App\Model\Themes;

class ThemeRepository
{

    public function getThemeList($params)
    {
        $themes = null;

        if ($params->search) {
            $themes = Themes::where('color', 'LIKE', "%$params->search%")->paginate($params->count);
        } else {
            $themes = Themes::paginate($params->count);
        }

        return $themes;
    }

    public function storeTheme($params)
    {

        $theme = new Themes();
        $theme->color = $params->color;
        $theme->hexCode = $params->hexCode;
        $theme->save();

        return $theme;
    }

    public function updateTheme($id, $params)
    {

        $theme = Themes::find($id);
        $theme->color = $params->color;
        $theme->hexCode = $params->hexCode;
        $theme->save();

        return $theme;
    }

    public function showTheme($id)
    {
        $theme = Themes::find($id);

        return $theme;
    }

    public function destroyTheme($id)
    {
        // 1. remove theme from clusters
        $clusters = Clusters::where('themeID', $id)->update(['themeID' => null]);

        // 2. remove theme from themes
        $theme = Themes::find($id)->delete();

        return $this;
    }
}
