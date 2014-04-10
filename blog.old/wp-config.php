<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'onsitecomputerconsulting');

/** MySQL database username */
define('DB_USER', 'onsitecomputerco');

/** MySQL database password */
define('DB_PASSWORD', 'yAzn!DWP');

/** MySQL hostname */
define('DB_HOST', 'nugtracker.onsitecomputerconsulting.net');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'ONRxDN`qHTD/9$VB8^+W5tJ~Vm#&3UL6PiO!vCRfi@4nFi(1Yv`!laFR)3j)^ja@');
define('SECURE_AUTH_KEY',  '#I/"EH8aDy!KsA)kU2j!#n)QTh%oUrgrs#N6`"L"UPQ`h&WK|FsNa^:RYi6gam&p');
define('LOGGED_IN_KEY',    '1%"RYWm?6gs3@&0)TuQLzVpY:iDXagjU_$RtqbFb&c`H5nu^MlbXj*V~)J8tKPGD');
define('NONCE_KEY',        '#j&Y;_;:VX&6GLe6~pq3zq2SE`LYQPoU3gSytg"B+Xz|ug%istCNI_75hM~;?Bx9');
define('AUTH_SALT',        'u7K7Pk8tuavXp7yE*mpt@/eCI#IRQmyZcpQl%l_pIc+WSXG?|dufo3FJ8Bq7ZE*1');
define('SECURE_AUTH_SALT', 'S`_8YUxoK!xJbnPycmqENAKoXxPsSjMP!pOzM$0))"I``2;J4|XP%crh%GhEP"pt');
define('LOGGED_IN_SALT',   'h3nIk:)EVWCSI0SJI%;*HF~%L_z?K%qKHH!50a?N(S)b1bViyO2~S&V4+9PSkn_N');
define('NONCE_SALT',       'Q^Y6Yi|eb8L~wkYVcXv@Hg98&RHo^~b*FG)uaS|m5@j$p!A4EbskT|zYOaOi*M)~');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_cqpa9u_';

/**
 * Limits total Post Revisions saved per Post/Page.
 * Change or comment this line out if you would like to increase or remove the limit.
 */
define('WP_POST_REVISIONS',  10);

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

