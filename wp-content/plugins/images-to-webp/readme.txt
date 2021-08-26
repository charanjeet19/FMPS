=== Images to WebP ===
Contributors: kubiq
Donate link: https://www.paypal.me/jakubnovaksl
Tags: webp, images, pictures, optimize, convert, media
Requires at least: 3.0.1
Requires PHP: 5.6
Tested up to: 5.7
Stable tag: 1.8
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Convert PNG, JPG and GIF images to WebP and speed up your web


== Description ==

Statistics say that WebP format can save over a half of the page weight without losing images quality.
Convert PNG, JPG and GIF images to WebP and speed up your web, save visitors download data, make your Google ranking better.

<ul>
	<li><strong>automated test after plugin activation to make sure it will work on your server</strong></li>
	<li><strong>works with all types of WordPress installations: domain, subdomain, subdirectory, multisite/network</strong></li>
	<li><strong>works on Apache and NGiNX</strong></li>
	<li><strong>image URL will be not changed</strong> so it works everywhere, in &lt;img&gt; src, srcset, &lt;picture&gt;, even in CSS backgrounds and there is no problem with cache</li>
	<li><strong>original files will be not touched</strong></li>
	<li>set quality of converted images</li>
	<li>auto convert on upload</li>
	<li>only convert image if WebP filesize is lower than original image filesize</li>
	<li>bulk convert existing images inside /wp-content/ folders to WebP ( you can choose folders )</li>
	<li>bulk convert only missing images</li>
	<li>works with `Fly Dynamic Image Resizer` plugin</li>
</ul>

## Hooks for developers

#### itw_extensions
Maybe you want to support also less famous JPEG extension like jpe, jfif or jif

`add_filter( 'itw_extensions', 'extra_itw_extensions', 10, 1 );
function extra_itw_extensions( $extensions ){
	$extensions[] = 'jpe';
	$extensions[] = 'jfif';
	$extensions[] = 'jif';
	return $extensions;
}`

#### itw_sizes
Maybe you want to disable WebP for thumbnails

`add_filter( 'itw_sizes', 'disable_itw_sizes', 10, 2 );
function disable_itw_sizes( $sizes, $attachmentId ){
	unset( $sizes['thumbnail'] );
	return $sizes;
}`

#### itw_htaccess
Maybe you want to modify htaccess rules somehow

`add_filter( 'itw_htaccess', 'modify_itw_htaccess', 10, 2 );
function modify_itw_htaccess( $rewrite_rules ){
	// do some magic here
	return $rewrite_rules;
}`

#### iwt_disabled_folders
Maybe you want to disable/enable some other folders for bulk convert

`add_filter( 'iwt_disabled_folders', 'modify_iwt_disabled_folders', 10, 1 );
function modify_iwt_disabled_folders( $disabled ){
	// do some magic here
	return $disabled;
}`

#### $images_to_webp->convert_image()
Maybe you want to automatically generate WebP for other plugins

`add_action( 'XXPLUGIN_image_created', 'XX_images_to_webp', 10, 2 );
function XX_images_to_webp( $image_path ){
	global $images_to_webp;
	$images_to_webp->convert_image( $image_path );
}`


== Installation ==

1. Upload `images-to-webp` directory to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress


== Frequently Asked Questions ==

= Plugin requirements =

It should work almost everywhere ;)
PHP 5.6 or higher
GD or Imagick extension with WebP support
Enabled serve modules: `mod_mime`, `mod_rewrite`

= WebP images stored location =

WebP images are generated in same directory as original image. Example:
original img: `/wp-content/uploads/2019/11/car.png`
webp version: `/wp-content/uploads/2019/11/car.png.webp`

= How to check if plugin works? =

When you have installed plugin and converted all images, follow these steps:

1. Run `Google Chrome` and enable `Dev Tools` (F12).
2. Go to the `Network` tab click on `Disable cache` and select filtering for `Img` *(Images)*.
3. Refresh your website page.
4. Check list of loaded images. Note `Type` column.
5. If value of `webp` is there, then everything works fine.

= Apache .htaccess =

Plugin should automatically update your .htaccess with needed rules.
In case it's not possible to write them automatically, screen with instructions will appear.
Anyway, here is how it should look like:

`<IfModule mod_mime.c>
	AddType image/webp .webp
</IfModule>

<IfModule mod_rewrite.c>
	RewriteEngine On
	RewriteCond %{HTTP_ACCEPT} image/webp
	RewriteCond %{REQUEST_FILENAME} "/wp-content/"
	RewriteCond %{REQUEST_FILENAME} "\.(jpg|jpeg|png|gif)$"
	RewriteCond %{REQUEST_FILENAME}\.webp -f
	RewriteRule ^(.+)$ $1\.webp [NC,T=image/webp,E=webp,L]
</IfModule>`

= NGiNX config =

After you activate plugin, screen with instructions will appear.
Anyway, here is how it should look like:

You need to add this before your other mapping ( eg. nginx.conf )

`map $http_accept $webp_suffix{
		default "";
	"~*webp" ".webp";
}`

then you need to add this before your other locations ( eg. site.conf )

`location ~* ^/wp-content/.+\.(png|gif|jpe?g)$ {
	add_header Vary Accept;
	try_files $uri$webp_suffix $uri =404;
}`


== Changelog ==

= 1.8 =
* Tested on WP 5.7
* add more CURL options
* fix backslashes for localhosts

= 1.7 =
* Tested on WP 5.6
* fixed problem on some multisites

= 1.6 =
* Tested on WP 5.4
* added support for Fly Dynamic Image Resizer plugin

= 1.5 =
* notice when test image is not accessible

= 1.4 =
* new test method

= 1.3 =
* fixed text domain for translations

= 1.2 =
* added instructions for NGiNX

= 1.1 =
* make it works in multisite and subdirectory installs

= 1.0 =
* First version