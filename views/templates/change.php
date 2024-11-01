<h1><?php echo $this->title; ?></h1>
<form action="<?php echo weightyvote_get_settings_url(['action'=>'save', 'id' => $this->id]); ?>" method="post" class="form-horizontal col-sm-12 col-md-12 col-lg-12">
<div id="html_code">
    <div class="row">
        <div class="col-md-4 col-lg-4">
            <div class="row">
                <h3><?= __('Vote', 'weightyvote'); ?></h3>
            </div>
            <div class="form-group">
            <label class="col-md-4 col-lg-4 control-label"><?= __('Category', 'weightyvote'); ?></label>
            <div class="btn-group col-md-8">
                <button id="categorieslistbtn" class="btn btn-default btn-sm dropdown-toggle col-md-12" type="button" data-toggle="dropdown" aria-expanded="false">
                    Select <span class="caret"></span>
                </button>
                <ul id="categorieslist" class="dropdown-menu" role="menu" aria-labelledby="categorieslistbtn"/>
            </div>
            </div>
            <div class="form-group">
            <label class="col-md-4 col-lg-4 control-label"><?= __('Vote', 'weightyvote'); ?></label>
            <div class="btn-group col-md-8">
                <button id="voteslistbtn" class="btn btn-default btn-sm dropdown-toggle col-md-12" type="button" data-toggle="dropdown" aria-expanded="false">
                    Select <span class="caret"></span>
                </button>
                <ul id="voteslist" class="dropdown-menu" role="menu" aria-labelledby="voteslistbtn"/>
            </div>
        </div></div>
        <div class="col-md-4 col-lg-4">
            <h3><?= __('Widget', 'weightyvote'); ?></h3>
            <div class="form-group">
            <label class="col-md-6 control-label"><?= __('Border color', 'weightyvote'); ?></label>
            <div class="col-md-5 col-lg-5">
                <input id="btn1" style="display: none;" class="color form-control" name="borderWg" value="<?php echo ''; ?>">
            </div>
            </div><div class="form-group"><label class="col-md-6 control-label"><?= __('Border size', 'weightyvote'); ?></label>
            <div class="col-md-5 col-lg-5">
                <input id="btn2" class="form-control" name="borderSizeWg" min="0" max="5" step="1" type="number" value="<?php echo '$this->borderSizeWg'; ?>">
            </div>
            </div><div class="form-group"><label class="col-md-6 control-label"><?= __('Shadow intensity', 'weightyvote'); ?></label>
            <div class="col-md-5 col-lg-5">
                <input class="form-control" name="shadowOpacity" min="0" max="1" step="0.05" type="number" value="<?php echo '$this->shadowOpacity'; ?>">
            </div></div><div class="form-group">
            <label class="col-md-6 control-label"><?= __('Shadow size', 'weightyvote'); ?></label>
            <div class="col-md-5 col-lg-5">
                <input class="form-control" name="shadowSize" min="0" max="50" step="1" type="number" value="<?php echo '$this->shadowSize'; ?>">
            </div>
        </div></div>
        <div class="col-md-4 col-lg-4">
            <h3><?= __('Question', 'weightyvote'); ?></h3>
            <div class="form-group">
            <label class="col-md-6 control-label"><?= __('Question background', 'weightyvote'); ?></label>
            <div class="col-md-5 col-lg-5">
                <input style="display: none;" class="color form-control" name="bgHeader" value="<?php echo '$this->bgHeader'; ?>">
            </div>
            </div>
            <div class="form-group">
                <label class="col-md-6 control-label"><?= __('Question text', 'weightyvote'); ?></label>
            <div class="col-md-5 col-lg-5">
                <input style="display: none;" class="color form-control" name="colorHeader" value="<?php echo '$this->colorHeader'; ?>">
            </div>
            </div>
            <div class="form-group"><label class="col-md-6 control-label"><?= __('Separator', 'weightyvote'); ?></label>
            <div class="col-md-5 col-lg-5">
                <input style="display: none;" class="color form-control" name="borderHeader" value="<?php echo '$this->borderHeader'; ?>">
            </div>
            </div><div class="form-group">
            <label class="col-md-6 control-label"><?= __('Line size', 'weightyvote'); ?></label>
            <div class="col-md-5 col-lg-5">
                <input class="form-control" name="borderSizeHeader" min="0" max="5" step="1" type="number" value="<?php echo '$this->borderSizeHeader'; ?>">
            </div>
       </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 col-lg-4">
            <div id="vote-widget-preview"></div>
        </div>
        <div class="col-md-4 col-lg-4">
            <h3><?= __('Response', 'weightyvote'); ?></h3>
            <div class="form-group">
            <label class="col-md-6 control-label"><?= __('Response background', 'weightyvote'); ?></label>
            <div class="col-md-5 col-lg-5">
                <input style="display: none;" class="color form-control" name="bgBody" value="<?php echo '$this->bgBody'; ?>">
            </div>
            </div><div class="form-group">
            <label class="col-md-6 control-label"><?= __('Response text', 'weightyvote'); ?></label>
            <div class="col-md-5 col-lg-5">
                <input style="display: none;" class="color form-control" name="colorWg" value="<?php echo '$this->colorWg'; ?>">
            </div>
            </div><div class="form-group">
            <label class="col-md-6 control-label"><?= __('Votes background', 'weightyvote'); ?></label>
            <div class="col-md-5 col-lg-5">
                <input style="display: none;" class="color form-control" name="bgAnswerCount" value="<?php echo '$this->bgAnswerCount'; ?>">
            </div>
            </div><div class="form-group">
            <label class="col-md-6 control-label"><?= __('Votes text', 'weightyvote'); ?></label>
            <div class="col-md-5 col-lg-5">
                <input style="display: none;" class="color form-control" name="colorAnswerCount" value="<?php echo '$this->colorAnswerCount'; ?>">
            </div>
            </div><div class="form-group">
            <label class="col-md-6 control-label"><?= __('Button background', 'weightyvote'); ?></label>
            <div class="col-md-5 col-lg-5">
                <input style="display: none;" class="color form-control" name="bgButton" value="<?php echo '$this->bgButton'; ?>">
            </div>
            </div><div class="form-group">
            <label class="col-md-6 control-label"><?= __('Button text', 'weightyvote'); ?></label>
            <div class="col-md-5 col-lg-5">
                <input style="display: none;" class="color form-control" name="colorButton" value="<?php echo '$this->colorButton'; ?>">
            </div>
            </div><div class="form-group">
            <label class="col-md-6 control-label"><?= __('Result link', 'weightyvote'); ?></label>
            <div class="col-md-5 col-lg-5">
                <input style="display: none;" class="color form-control" name="colorLink" value="<?php echo '$this->colorButton'; ?>">
            </div></div>
        </div>
        <div class="col-md-4 col-lg-4">
            <h3><?= __('Statistic', 'weightyvote'); ?></h3>
            <div class="form-group">
            <label class="col-md-6 control-label"><?= __('Separator', 'weightyvote'); ?></label>
            <div class="col-md-5 col-lg-5">
                <input style="display: none;" class="color form-control" name="borderFooter" value="<?php echo '$this->borderFooter'; ?>">
            </div>
            </div><div class="form-group">
            <label class="col-md-6 control-label"><?= __('Line size', 'weightyvote'); ?></label>
            <div class="col-md-5 col-lg-5">
                <input class="form-control" name="borderSizeFooter" min="0" max="5" step="1" type="number" value="<?php echo '$this->borderSizeFooter'; ?>">
            </div>
            </div><div class="form-group">
            <label class="col-md-6 control-label"><?= __('Statistic background', 'weightyvote'); ?></label>
            <div class="col-md-5 col-lg-5">
                <input style="display: none;" class="color form-control" name="bgFooter" value="<?php echo '$this->bgFooter'; ?>">
            </div>
            </div><div class="form-group">
            <label class="col-md-6 control-label"><?= __('Statistic text', 'weightyvote'); ?></label>
            <div class="col-md-5 col-lg-5">
                <input style="display: none;" class="color form-control" name="colorFooter" value="<?php echo '$this->colorFooter'; ?>">
            </div>
            </div><div class="form-group">
            <label class="col-md-6 control-label"><?= __('Counter background', 'weightyvote'); ?></label>
            <div class="col-md-5 col-lg-5">
                <input style="display: none;" class="color form-control" name="bgCounter" value="<?php echo '$this->bgCounter'; ?>">
            </div>
            </div><div class="form-group">
            <label class="col-md-6 control-label"><?= __('Counter text', 'weightyvote'); ?></label>
            <div class="col-md-5 col-lg-5">
                <input style="display: none;" class="color form-control" name="colorCounter" value="<?php echo '$this->colorCounter'; ?>">
            </div></div>
        </div>
    </div>
</div>
    <input type="hidden" name="vote_id" value="0">
    <input type="hidden" name="published" value="<?php echo (isset($this->vote['published']) ? $this->vote['published'] : 1); ?>">
    <input type="hidden" name="published" value="<?php echo (isset($this->vote['showTitle']) ? $this->vote['showTitle'] : 1); ?>">
    <p class="submit"><input type="submit" class="button-primary" value="<?= __('Save', 'weightyvote'); ?>"/></p>
</form>