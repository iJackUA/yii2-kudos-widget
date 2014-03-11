<?php
/**
 * Kudos class file
 *
 * @author Evgeniy Kuzminov
 * @license MIT License
 * http://stdout.in
 */
namespace ijackua\kudos;

use Yii;
use yii\base\Widget;

/**
 *
 */
class Kudos extends Widget
{
	/**
	 * Identifier of widget for localStorage (if you want to have more that one widget on page/site)
	 *
	 * @var string
	 */
	public $widgetId;
	/**
	 * Unique id of current item you receive kudos for (generally those one you have in DB)
	 *
	 * @var string
	 */
	public $uid;
	/**
	 * Preset count of Kudos current item already has (taken somewhere from DB)
	 *
	 * @var integer
	 */
	public $count;
	/**
	 * Default class value for internal circle element
	 * You would definitely like to put there something nice (some cole font-smile from Bootstrap or Fontello etc.)
	 *
	 * @var string
	 */
	public $defaultClass;
	/**
	 * JavaScript functions to fire on events
	 *
	 * @var string
	 */
	public $onActive;
	public $onInactive;
	public $onAdded;
	public $onRemoved;
	/**
	 * Text "Kudos"
	 *
	 * @var string
	 */
	public $textTxt;
	/**
	 * Text "Don't move!"
	 *
	 * @var string
	 */
	public $textDontmove;

	public function init()
	{
		parent::init();

		$this->textTxt = \Yii::t("app", "Kudos");
		$this->textDontmove = \Yii::t("app", "Don't move!");
	}

	public function run()
	{

		KudosAssets::register($this->view);
		$this->registerScripts();

		$html = '<figure id="' . $this->getId() . '" class="kudo kudoable" data-id="' . $this->widgetId . '" data-uid="' . $this->uid . '">
				<a class="kudobject">
					<div class="opening">
						<div class="circle">
							<i class="' . $this->defaultClass . '"></i>
						</div>
					</div>
				</a>
				<a href="#kudo" class="count">
				<span class="num">' . $this->count . '</span>
				<span class="txt">' . $this->textTxt . '</span>
				<span class="dontmove">' . $this->textDontmove . '</span>
				</a>
				</figure>';

		return $html;
	}

	public function registerScripts()
	{
		$selector = '#' . $this->getId();

		$script = '$("' . $selector . '").kudoable();';

		$script .= (!empty($this->onActive)) ? '$("' . $selector . '") . on("kudo:active", ' . $this->onActive . ');' : '';
		$script .= (!empty($this->onInactive)) ? '$("' . $selector . '") . on("kudo:inactive", ' . $this->onInactive . ');' : '';
		$script .= (!empty($this->onAdded)) ? '$("' . $selector . '") . on("kudo:added", ' . $this->onAdded . ');' : '';
		$script .= (!empty($this->onRemoved)) ? '$("' . $selector . '") . on("kudo:removed", ' . $this->onRemoved . ');' : '';

		$this->view->registerJs($script);
	}
}
