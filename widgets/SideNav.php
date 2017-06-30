<?php
/**
 * This file is part of Colibri platform
 *
 * @link https://github.com/ColibriPlatform
 * @copyright   (C) 2017 PHILIP Sylvain. All rights reserved.
 * @license     MIT; see LICENSE.txt
 */
namespace colibri\admin\widgets;

use yii\base\InvalidConfigException;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use rmrevin\yii\fontawesome\FA;
use dee\adminlte\Html;

/**
 * Extends SideNav
 *
 * @see \dee\adminlte\SideNav
 * @author Sylvain PHILIP <contact@sphilip.com>
 */
class SideNav extends \dee\adminlte\SideNav
{
    /**
     * Renders a widget's item.
     * @param string|array $item the item to render.
     * @return string the rendering result.
     * @throws InvalidConfigException
     */
    public function renderItem($item)
    {
        if (is_string($item)) {
            return $item;
        }
        if (!isset($item['label']) && !isset($item['icon'])) {
            throw new InvalidConfigException("The 'label' option is required.");
        }
        $encodeLabel = isset($item['encode']) ? $item['encode'] : $this->encodeLabels;
        $label = ArrayHelper::getValue($item, 'label', '');
        if ($encodeLabel) {
            $label = Html::encode($label);
        }
        $label = Html::tag('span', $label);

        $icon = ArrayHelper::getValue($item, 'icon');
        if ($icon) {
            $label = FA::icon($icon) . ' ' . $label;
        }
        $badge = ArrayHelper::getValue($item, 'badge');
        if (!empty($badge)) {
            $badgeColor = ArrayHelper::getValue($item, 'badgeColor', 'red');
            $label .= ' ' . Html::tag('small', $badge, ['class' => 'badge pull-right bg-' . $badgeColor]);
        }
        $options = ArrayHelper::getValue($item, 'options', []);
        $items = ArrayHelper::getValue($item, 'items');
        $url = ArrayHelper::getValue($item, 'url', '');
        $linkOptions = ArrayHelper::getValue($item, 'linkOptions', []);

        if (isset($item['active'])) {
            $active = ArrayHelper::remove($item, 'active', false);
        } else {
            $active = $this->isItemActive($item);
        }

        if ($items !== null) {
            Html::addCssClass($options, ['widget' => 'treeview']);
            if ($this->treeviewCaret !== '') {
                $label .= ' ' . Html::tag('span', $this->treeviewCaret, ['class' => 'pull-right-container']);
            }
            if (is_array($items)) {
                if ($this->activateItems) {
                    $items = $this->isChildActive($items, $active);
                }
                $items = $this->renderItems($items, ['class' => 'treeview-menu']);
            }
        }

        if ($this->activateItems && $active) {
            Html::addCssClass($options, 'active');
        }
        $item = empty($url) ? $label : Html::a($label, $url, $linkOptions);

        return Html::tag('li', $item . $items, $options);
    }
}
