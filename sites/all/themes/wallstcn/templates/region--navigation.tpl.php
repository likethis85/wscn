<nav id="navbar-user" >
<div class="container">
    <div class="navbar">
        <div class="navbar-inner">
            <ul class="nav">
                <li><a href="http://<?=variable_get('site_domain')?>">欢迎来到华尔街见闻——全球金融资讯管家</a></li>
            </ul>
            <ul class="nav pull-right">
                <?if($logged_in):?>
                <li><a href="/user"><?=t('My account')?></a></li>
                <li><a href="/user/logout"><?=t('Log out')?></a></li>
                <?else:?>
                <li><a href="/user">登录　|</a></li>
                <li><a href="/user/register">注册　| </a></li>
                <?endif?>
            </ul>
        </div>
    </div>
</div>
</nav>

