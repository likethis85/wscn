<? $fav = favorites_load_favorites($user->uid);
   //$fav = favorites_block_view(0, 'list');
    //print_r($fav);die;
?>
<div class="user-center">
    <?if (!empty($fav)):?>
    <ul class="time-list user-favorites">

        <div class="decoration-line"></div>
        <?foreach($fav as $f):?>
        <li class="time-list-item clearfix">

            <div class="item-time">
                <?=date("Y-m-d", $f->timestamp) . '<br/>' . date("H:i", $f->timestamp);?>
            </div>

            <span class="icon-circle"></span>

            <div class="item-content">

                <table>
                    <tbody>
                        <tr>
                            <td class="item-text">收藏了</td>
                            <td class="item-title"><a target="_blank" href="<?=$f->path?>"><?=$f->title?></a></td>
                            <td class="favorites-icon"><a href="/favorites/remove/<?=$f->fid?>?token=<?=$f->token?>"></a></td>
                        </tr>
                    </tbody>
                </table>

            </div>

        </li>
        <?endforeach?>

    </ul>
    <?endif?>
</div>
