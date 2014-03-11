<?php
/**
 * Kudos assets class file
 *
 * @author Evgeniy Kuzminov
 * @license MIT License
 * http://stdout.in
 */
namespace ijackua\kudos;

use yii\web\AssetBundle;

class KudosAssets extends AssetBundle
{
	public $sourcePath = '@kudos/assets';
	public $basePath = '@webroot/assets';
	public $js = [
		'kudos.js',
	];
	public $css = [
		'kudos.css',
	];
	public $depends = [
		'yii\web\JqueryAsset',
	];

	public function init() {
		Yii::setAlias('@kudos', __DIR__);
		return parent::init();
	}
}