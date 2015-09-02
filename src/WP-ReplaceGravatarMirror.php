<?php

/**
 * Plugin Name: WP-ReplaceGravatarMirror
 * Plugin URI:  https://github.com/limccn/WP-ReplaceGravatarMirror
 * Description: This plugin can helps your wordpress blog replace its default gravatar provider(gravatar.com) to a third-part gravatar mirror(duoshuo.com) which can be load faster in somewhere.
 * Author:      limc
 * Author URI:  http://www.lidaren.com/
 * Version:     1.1
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
        if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on')
        {
            add_filter('get_avatar', array($this,'replace_gravatar_to_ssl'), 10, 3);
        }else
        {
            add_filter('get_avatar', array($this,'replace_gravatar_to_duoshuo'), 10, 3);
        }
    }


    /**
     * Use DuoShuo's gravatar mirror to replace Gravatar's.
     * Simplely replace from "*.gravatar.com" to "gravatar.duoshuo.com".
     *
     * @param $avatar
     * @return mixed
     */
    public function replace_gravatar_to_duoshuo($avatar)
    {
        $avatar = str_replace(array('www.gravatar.com','0.gravatar.com','1.gravatar.com','2.gravatar.com','s.gravatar.com'),'gravatar.duoshuo.com',$avatar);
        return $avatar;
    }

    /**
     * Use https gravatar server to replace none-https.
     * Simplely replace from "http://*.gravatar.com" to "https://secure.gravatar.com".
     *
     * @param $avatar
     * @return mixed
     */
    public function replace_gravatar_to_ssl($avatar)
    {
        $avatar = preg_replace('/.*\/avatar\/(.*)\?s=([\d]+)&.*/','<img src="https://secure.gravatar.com/avatar/$1?s=$2" class="avatar avatar-$2" height="$2" width="$2">',$avatar);
   
        return $avatar;
    }
}
/**
 * bootstrap
 */
new WP_Replace_Gravatar_Mirror;
