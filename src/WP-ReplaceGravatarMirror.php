<?php

/**
 * Plugin Name: WP-ReplaceGravatarMirror
 * Plugin URI:  https://github.com/limccn/WP-ReplaceGravatarMirror
 * Description: This plugin can helps your wordpress blog replace its default gravatar provider(gravatar.com) to a
 *              third-part gravatar mirror(duoshuo.com) which can be load faster in somewhere.
 * Author:      limc
 * Author URI:  http://www.lidaren.com/
 * Version:     1.0
 * License:     GPL 2.0
 */

/**
 * Silence is golden
 */
if (!defined('ABSPATH')) exit;

class WP_Replace_Gravatar_Mirror
{

    /**
     * init Hook
     *
     */
    public function __construct()
    {
        add_filter('get_avatar', array($this, 'replace_gravatar_to_duoshuo'), 10, 3);
    }


    /**
     * Use DuoShuo's gravatar mirror to replace Gravatar's.
     * Simplely replace from "*.gravatar.com" to "gravatar.duoshuo.com".
     *
     * @param $text
     * @return mixed
     */
    public function replace_gravatar_to_duoshuo($text)
    {
        $avatar = str_replace(array("www.gravatar.com"
                                    "0.gravatar.com",
                                    "1.gravatar.com",
                                    "2.gravatar.com",
                                    "s.gravatar.com"),
                              "gravatar.duoshuo.com",
                              $avatar);
        return $avatar;
    }
}

/**
 * bootstrap
 */
new WP_Replace_Gravatar_Mirror;