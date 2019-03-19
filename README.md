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
4. Add the code provided below in your themes __functions.php__ file or in your plugin's __main/index__ file. 
```php
/**
 * Metabox Options
 */
require_once 'Dilaz-Metaboxes-Options/metabox.php';
```
5. Open ```Dilaz-Metabox-Options``` folder and rename ```config-sample.php``` to ```config.php```.
6. Open ```Dilaz-Metabox-Options/config.php``` and edit the parameters as you want. Simple guidelines are provided beside each parameter setting.
7. Open ```Dilaz-Metabox-Options/options``` folder and rename ```options-sample.php``` to ```options.php```.
8. Open ```Dilaz-Metabox-Options/options/options.php``` and add your metabox options. 

***

__NOTE:__
1. ```Dilaz-Metabox-Options/custom-options-sample.php``` contains examples that show how to use actions hooks to add custom metabox option fields to any Dilaz Metabox implementation.
2. ```Dilaz-Metabox-Options/default-options.php``` contains default options as examples for all possible metabox fields.



***

## *config.php* parameters

| Parameter     | Type          | Since (Dilaz Metabox)  | Details |
| :------------- |:----------| :-------------| :----- |
| `prefix`   | *string* | v2.5.1 | Used to save settings. Must be unique. |
| `use_type` | *string* | v2.5.1 | Where the panel is used. Enter `theme` if used within a theme OR `plugin` if used within a plugin. |
| `default_options` | *boolean* | v2.5.1 | Whether to load default options. |
| `custom_options` | *boolean* | v2.5.1 | Whether to load custom options. |
   
