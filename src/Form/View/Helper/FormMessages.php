<?php
/**
 * CoolMS2 Twitter Bootstrap Module (http://www.coolms.com/)
 *
 * @link      http://github.com/coolms/twbs for the canonical source repository
 * @copyright Copyright (c) 2006-2015 Altgraphic, ALC (http://www.altgraphic.com)
 * @license   http://www.coolms.com/license/new-bsd New BSD License
 * @author    Dmitry Popov <d.popov@altgraphic.com>
 */

namespace CmsTwbs\Form\View\Helper;

use Zend\Mvc\Controller\Plugin\FlashMessenger,
    CmsCommon\Form\View\Helper\FormMessages as BaseFormMessages;

class FormMessages extends BaseFormMessages
{
    protected $classMessages = [
        FlashMessenger::NAMESPACE_INFO    => 'alert alert-dismissable alert-info',
        FlashMessenger::NAMESPACE_ERROR   => 'alert alert-dismissable alert-danger',
        FlashMessenger::NAMESPACE_SUCCESS => 'alert alert-dismissable alert-success',
        FlashMessenger::NAMESPACE_DEFAULT => 'alert alert-dismissable alert-default',
        FlashMessenger::NAMESPACE_WARNING => 'alert alert-dismissable alert-warning',
    ];
}
