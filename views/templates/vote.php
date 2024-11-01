<h1><?php echo $this->title; ?></h1>
<form action="<?php echo weightyvote_get_settings_url(['action'=>'savevote', 'id' => $this->id]); ?>" method="post" class="form-horizontal col-sm-6">
<div class="row">
        <div class="form-group">
        <label class="col-md-4 control-label"><?= __('Category', 'weightyvote'); ?></label>
        <div class="btn-group col-md-8">
            <button id="categorieslistbtn" class="btn btn-default btn-sm dropdown-toggle col-md-12" type="button" data-toggle="dropdown" aria-expanded="false">
                Select <span class="caret"></span>
            </button>
            <ul id="categorieslist" class="dropdown-menu" role="menu" aria-labelledby="categorieslistbtn"/>
        </div>
        </div>
        <div class="form-group">
        <label class="col-md-4 control-label"><?= __('Vote', 'weightyvote'); ?></label>
        <div class="btn-group col-md-8">
            <button id="voteslistbtn" class="btn btn-default btn-sm dropdown-toggle col-md-12" type="button" data-toggle="dropdown" aria-expanded="false">
                Select <span class="caret"></span>
            </button>
            <ul id="voteslist" class="dropdown-menu" role="menu" aria-labelledby="voteslistbtn"/>
        </div>
    </div>
</div>
    <input type="hidden" name="vote_id" value="0">
    <input type="hidden" name="published" value="<?php echo (isset($this->vote['published']) ? $this->vote['published'] : 1); ?>">
    <input type="hidden" name="published" value="<?php echo (isset($this->vote['showTitle']) ? $this->vote['showTitle'] : 1); ?>">
    <p class="submit"><input type="submit" class="button-primary" value="<?= __('Save', 'weightyvote'); ?>"/></p>
</form>