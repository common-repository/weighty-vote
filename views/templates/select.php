<h2><?php echo $this->title; ?></h2>
<?php
    if (count(self::$votes) <= 0){
        echo __('Widgets not appended to sidebars.', 'weightyvote');
        return;
    }
?>
<table class="table table-condensed table-hover"><thead><th><?= 
    __('Title', 'weightyvote'); ?></th><th><?=
    __('Category / Question', 'weightyvote'); ?></th><th><?=
    __('Published', 'weightyvote'); ?></th><th><?=
    __('Edit', 'weightyvote'); ?></th><th><?=
    __('Remove', 'weightyvote'); ?></th></thead><tbody><?php
foreach (self::$votes as $key => $value){
?><tr><td><?php echo self::$votes[$key]['title']; ?></td><td><a class="voteid<?php
    echo self::$votes[$key]['vote_id'];?>" href="<?php
    echo weightyvote_get_settings_url(['action' => 'change', 'id' => $key,]); ?>">Select</a></td><td><a href="<?php
    echo weightyvote_get_settings_url(['action'=>(self::$votes[$key]['published'] ? 'unpublish' : 'publish'), 'id' => $key]); ?>"><span class="glyphicon <?php 
    echo (self::$votes[$key]['published'] ? 'glyphicon-ok' : 'glyphicon-remove'); ?>" aria-hidden="true"></span></a></td><td><a href="<?php
    echo weightyvote_get_settings_url(['action'=>'edit', 'id' => $key]); ?>"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span></a></td><td><a href="<?php
    echo weightyvote_get_settings_url(['action'=>'delete', 'id' => $key,]); ?>"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a></td></tr>
<?php } ?></tbody></table>