<?php

use app\components\helpers\Text;
use app\modules\main\components\BlockForm;
use app\modules\page\models\Page;

$page = null;
if (Page::getContent()) {
	$page = Page::getContent();
}
?>
<div class="contacts_page">
<div class="contacts-container width-block">
	<div class="article">
		<h1><?= $page->title ?><?= Text::_edit($page->id, 'page') ?></h1>
	</div>
	<div class="contacts-block">
		<div class="contacts-connect">
			<?= Text::_edit(1, 'main') ?>
			<p>Телефон</p>
			<a href="tel:<?= $this->params['siteinfo']->phone ?>"><?= $this->params['siteinfo']->phone ?></a>
			<p>Отдел продаж</p>
			<a href="tel:<?= $this->params['siteinfo']->phone_sell ?>"><?= $this->params['siteinfo']->phone_sell ?></a>
			<p>Приемная Новосибирск</p>
			<a href="tel:<?= $this->params['siteinfo']->phone_nsk ?>"><?= $this->params['siteinfo']->phone_nsk ?></a>
			<p>E-mail</p>
			<a href="mailto:<?= $this->params['siteinfo']->email ?>"><?= $this->params['siteinfo']->email ?></a>
			<p>Адрес</p>
			<span><?= strip_tags($this->params['siteinfo']->address) ?></span>
			<div class="contacts-map">
				<div class="arrow_vacancy">
					<a href="#openModal" class="">Смотреть на карте</a>
					<div id="openModal" class="modal">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<?= $this->params['siteinfo']->map ?>
									<a href="#close"  class="close"></a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

        <?= BlockForm::_contact() ?>

	</div>
</div>
</div>