<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'admin';
$route['mingo/import'] = 'mingo/import';
$route['organizer'] = 'mingo/organizer';
$route['organizer-play'] = 'mingo/organizer_play';
$route['updateplay'] = 'mingo/updateplay';
$route['end-game'] = 'mingo/endgame';
$route['player'] = 'mingo/player';
$route['player-song-list'] = 'mingo/player_song_list';
$route['checksong'] = 'mingo/checksong';
$route['board'] = 'mingo/board';
$route['get_random'] = 'mingo/get_random';
$route['host-gamestart'] = 'mingo/host_gamestart';
$route['get_song_detail'] = 'mingo/get_song_detail';
$route['next_play'] = 'mingo/next_play';
$route['end_game_host'] = 'mingo/end_game_host';
$route['get_random_id'] = 'mingo/get_random_id';
$route['entergame'] = 'mingo/entergame';
$route['get_player_song_list'] = 'mingo/get_player_song_list';
$route['check_song'] = 'mingo/check_song';
$route['exit_game_player'] = 'mingo/exit_game_player';
$route['dashboard'] = 'admin/dashboard';
$route['songlist'] = 'admin/songlist';
$route['songlist/(:num)'] = 'admin/songlist/$1';
$route['delete-song/(:num)'] = 'admin/delete_song/$1';
$route['password'] = 'admin/psw';
$route['edit-psw/(:num)'] = 'admin/edit_psw/$1';
$route['listpsw'] = 'admin/listpsw';
$route['logout'] = 'admin/logout';
$route['delete-psw/(:num)'] = 'admin/delete_psw/$1';
$route['add-song'] = 'admin/add_song';
$route['edit-song/(:num)'] = 'admin/edit_song/$1';
$route['adminlist'] = 'admin/adminlist';
$route['adminlist/(:num)'] = 'admin/adminlist/$1';
$route['add-admin'] = 'admin/add_admin';
$route['edit-admin/(:num)'] = 'admin/edit_admin/$1';
$route['delete-admin/(:num)'] = 'admin/delete_admin/$1';
/* my new route for geting the song by id */
$route['get-song-by-id'] = 'admin/get_song_by_id';

$route['change-password'] = 'admin/change_password';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
