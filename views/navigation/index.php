<?php
/**
 * This file is part of Colibri platform
 *
 * @link https://github.com/ColibriPlatform
 * @copyright   (C) 2017 PHILIP Sylvain. All rights reserved.
 * @license     MIT; see LICENSE.txt
 */

use kartik\tree\TreeView;
use kartik\tree\Module;
use colibri\admin\models\Navigation;
?>


<div class="admin-navigation-index">

<?php
echo TreeView::widget([
    'query' => Navigation::find()->addOrderBy('root, lft'),
    'headingOptions' => ['label' => 'Navigation'],
    'fontAwesome' => true,
    'isAdmin' => true,
    'displayValue' => 1,
    'softDelete' => true,
    'cacheSettings' => [
        'enableCache' => true
    ],
    'nodeAddlViews' => [
        Module::VIEW_PART_2 => '@vendor/colibri-platform/admin/views/navigation/_form_part_2'
     ]
]);

?>
</div>
