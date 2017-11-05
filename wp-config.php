<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'gonecocoanuts_wordpress');

/** MySQL database username */
define('DB_USER', 'jim8eam');

/** MySQL database password */
define('DB_PASSWORD', '@Bingo123');

/** MySQL hostname */
define('DB_HOST', '');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

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
define('AUTH_KEY',         'Sa_Hw!CR2!+cCEj&uLt[e!QT]kfpKVH~l zch}B*X,T~A8Ck[46aCl44o NMq*=}');
define('SECURE_AUTH_KEY',  '?M=fF|X8s7uexpcsXfpRMBKTWCh*XqP%G ;rLQ8lR[$~,D~.56usH COK|Jcn/`Q');
define('LOGGED_IN_KEY',    'qY(~CNgOI8<cB4Ew:-[Y[wrD4(bk6jVQv$g%|;AgmrG|hV0.`zu3;uabUV3]/.!U');
define('NONCE_KEY',        '40a&K9q2z9vTym[_]Hf-cUgH~{? |zB|_rJ7cfD#`lSgqSyDqg=_bsbfkzU@H)MW');
define('AUTH_SALT',        ';Y*v<*ubWa4]#H5$*3z8p=FNYgDebDqwI[k->&8nAU_6Z5ba2]xpS*[F1!Za{M$P');
define('SECURE_AUTH_SALT', 'qnXS`;b`Usi1@8|!6%`kg#Tbw,>b}+9~HWbLf%V<X/DWZ):w?b!^{uTZ|e:^XG,$');
define('LOGGED_IN_SALT',   'L?YBCwbp>1XZU!)!$rk=k]QwTdjJ0TW/&KW gzU+|+$qpOHM{sNP2!JvCCAoew=^');
define('NONCE_SALT',       '2h/%jKb[u}cRn:I s+y#DersAq]+Fwni*on|HB+e =d^MOd@3tH_4W{zbTzW$k$l');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
