# Dilaz Metabox Options
This helps you to integrate [Dilaz Metabox Plugin](https://github.com/Rodgath/Dilaz-Metabox-Plugin) into your WordPress theme/plugin development. 

## How to use
1. Download and install [Dilaz Metabox](https://github.com/Rodgath/Dilaz-Metabox-Plugin/archive/master.zip) plugin.
2. Download [Dilaz Metabox Options](https://github.com/Rodgath/Dilaz-Metabox-Options/archive/master.zip).
3. Add *Dilaz-Metabox-Options* to the root directory of your theme or plugin. <br />
   i) For example: <br />
      > *wp-content/__theme-name__/Dilaz-Metabox-Options*
      
      __OR__
      
      > *wp-content/__plugin-name__/Dilaz-Metabox-Options* <br />
      
   ii) You can optionally rename *Dilaz-Metabox-Options* folder.
4. Add the code provided below in your themes __functions.php__ file or in your plugin's main/index file. 
```php
/**
 * Metabox options
 */
require_once 'Dilaz-Metaboxes-Options/metabox.php';
```

   
