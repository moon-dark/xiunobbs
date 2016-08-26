<?php

!defined('DEBUG') AND exit('Access Denied.');

// hook forum_start.php

$fid = param(1, 0);
$page = param(2, 1);

$forum = forum_read($fid);
empty($forum) AND message(3, lang('forum_not_exists'));
forum_access_user($fid, $gid, 'allowread') OR message(-1, lang('insufficient_visit_forum_privilege'));
$pagesize = $conf['pagesize'];

$toplist = thread_top_find($fid);

// 从默认的地方读取主题列表
$thread_list_from_default = 1;

// hook forum_thread_list_before.php

if($thread_list_from_default) {
	$pagination = pagination(url("forum-$fid-{page}"), $forum['threads'], $page, $pagesize);
	$threadlist = thread_find_by_fid($fid, $page, $pagesize);
}

$threadlist = $toplist + $threadlist;

$header['title'] = $forum['seo_title'] ? $forum['seo_title'] : $forum['name'].'-'.$conf['sitename'];
$header['mobile_title'] = $forum['name'];
$header['mobile_link'] = url("forum-$fid");
$header['keywords'] = $forum['seo_keywords'];

$_SESSION['fid'] = $fid;

// hook forum_end.php

include _include(APP_PATH.'view/htm/forum.htm');

?>