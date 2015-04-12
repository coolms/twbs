<?php
/**
 * CoolMS2 Twitter Bootstrap Module (http://www.coolms.com/)
 *
 * @link      http://github.com/coolms/twbs for the canonical source repository
 * @copyright Copyright (c) 2006-2015 Altgraphic, ALC (http://www.altgraphic.com)
 * @license   http://www.coolms.com/license/new-bsd New BSD License
 * @author    Dmitry Popov <d.popov@altgraphic.com>
 */

namespace CmsTwbs\View\Helper;

use CmsCommon\View\Helper\HtmlContainer;

class Glyphicon extends HtmlContainer
{
    /**
     * @var string
     */
    protected $tagName = 'span';

    /**
     * @var string
     */
    protected $defaultClass = 'glyphicon';

    /**
     * {@inheritDoc}
     */
    public function __invoke($content = null, array $attribs = [])
    {
        if (0 === func_num_args()) {
        	return $this;
        }

        if (!is_scalar($content)) {
        	throw new \InvalidArgumentException(sprintf(
        	    '%s expects a scalar value, "%s" given',
        	    __METHOD__,
        	    is_object($content) ? get_class($content) : gettype($content)
        	));
        }

        if (!($content = trim($content))) {
            return '';
        }
        if (strpos($content, $this->defaultClass . '-') !== 0) {
        	$content = $this->defaultClass . '-' . $content;
        }

        if (!empty($attribs['class']) && !preg_match('/(\s|^)' . preg_quote($content, '/') . '(\s|$)/', $attribs['class'])) {
            $attribs['class'] .= ' ' . $content;
        } elseif (empty($attribs['class'])) {
            $attribs['class'] = $content;
        }

        return parent::__invoke('', $attribs);
    }
}
