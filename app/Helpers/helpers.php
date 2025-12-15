<?php

if (! function_exists('clear_data')) {
    /**
     * Функция очищает код от возможных иньекций и взломов
     *
     * @param $data
     * @return mixed
     */
    function clear_data($data)
    {
        $hackBlackList = ['--', 'drop', ';', '#', '/*', '*/', 'version()', 'concat', 'extract'];

        foreach ($hackBlackList as $term) {
            if (strstr($data, $term)) {
                return '';
            }
        }

        return addslashes(stripslashes(htmlspecialchars(strip_tags($data))));
    }
}

function clearData($data)
{
    return clear_data($data);
}




if (! function_exists('img_size')) {
    /**
     * @param  string img
     * @param  int width
     * @param  int height
     * @return array
     */
    function img_size($img, $width = 100, $height = 100)
    {
        $img = str_replace('https://finance.ru/', '', $img);
        if (file_exists(public_path().'/'.$img)) {
            $data = getimagesize(public_path() .'/'. $img);
            $width = $data[0];
            $height = $data[1];
        }

        return [
            'width' => $width,
            'height' => $height
        ];
    }
}




if (! function_exists('empty_str_to_null')) {
    /**
     *
     * @return mixed
     */
    function empty_str_to_null($data)
    {
        if (is_array($data)) {
            foreach ($data as $key => $value) {
                if($value == '') {
                    $data[$key] = null;
                }
            }

        } elseif (gettype($data) == 'string') {
            if ($data == '') {
                $data = null;
            }
        }

        return $data;
    }
}

function includeComponent(string $component, int $inFirstOrder = 0) : void
{
    if (!isset($GLOBALS['m'])) {
        $GLOBALS['m'] = [];
        $GLOBALS['m']['first_order'] = [];
        $GLOBALS['m']['default_order'] = [];
    }

    $isInArray = false;
    if (in_array($component, $GLOBALS ['m']['default_order'])) {
        foreach ($GLOBALS ['m']['default_order'] as $k => $item) {
            if ($item == $component) {
                $isInArray = true;
                unset($GLOBALS ['m']['default_order'][$k]);
            }
        }
    }

    if (in_array($component, $GLOBALS ['m']['first_order'])) {
        foreach ($GLOBALS ['m']['first_order'] as $k => $item) {
            if ($item == $component) {
                $isInArray = true;
                unset($GLOBALS ['m']['first_order'][$k]);
            }
        }
    }

    if ($inFirstOrder) {
        $GLOBALS['m']['first_order'] [] = $component;
    } else {
        $GLOBALS['m']['default_order'] [] = $component;
    }


    if (!$isInArray) {
        $htmlFile = $component . '/index.blade.php';
        if (file_exists(resource_path('views/design-system/v4/') . $htmlFile)) {
            view('design-system.v4.' . $component . '.index')->render();
        }
    }

//    if (!in_array($component, $GLOBALS ['m']['default_order'])) {
//        if ($inFirstOrder) {
//            $GLOBALS['m']['first_order'] [] = $component;
//        } else {
//            $GLOBALS['m']['default_order'] [] = $component;
//        }
//
//        $htmlFile = $component . '/index.blade.php';
//        if (file_exists(resource_path('views/design-system/v4/') . $htmlFile)) {
//            view('design-system.v4.' . $component . '.index')->render();
//        }
//    }
}


function includeComponentSite(string $component, int $inFirstOrder = 0, array $variables = []) : void
{
    if (!isset($GLOBALS['m'])) {
        $GLOBALS['m'] = [];
        $GLOBALS['m']['first_order'] = [];
        $GLOBALS['m']['default_order'] = [];
    }

    $isInArray = false;
    if (in_array($component, $GLOBALS ['m']['default_order'])) {
        foreach ($GLOBALS ['m']['default_order'] as $k => $item) {
            if ($item == $component) {
                $isInArray = true;
                unset($GLOBALS ['m']['default_order'][$k]);
            }
        }
    }

    if (in_array($component, $GLOBALS ['m']['first_order'])) {
        foreach ($GLOBALS ['m']['first_order'] as $k => $item) {
            if ($item == $component) {
                $isInArray = true;
                unset($GLOBALS ['m']['first_order'][$k]);
            }
        }
    }

    if ($inFirstOrder) {
        $GLOBALS['m']['first_order'] [] = $component;
    } else {
        $GLOBALS['m']['default_order'] [] = $component;
    }


    if (!$isInArray) {
        $htmlFile = $component . '/index.blade.php';
        if (file_exists(resource_path('views/site/v4/') . $htmlFile)) {
            view('site.v4.' . $component . '.index')->with($variables)->render();
        }
    }
}


if (! function_exists('compressCSS')) {
    /**
     * @param string $s
     * @return string
     */
    function compressCSS(string $s) : string
    {
        $s = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $s);
        return str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $s);
    }
}


if (! function_exists('emptyDataToNull')) {
    /**
     *
     * @return mixed
     */
    function emptyDataToNull($data)
    {
        if (is_array($data)) {
            foreach ($data as $key => $value) {
                if($value == '') {
                    $data[$key] = null;
                }
            }

        } elseif (gettype($data) == 'string') {
            if ($data == '') {
                $data = null;
            }
        }

        return $data;
    }
}

if (! function_exists('is_admin')) {
    /**
     * Проверяет, является ли текущий пользователь админом
     *
     * @param int|null $userId ID пользователя (если null, берется текущий авторизованный)
     * @return bool
     */
    function is_admin(?int $userId = null): bool
    {
        if ($userId === null) {
            if (!auth()->check()) {
                return false;
            }
            $userId = auth()->id();
        }

        $adminIds = config('admins', []);
        return in_array($userId, $adminIds);
    }
}
