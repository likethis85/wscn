<?
    $user_picture = wscn_get_user_picture($user->uid);
    $user_menu = array(
                    'focus'     => array('name' => '我的关注', 'url' => '/user?type=focus'),
                    'comment'   => array('name' => '个人评论', 'url' => '/user?type=comment'),
                    'favorites' => array('name' => '文章收藏', 'url' => '/user?type=favorites'),
                    'profile'   => array('name' => '个人资料', 'url' => '/user/' . $user->uid . '/edit?type=profile'),
                    'feedback'  => array('name' => '意见反馈', 'url' => '/user?type=feedback'),
                 );

    $type = '';
    if (!isset($_GET['type'])) {
        $type = 'focus';
    } else {
        $type = trim($_GET['type']);
    }
?>

<div class="user-center">

    <p class="welcome-message">
        <?if(isset($user_picture['filename'])):?>
        <img class="avatar" src="/sites/default/files/pictures/<?  echo $user_picture['filename'];?>" alt=""/>
        <?else:?>
        <img class="avatar" src="/sites/all/themes/wallstcn/css/img/avatar.png" alt=""/>
        <?endif;?>
        您好，<span class="user-name"><?=$user->name?></span>，欢迎来到个人中心！
    </p>

    <ul class="user-nav clearfix">
        <? foreach($user_menu as $k => $u):?>
        <li <?if('feedback' == $k) echo 'class="last-item"'; ?>>
            <a class="nav-<?=$k?> <?if($type == $k) echo 'active'; ?>" href="<?=$u['url']?>">
                <span class="user-nav-icon"><span></span></span>
                <span class="user-nav-text"><?=$u['name']?></span>
            </a>
        </li>
        <? endforeach;?>
    </ul>

</div>
