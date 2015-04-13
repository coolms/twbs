<?php
/**
 * CoolMS2 Twitter Bootstrap Module (http://www.coolms.com/)
 *
 * @link      http://github.com/coolms/twbs for the canonical source repository
 * @copyright Copyright (c) 2006-2015 Altgraphic, ALC (http://www.altgraphic.com)
 * @license   http://www.coolms.com/license/new-bsd New BSD License
 * @author    Dmitry Popov <d.popov@altgraphic.com>
 */

namespace CmsTwbs;

return [
    'asset_manager' => [
        'resolver_configs' => [
            'paths' => [
                __DIR__ . '/../public',
            ],
            'map' => [
                'assets/cms-twbs/css/bootstrap.css'             => __DIR__ . '/../public/assets/cms-twbs/less/bootstrap.less',
                'assets/cms-twbs/css/bootstrap.min.css'         => __DIR__ . '/../public/assets/cms-twbs/less/bootstrap.less',
                'assets/cms-twbs/css/bootstrap-ext.css'         => __DIR__ . '/../public/assets/cms-twbs/less/bootstrap-ext.less',
                'assets/cms-twbs/css/bootstrap-ext.min.css'     => __DIR__ . '/../public/assets/cms-twbs/less/bootstrap-ext.less',
                'assets/cms-twbs/css/bootstrap-theme.css'       => __DIR__ . '/../public/assets/cms-twbs/less/theme.less',
                'assets/cms-twbs/css/bootstrap-theme.min.css'   => __DIR__ . '/../public/assets/cms-twbs/less/theme.less',
                'assets/cms-twbs/css/font-awesome.css'          => __DIR__ . '/../public/assets/cms-twbs/less/font-awesome.less',
                'assets/cms-twbs/css/font-awesome.min.css'      => __DIR__ . '/../public/assets/cms-twbs/less/font-awesome.less',
            ],
        ],
        'filters' => [
            'assets/cms-twbs/css/bootstrap.css' => [
                ['service'  => 'LessPhpFilter'],
            ],
            'assets/cms-twbs/css/bootstrap.min.css' => [
                ['service'  => 'LessPhpFilter'],
                ['filter'   => 'CssMinFilter'],
            ],
            'assets/cms-twbs/css/bootstrap-ext.css' => [
                ['service'  => 'LessPhpFilter'],
            ],
            'assets/cms-twbs/css/bootstrap-ext.min.css' => [
                ['service'  => 'LessPhpFilter'],
                ['filter'   => 'CssMinFilter'],
            ],
            'assets/cms-twbs/css/bootstrap-theme.css' => [
                ['service'  => 'LessPhpFilter'],
            ],
            'assets/cms-twbs/css/bootstrap-theme.min.css' => [
                ['service'  => 'LessPhpFilter'],
                ['filter'   => 'CssMinFilter'],
            ],
            'assets/cms-twbs/css/font-awesome.css' => [
                ['service'  => 'LessPhpFilter'],
            ],
            'assets/cms-twbs/css/font-awesome.min.css' => [
                ['service'  => 'LessPhpFilter'],
                ['filter'   => 'CssMinFilter'],
            ],
        ],
    ],
    'controllers' => [
        'invokables' => [
            'CmsTwbs\Controller\Admin' => 'CmsTwbs\Controller\AdminController',
        ],
    ],
    'navigation_helpers' => [
        'aliases' => [
            'menu' => 'CmsTwbs\View\Helper\Navigation\Menu',
        ],
        'invokables' => [
            'CmsTwbs\View\Helper\Navigation\Menu' => 'CmsTwbs\View\Helper\Navigation\Menu',
        ],
    ],
    'router' => [
        'routes' => [
            'cms-admin' => [
                'child_routes' => [
                    'twbs' => [
                        'type' => 'Segment',
                        'options' => [
                            'route' => '/twbs[:controller[/:action[/:id]]]',
                            'constraints' => [
                                'controller' => '[a-zA-Z\-]*',
                                'action' => '[a-zA-Z\-]*',
                                'id' => '[a-zA-Z0-9\-]*',
                            ],
                            'defaults' => [
                                '__NAMESPACE__' => 'CmsTwbs\Controller',
                                'controller' => 'Admin',
                                'action' => 'index',
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
    'service_manager' => [
        'aliases' => [
            'LessPhpFilter' => 'CmsTwbs\Filter\LessPhpFilter',
        ],
        'factories' => [
            'CmsTwbs\Filter\LessPhpFilter' => 'CmsTwbs\Factory\LessPhpFilterFactory',
        ],
    ],
    'view_helper_config' => [
        'flashmessenger' => [
            'message_open_format'      => '<div%s><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><ul><li>',
            'message_separator_string' => '</li><li>',
            'message_close_string'     => '</li></ul></div>',
        ],
        'formelementerrors' => [
            'message_open_format'      => '<div%s><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><ul><li>',
            'message_separator_string' => '</li><li>',
            'message_close_string'     => '</li></ul></div>',
        ],
    ],
    'view_helpers' => [
        'aliases' => [
            'formMessages' => 'CmsTwbs\Form\View\Helper\FormMessages',
            'icon' => 'glyphicon',
        ],
        'invokables' => [
            'btn'                   => 'CmsTwbs\Form\View\Helper\Decorator\Btn',
            'btnReset'              => 'CmsTwbs\Form\View\Helper\Decorator\BtnReset',
            'btnSubmit'             => 'CmsTwbs\Form\View\Helper\Decorator\BtnSubmit',
            'checkbox'              => 'CmsTwbs\Form\View\Helper\Decorator\Checkbox',
            'col'                   => 'CmsTwbs\View\Helper\Col',
            'controlLabel'          => 'CmsTwbs\Form\View\Helper\Decorator\ControlLabel',
            'fa'                    => 'CmsTwbs\View\Helper\Fa',
            'formCaptcha'           => 'CmsTwbs\Form\View\Helper\FormCaptcha',
            'formCheckbox'          => 'CmsTwbs\Form\View\Helper\FormCheckbox',
            'formCollection'        => 'CmsTwbs\Form\View\Helper\FormCollection',
            'formControl'           => 'CmsTwbs\Form\View\Helper\Decorator\FormControl',
            'formControlFeedback'   => 'CmsTwbs\Form\View\Helper\Decorator\FormControlFeedback',
            'formControlStatic'     => 'CmsTwbs\Form\View\Helper\Decorator\FormControlStatic',
            'formDateSelect'        => 'CmsTwbs\Form\View\Helper\FormDateSelect',
            'formEmail'             => 'CmsTwbs\Form\View\Helper\FormEmail',
            'formFile'              => 'CmsTwbs\Form\View\Helper\FormFile',
            'formGroup'             => 'CmsTwbs\Form\View\Helper\Decorator\FormGroup',
            'formGroupCol'          => 'CmsTwbs\Form\View\Helper\Decorator\FormGroupCol',
            'formGroupElement'      => 'CmsTwbs\Form\View\Helper\Decorator\FormGroupElement',
            'formInline'            => 'CmsTwbs\Form\View\Helper\Decorator\FormInline',
            'inputGroup'            => 'CmsTwbs\Form\View\Helper\Decorator\InputGroup',
            'formMonthSelect'       => 'CmsTwbs\Form\View\Helper\FormMonthSelect',
            'formNumber'            => 'CmsTwbs\Form\View\Helper\FormNumber',
            'formPanel'             => 'CmsTwbs\Form\View\Helper\FormPanel',
            'formPassword'          => 'CmsTwbs\Form\View\Helper\FormPassword',
            'formReset'             => 'CmsTwbs\Form\View\Helper\FormReset',
            'formRow'               => 'CmsTwbs\Form\View\Helper\FormRow',
            'formSelect'            => 'CmsTwbs\Form\View\Helper\FormSelect',
            'formStatic'            => 'CmsTwbs\Form\View\Helper\FormStatic',
            'formSubmit'            => 'CmsTwbs\Form\View\Helper\FormSubmit',
            'formText'              => 'CmsTwbs\Form\View\Helper\FormText',
            'formTextarea'          => 'CmsTwbs\Form\View\Helper\FormTextarea',
            'formUrl'               => 'CmsTwbs\Form\View\Helper\FormUrl',
            'helpBlock'             => 'CmsTwbs\Form\View\Helper\Decorator\HelpBlock',
            'glyphicon'             => 'CmsTwbs\View\Helper\Glyphicon',
            'inputGroupAddon'       => 'CmsTwbs\Form\View\Helper\Decorator\InputGroupAddon',
            'inputGroupBtn'         => 'CmsTwbs\Form\View\Helper\Decorator\InputGroupBtn',
            'panel'                 => 'CmsTwbs\View\Helper\Panel',
            'row'                   => 'CmsTwbs\View\Helper\Row',
        ],
    ],
    'view_manager' => [
        'template_map' => [
            'layout/bootstrap' => __DIR__ . '/../view/layout/bootstrap.phtml',
            'twbs' => __DIR__ . '/../view/layout/bootstrap.phtml',
        ],
        'template_path_stack' => [
            __NAMESPACE__ => __DIR__ . '/../view',
        ],
    ],
];
