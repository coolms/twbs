<?php
/**
 * CoolMS2 Twitter Bootstrap Module (http://www.coolms.com/)
 *
 * @link      http://github.com/coolms/twbs for the canonical source repository
 * @copyright Copyright (c) 2006-2014 Altgraphic, ALC (http://www.altgraphic.com)
 * @license   http://www.coolms.com/license/new-bsd New BSD License
 * @author    Dmitry Popov <d.popov@altgraphic.com>
 */

namespace CmsTwbs\Form\View\Helper;

use Zend\Form\View\Helper\FormFile as ZendFormFile;

class FormFile extends ZendFormFile
{
    use FormElementTrait;

    protected $attributes = [
        'class' => 'form-control',
    ];

    /**
     * @var array
     */
    protected $labelAttributes = [
        'class' => 'control-label sr-only',
    ];
}
