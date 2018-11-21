<?php
/**
 * This file is part of Colibri platform
 *
 * @link https://github.com/ColibriPlatform
 * @copyright   (C) 2017 PHILIP Sylvain. All rights reserved.
 * @license     MIT; see LICENSE.txt
 */

namespace colibri\admin\models;

use kartik\tree\models\Tree;
use Yii;

/**
 * Navigation class for the Colibri platform.
 *
 * @property string $slug
 * @property string $route
 * @property string $route_params
 * @property string $page_title
 * @property string $meta_description
 * @property string $meta_keywords
 * @property string $access_roles
 * @property string $link_options
 *
 * @author Sylvain PHILIP <contact@sphilip.com>
 */
class Navigation extends Tree
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%navigation}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        $rules = parent::rules();
        $rules[] = [['slug', 'route'], 'required'];

        $rules[] = [['slug', 'route'], 'string', 'max' => 60];
        $rules[] = ['page_title','string', 'max' => 255];

        $rules[] = [[
            'route_params',
            'access_roles',
            'meta_description',
            'meta_keywords',
            'link_options',
        ], 'string'];

        return $rules;
    }


    public function attributeLabels()
    {
        $parentLabels = parent::attributeLabels();

        $labels = [
            'slug' => Yii::t('admin', 'Slug'),
            'route' => Yii::t('admin', 'Route'),
            'route_params' => Yii::t('admin', 'Route parameters'),
            'access_roles' => Yii::t('admin', 'Access roles'),
            'page_title' => Yii::t('admin', 'Page title'),
            'meta_description' => Yii::t('admin', 'Meta description'),
            'meta_keywords' => Yii::t('admin', 'Meta keywords'),
            'link_options' => Yii::t('admin', 'Link options'),
        ];

        return $parentLabels + $labels;
    }

    public function attributeHints()
    {
        return [
            'slug' => Yii::t('admin', 'Url Unique identifier.'),
            'route_params'  => Yii::t('admin', 'List of comma separated key=values pairs of route parameters.'),
            'access_roles'  => Yii::t('admin', 'List of comma separated roles alowed to wiew this item.'),
            'meta_keywords' => Yii::t('admin', 'List of comma separated keywords.'),
            'link_options'  => Yii::t('admin', 'List of comma separated key=values pairs of link attributes.'),
        ];
    }

    /**
     * Build a tree items array
     * This nice iterating tree traversal algorithm to build come from
     * yii2-pages-module
     *
     * @param string $slug The node slug

     * @author [Sylvain Philip, diemeisterei GmbH, Stuttgart]
     * @see https://github.com/dmstr/yii2-pages-module
     *
     * @return array|array
     */
    public static function getNavItems($slug)
    {
        $rootNode = self::findOne(['slug' => $slug]);

        if (empty($rootNode)) {
            return [];
        }

        /* @var Tree[] $childs */
        $childs = $rootNode->children()->andWhere([
            'active' => 1,
            'visible' => 1,
            'disabled' => 0,
        ])->all();

        if (empty($childs)) {
            return [];
        }

        // Tree mapping and leave stack
        $treeMap = [];
        $stack = [];

        foreach ($childs as $child) {

            /* @var Tree $child */
            $item = [
                'label' => $child->name,
                'url' => [$child->route],
                'icon' => $child->icon,
                'linkOptions' => [
                    'data-item-id' => $child->id,
                    'data-lvl' => $child->lvl,
                ]
            ];

            if (!empty($child->route_params)) {
                $params = explode(',', $child->route_params);

                foreach ($params as $param) {
                    $exp = explode('=', $param);
                    $item['url'][$exp[0]] = $exp[1];
                }
            }

            if (!empty($child->access_roles)) {

                $roles = explode(',', $child->access_roles);
                $visible = false;

                foreach ($roles as $role) {
                    if (strpos($role, '!') === 0) {
                        $role = substr($role, 1);

                        if (!Yii::$app->user->can($role)) {
                            $visible = true;
                            break;
                        }

                        continue;
                    }

                    if (Yii::$app->user->can($role)) {
                        $visible = true;
                        break;
                    }
                }

                $item['visible'] = $visible;
            }

            if (!empty($child->link_options)) {
                $options = explode(',', $child->link_options);

                foreach ($options as $option) {
                    $attribute = explode('=', trim($option));

                    if (isset($attribute[0]) && isset($attribute[1])) {
                        $item['linkOptions'][$attribute[0]] = $attribute[1];
                    }
                }
            }

            // Count items in stack
            $counter = count($stack);

            // Check on different levels
            while ($counter > 0 && $stack[$counter - 1]['linkOptions']['data-lvl'] >= $item['linkOptions']['data-lvl']) {
                array_pop($stack);
                --$counter;
            }

            // Stack is now empty (check root again)
            if ($counter == 0) {
                // Assign root node
                $i = count($treeMap);
                $treeMap[$i] = $item;
                $stack[] = &$treeMap[$i];
            } else {
                if (!isset($stack[$counter - 1]['items'])) {
                    $stack[$counter - 1]['items'] = [];
                }

                // Add the node to parent node
                $i = count($stack[$counter - 1]['items']);
                $stack[$counter - 1]['items'][$i] = $item;
                $stack[] = &$stack[$counter - 1]['items'][$i];
            }
        }

        return array_filter($treeMap);
    }
}
