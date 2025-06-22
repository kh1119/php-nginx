<?php
define('mDB', true);
require_once('inc/config.php');
require_once('inc/cache.php');
require_once('inc/sql.php');
require_once('inc/api.php');
require_once('inc/function.php');
// require_once('inc/flood.php');
require_once('inc/setting.php');
$auth	=	filter($_REQUEST['auth']);
$id		=	filter($_REQUEST['id']);
$__['status']	=	0;
if ($auth == 'auth') {
	if ($_SESSION['uid']) {
		$__['status']	=	1;
		$__['uid']		=	$_SESSION['uid'];
		$__['uname']	=	$_SESSION['uname'];
		$__['umail']	=	$_SESSION['umail'];
		$__['vip']		=	$_SESSION['vip'];
		$__['viptime']	=	$_SESSION['viptime'];
		$__['vipdate']	=	($_SESSION['viptime']) ? date("Y/m/d H:i", $_SESSION['viptime']) : 0;
	}
} elseif ($auth == 'login') {
	$name			=	filter($_POST['name']);
	$password		=	filter($_POST['password']);
	$remember		=	intval($_POST['remember']);
	if ($name && $password) {
		$password	=	md5($password);
		$_arr		=	$api->call('user', [
			'action'	=>	'login',
			'data'		=>	['name' => $name, 'password' => $password]
		], 1);
		if ($_arr['status'] == 1) {
			if ($_arr['banned'] == 1) {
				$__['message']['name']	=	'Your account has been locked';
			} else {
				$__['status']	=	1;
				$__['message']	=	'Login Successful';
				//tạo phiên đăng nhập
				$whash	=	jcode($password, 'en', REMOTE_IP);
				$_SESSION['uid']		=	(int)$_arr['id'];
				$_SESSION['uname']		=	$_arr['name'];
				$_SESSION['umail']		=	$_arr['email'];
				$_SESSION['vip']		=	(int)$_arr['vip'];
				$_SESSION['viptime']	=	(int)$_arr['vip_time'];
				if ($remember) {
					setcookie("wid", $_arr['id'], NOW + (60 * 60 * 24 * 30), '/');
					setcookie("whash", $whash, NOW + (60 * 60 * 24 * 30), '/');
				}
			}
		} else {
			$__['message']['name']	=	'Incorrect account or password';
		}
	} else {
		$__['message']['name']	=	'Not enough information has been entered';
	}
}
//USER REGISTER
elseif ($auth == 'register') {
	$name			=	filter($_POST['name']);
	$email			=	filter($_POST['email']);
	$password		=	filter($_POST['password']);
	$repassword		=	filter($_POST['re-password']);
	if ($name && $email && $password && $repassword) {
		if (!preg_match('#([A-Za-z0-9\_]+)#', $name)) {
			$__['message']['name']	=	'Only accept characters: A-Z 0-9 _';
		} elseif (strlen($name) < 6 && strlen($name) > 16) {
			$__['message']['name']	=	'Account > 6-16 characters';
		}
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$__['message']['email']	=	'Email is wrong format';
		}
		if (strlen($password) < 6) {
			$__['message']['password']	=	'Password > 6 characters';
		} elseif ($password != $repassword) {
			$__['message']['re-password']	=	'Confirmation password is incorrect';
		}
		if (!$__['message']) {
			//check email và password DB
			$_arr	=	$api->call('user', [
				'action'	=>	'check',
				'data'		=>	[
					'name'	=>	$name,
					'email'	=>	$email
				]
			], 1);
			if ($_arr['uname'] != "") {
				$__['message']['name']	=	'Account already exists';
			}
			if ($_arr['email'] != "") {
				$__['message']['email']	=	'Email already exists';
			}
		}
		if (!$__['message']) {
			//gửi dữ liệu cho server DB
			$password	=	md5($password);
			$uid		=	$api->call('user', [
				'action'	=>	'register',
				'data'		=>	[
					'name'		=>	$name,
					'password'	=>	$password,
					'email'		=>	$email
				]
			], 1);

			if ($uid['uid'] > 0) {
				$__['status']	=	1;
				$__['message']	=	'Sign Up Success';

				//tạo phiên đăng nhập
				$_SESSION['uid']		=	$uid['uid'];
				$_SESSION['uname']		=	$name;
				$_SESSION['umail']		=	$email;
				$_SESSION['vip']		=	0;
				$_SESSION['viptime']	=	0;

				$whash	=	jcode($password, 'en', REMOTE_IP);

				setcookie("wid", $uid['uid'], NOW + (60 * 60 * 24 * 30), '/');
				setcookie("whash", $whash, NOW + (60 * 60 * 24 * 30), '/');
			} else {
				$__['message']	=	'Server error';
			}
		}
	} else {
		$__['message']['name']	=	'Not enough information has been entered';
	}
} elseif ($auth == 'activatehash') {
	$hash				=	filter($_POST['hash']);
	$password			=	filter($_POST['password']);
	$password_confirm	=	filter($_POST['password_confirm']);
	if (strlen($hash) < 32) {
		$__['message']['hash']	=	'Hash error';
	}
	if (strlen($password) < 6) {
		$__['message']['password']	=	'Password > 6 characters';
	} elseif ($password != $password_confirm) {
		$__['message']['password_confirm']	=	'Confirmation password is incorrect';
	}
	if (!$__['message']) {
		$arr	=	$api->call('user', [
			'action'	=>	'activatehash',
			'json'		=>	[
				'password'	=>	md5($password),
				'hash'		=>	$hash
			]
		], 1);
		if ($arr['status'] > 0) {
			$__['status']	=	1;
			$__['url']		=	'/';
			$__['message']	=	'New password has been reset. Please login with new password';
		} else {
			$__['message']['name']	=	'Hash error';
		}
	}
} elseif ($auth == 'forgot') {
	$name	=	filter($_POST['name']);
	if (strlen($name) < 6 && strlen($name) > 16) {
		$__['message']['name']	=	'Account does not exist';
	}
	if (!$__['message']) {
		$arr	=	$api->sending('user', [
			'action'	=>	'forgot',
			'data'		=>	['name' => $name]
		], 60);
		if ($arr['status'] > 0) {
			if ($arr['error'] != '') {
				$__['message']['name']	=	$arr['error'];
			} else {
				$__['status']	=	1;
				$__['url']		=	'/';
				$__['message']	=	'The confirmation link has been sent to your email.';
			}
		} else {
			$__['message']['name']	=	'Account does not exist';
		}
	}
} elseif ($auth == 'password' && isset($_SESSION['uid'])) {
	$password			=	filter($_POST['password']);
	$password_new		=	filter($_POST['password_new']);
	$password_confirm	=	filter($_POST['password_confirm']);
	$gcaptcha			=	filter($_POST['gcaptcha']);
	$gauth				=	$_SESSION['token'] . '|' . $auth;
	$gcaptcha			=	jcode($gcaptcha, 'de', REMOTE_IP);
	if (strlen($password) < 6) {
		$__['message']['password']	=	'Incorrect password';
	}
	if (strlen($password_new) < 6) {
		$__['message']['password_new']	=	'Password > 6 characters';
	} elseif ($password_new != $password_confirm) {
		$__['message']['password_confirm']	=	'Confirmation password is incorrect';
	} elseif ($gcaptcha != $gauth) {
		$__['message']['password_confirm']	=	'Image validation error, please try again!';
	}
	if (!$__['message']) {
		$arr	=	$api->call('user', [
			'action'	=>	'password',
			'json'		=>	[
				'password'		=>	md5($password),
				'password_new'	=>	md5($password_new),
				'id'			=>	(int)$_SESSION['uid']
			]
		], 1);
		if ($arr['status'] > 0) {
			$__['status']	=	1;
			$__['url']		=	'/';
			$__['message']	=	'Change password successfully, please login again.';
			//logout
			unset($_SESSION['uid']);
			unset($_SESSION['uname']);
			unset($_SESSION['umail']);
			unset($_SESSION['vip']);
			unset($_SESSION['viptime']);
			setcookie("wid", null, -1, '/');
			setcookie("whash", null, -1, '/');
		} else {
			$__['message']['password']	=	'Old password is incorrect';
		}
	}
} elseif ($auth == 'activatekey') {
	$vipkey			=	filter($_POST['vipkey']);
	$email			=	filter($_POST['email']);
	$email_confirm	=	filter($_POST['email_confirm']);
	$gcaptcha		=	filter($_POST['gcaptcha']);
	$gauth			=	$_SESSION['token'] . '|' . $auth;
	$gcaptcha		=	jcode($gcaptcha, 'de', REMOTE_IP);
	if ($gcaptcha != $gauth) {
		$__['message']['email_confirm']	=	'Image validation error, please try again!';
	} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$__['message']['email']	=	'Email is wrong format';
	} elseif ($email != $email_confirm) {
		$__['message']['email_confirm']	=	'Confirmation email is not correct';
	}
	if (!$__['message']) {
		$arr		=	$api->call('activatekey', ['vipkey' => $vipkey, 'email' => $email], 1);
		if ($arr['status'] == 1) {
			$__['status']	=	1;
			$__['message']	=	'VIP account has been activated';

			if ($arr['uid'] == $_SESSION['uid'] && $_SESSION['uid'] > 0) {
				$_SESSION['vip']	=	$arr['vip'];
				$_SESSION['viptime']	=	$arr['viptime'];
			}
		} else {
			$__['message']	=	$arr['message'];
		}
	}
} elseif (in_array($auth, ['view', 'like', 'dislike'])) {
	if ($id) {
		$post['id']		=	$id;
		if ($auth == 'rating') {
			$value			=	filter($_POST['value']);
			$post['value']	=	$value;
		}
		$__['status']	=	1;
		$__['data']		=	$api->call('set.' . $auth, $post, 1);
		if (in_array($auth, ['like', 'dislike'])) {
			$like		=	(int)$__['data']['vlike'];
			$dislike	=	(int)$__['data']['vdislike'];

			$bar	=	($like) ? round(($like * 100) / ($like + $dislike)) : 0;
			$voted	=	$like + $dislike;
			$rating	=	round($bar / 10, 1);
			$__['data']['voted']	=	$voted;
			$__['data']['rating']	=	$rating;
			$__['data']['bar']		=	$bar;
			$__['data']['like']		=	$like;
			$__['data']['dislike']		=	$dislike;
		}
	}
} elseif ($auth == 'favorite' && isset($_SESSION['uid'])) {
	$remove	=	filter($_POST['remove']);
	$arr	=	$api->call('favorite', [
		'id' => $id,
		'uid' => (int)$_SESSION['uid'],
		'remove' => $remove
	], 1);
	$_SESSION['__fav'][$id]	=	$id;
	if ($remove > 0) {
		unset($_SESSION['__fav'][$id]);
	}
	$__['status']	=	1;
} elseif ($auth == 'request') {
	$name		=	filter($_POST['name']);
	$imdb		=	filter($_POST['imdb']);
	$msg		=	filter($_POST['msg']);
	if (!preg_match("/imdb.com\/title\//", $imdb)) {
		$__['message']['imdb']	=	'IMDb link form: http://www.imdb.com/title/tt4254584/';
	}
	if (!$__['message']) {
		$arr		=	$api->call('request', ['name' => $name, 'imdb' => $imdb, 'msg' => $msg], 1);
		$__['status']	=	1;
		$__['message']	=	'Submitted successfully';
	}
} elseif ($auth == 'report') {
	$data_id	=	filter($_POST['data_id']);
	$message	=	filter($_POST['message']);
	if (!$message) {
		$__['message']['message']	=	'Image validation error, please try again!';
	}
	if (!$__['message']) {
		$arr		=	$api->call('report', ['id' => $id, 'data_id' => $data_id, 'message' => $message], 1);
		$__['status']	=	1;
		$__['message']	=	'Submitted successfully';
	}
} elseif ($auth == 'suggest') {
	$__['status']	=	1;
	$__['items']	=	$items;
	/*
	
	$q	=	filter($_POST['q']);
	if ($q) {
		$skeyword		=	str_replace("'s", '', un_htmlchars($q));
		$skeyword		=	str_replace(['&', '<', '>', '"', chr(92), chr(39)], '', $skeyword);
		$post		=	['data'	=>	[
			[
				'table'	=>	"post a",
				'item'	=>	base64_encode("a.*,match(a.title) against ('+{$skeyword}') AS RELEVANCE"),
				'sql'		=>	base64_encode("a.status = 1 and match(a.title) against ('+{$skeyword}') order by RELEVANCE desc limit 6")
			]
		]];
		$arr	=	$api->call('select', $post, 1);
		if ($arr['data'][0]) {
			$items	=	[];
			foreach ($arr['data'][0] as $v) {
				$vj = json_decode($v['data'], true);
				$items[]	=	[
					'title'		=>	$v['title'],
					'type'	=>	$cfnav[$v['type']],
					'imdb'		=> ($vj['imdbRating']) ? $vj['imdbRating'] : '',
					'year'		=> ($vj['released']) ? $vj['released'] : '',
					'duration'		=> ($vj['duration']) ? $vj['duration'] : '',
					'episode'		=> ($vj['episode']) ? $vj['episode'] : '',
					'url'		=>	urls($v['slug'] . (($change[$v['id']]) ? '.' . $change[$v['id']] : ''), 'post'),
					'thumb'		=>	image($v['thumb']),

				];
			}
			$__['status']	=	1;
			$__['items']	=	$items;
		}
	}
	*/
} elseif ($auth == 'invoice' && isset($_SESSION['uid'])) {
	$k	=	filter($_POST['k']);
	if ($k != '') {
		$__	=	$api->call('invoice', ['id' => $_SESSION['uid'], 'k' => $k], 1);
	}
} elseif ($auth == 'chapter') {
	$mode	=	filter($filter['mode']);
	$id	=	filter($filter['id']);
	$arr	=	$api->call('chap.info', ['id' => $id], 1);
	if ($arr['status']) {
		$html	=	[];
		$arr	=	$arr['data'];
		if ($build['pl'] == 'comic') {
			$html[]	=	'<div class="iv-comic" id="iv-comic">' . nl2br($arr['content']) . '</div>';
		} else {
			$items	=	explode("\n", $arr['content']);
			$cache_server	=	(int)$arr['cache_server'];
			$cache_ok	=	(int)$arr['cache_ok'];
			
			if($config['ad']['top']) {
				$html[]	=	'<div style="min-height: auto; margin-bottom: 15px;" class="shuffled active"><center>'.$config['ad']['top'].'</center></div>';
			}
			
			if ($config['proxy']) {
				$cfmg	=	[
					'http://54.36.122.6'	=>	's1',
					'http://54.36.122.9'	=>	's2',
					'http://51.75.146.132'	=>	's3'
				];
				$rand	=	['f1', 'f2'];
				$server_id	=	$cf_server[$cache_server];
				$server	=	'.mg01.shop/'.$cfmg[$server_id];
				$xitem	=	[];
				if($cache_ok) {
					$__cached	=	$cache->get("2xchapd.{$id}");
					if($filter['debug']) {
						unset($__cached);
						print_r([$server_id,$server,'https://'.$rand[array_rand($rand)].$server]);
					}
					if ($__cached) {
						$xitem	=	json_decode($__cached, true);
					} else {
						foreach ($items as $i => $image) {
							$xitem[]	=	['https://'.$rand[array_rand($rand)].$server, $api->encrypt(image_replace($image))];
						}
						$cache->set("2xchapd.{$id}", json_encode($xitem));
					}
					$join	=	'/image/';
				}else {
					$__cached	=	$cache->get("2xchapy.{$id}");
					if ($__cached) {
						$xitem	=	json_decode($__cached, true);
					} else {
						foreach ($items as $i => $image) {
							$sv	=	$config['proxy_cache'][array_rand($config['proxy_cache'])];
							$xitem[]	=	['https://api-s' . rand(1, 10) . '.' . $sv, image_chap($image)];
						}
						$cache->set("2xchapy.{$id}", json_encode($xitem));
					}
					$join	=	'/files/';
				}
				$ttad	=	($xitem)?count($items):0;
				$ttad	=	ceil($ttad / 2);
				$psad	=	0;
				
				foreach ($xitem as $u => $images) {
					$html[]	=	'<div class="iv-card loader shuffled ' . (($i > 0) ? '' : 'active') . '"><img src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="' . implode($join, $images) . '" class="image-vertical lazyload" alt="' . $i . '"></div>';
					if(!$psad && $u>=$ttad) {
						$psad	= 1;
						if($config['ad']['center']) {
							$html[]	=	'<div style="min-height: auto; margin-bottom: 15px;margin-top: 15px;" class="shuffled active"><center>'.$config['ad']['center'].'</center></div>';
						}
					}
				}
			} else {
				$ttad	=	($items)?count($items):0;
				$ttad	=	ceil($ttad / 2);
				$psad	=	0;
				foreach ($items as $i => $image) {
					$html[]	=	'<div class="iv-card loader shuffled ' . (($i > 0) ? '' : 'active') . '"><img src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="' . image(image_replace($image), 800) . '" class="image-vertical lazyload" alt="' . $i . '"></div>';
					if(!$psad && $i>=$ttad) {
						$psad	= 1;
						if($config['ad']['center']) {
							$html[]	=	'<div style="min-height: auto; margin-bottom: 15px;margin-top: 15px;" class="shuffled active"><center>'.$config['ad']['center'].'</center></div>';
						}
					}
				}
			}
			if($config['ad']['bot']) {
				$html[]	=	'<div style="min-height: auto; margin-bottom: 15px;margin-top: 15px;" class="shuffled active"><center>'.$config['ad']['bot'].'</center></div>';
			}
		}
		$__['status']	=	1;
		$__['html']	=	($html) ? '
		<div id="main-wrapper" class="page-layout page-read">
			<div class="container">
				<div class="container-reader-chapter" id="' . $mode . '-content">
					' . implode('', $html) . '
					' . (($mode == 'horizontal') ? '
					<div class="navi-buttons hoz-controls hoz-controls-rtl" style="">
						<div class="nabu-fill">
							<!--
								<div class="nf-item nf-double" data-toggle="tooltip" title="Double Page">
										<span></span><span></span>
								</div>
								<div class="nf-item nf-single active" data-toggle="tooltip" title="Single Page"><span></span></div>
								-->
						</div>
						<div class="nabu-page"><span><span class="hoz-current-index">01</span> / <span class="hoz-total-image">'.count($html).'</span></span></div>
						<a onclick="read.hozPrevImage()" href="javascript:void(0)" class="nabu nabu-left hoz-prev">
								<div class="navi-button navi-button-next"><i class="fas fa-angle-left"></i><span>'.$__l['Prev'].'</span>
								</div>
						</a>
						<a onclick="read.hozNextImage()" href="javascript:void(0)" class="nabu nabu-right hoz-next">
								<div class="navi-button navi-button-prev"><i class="fas fa-angle-right"></i><span>'.$__l['Next'].'</span>
								</div>
						</a>
						<div class="clearfix"></div>
					</div>
					' : '') . '
				</div>
			</div>
		</div>
		<div class="clearfix"></div>
		<div class="mr-tools mrt-bottom">
			<div class="container">
					<div class="read_tool">
							<div class="float-left" id="ver-prev-cv">
									<div class="rt-item">
											<button type="button" class="btn btn-navi" onclick="read.prev();"><i class="fas fa-arrow-left mr-2"></i>Prev Chapter
											</button>
									</div>
									<div class="clearfix"></div>
							</div>
							<div class="float-right" id="ver-next-cv">
									<div class="rt-item">
											<button type="button" class="btn btn-navi" onclick="read.next();">Next Chapter<i class="fas fa-arrow-right ml-2"></i></button>
									</div>
							</div>
							<div class="clearfix"></div>
					</div>
			</div>
		</div>
		' : '';
	}
}
echo json_encode($__);
exit;
