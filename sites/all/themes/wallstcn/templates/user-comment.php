<? $comments = wscn_get_user_comments($user->uid);?>

<div class="user-center">
<?if(!empty($comments)):?>
    <ul class="time-list user-comments">

        <div class="decoration-line"></div>
        <?foreach($comments as $c):?>
        <li class="time-list-item clearfix">

            <div class="item-time">
                <?=date("Y-m-d", $c->created) . '<br/>' . date("H:i", $c->created);?>
            </div>

            <span class="icon-circle"></span>

            <div class="item-content">

                <table>
                    <tbody>
                    <tr>
                        <td class="item-text">评论了</td>
                        <td class="item-title"><a target="_blank" href="/node/<?=$c->nid?>"><?=$c->title?></a></td>
                    </tr>
                    </tbody>
                </table>

                <p>
                    <?=$c->subject?>
                </p>

            </div>

        </li>
        <?endforeach;?>
    </ul>
<?endif;?>
</div>
